<?php
// Small IMAP reader and SMTP sender for the posters mailbox.
// Written on plain sockets because the PHP imap extension is no longer
// bundled with PHP 8.4+, and the cPanel deploy can't ship Composer packages.
require_once __DIR__ . '/config_loader.php';

function mail_config() {
    return hinduupm_config()['mail'];
}

function mail_is_approver($address) {
    return in_array(strtolower($address), array_map('strtolower', mail_config()['approvers']), true);
}

function mail_is_submitter($address) {
    return mail_is_approver($address)
        || in_array(strtolower($address), array_map('strtolower', mail_config()['submitters']), true);
}

class ImapClient {
    private $sock;
    private $tag = 0;

    public function __construct($host, $port, $username, $password) {
        $this->sock = stream_socket_client($host . ':' . $port, $errno, $errstr, 30);
        if (!$this->sock) {
            throw new RuntimeException("IMAP connect failed: $errstr");
        }
        stream_set_timeout($this->sock, 60);
        fgets($this->sock); // greeting
        $this->command('LOGIN ' . $this->quote($username) . ' ' . $this->quote($password));
    }

    // Runs a command and returns its untagged lines, with any literal data
    // appended to the line that announced it.
    public function command($cmd) {
        $tag = 'A' . (++$this->tag);
        fwrite($this->sock, "$tag $cmd\r\n");
        $lines = [];
        while (($line = fgets($this->sock)) !== false) {
            if (preg_match('/\{(\d+)\}\r\n$/', $line, $m)) {
                $line .= $this->read_bytes((int) $m[1]);
                $line .= fgets($this->sock);
            }
            if (strpos($line, "$tag ") === 0) {
                if (strpos($line, "$tag OK") !== 0) {
                    throw new RuntimeException('IMAP error: ' . trim(substr($line, strlen($tag) + 1)));
                }
                return $lines;
            }
            $lines[] = $line;
        }
        throw new RuntimeException('IMAP connection closed');
    }

    // UIDs of messages sent to $to on or after $since.
    public function search_to($to, DateTime $since) {
        $this->command('SELECT INBOX');
        $uids = [];
        foreach ($this->command('UID SEARCH TO ' . $this->quote($to) . ' SINCE ' . $since->format('j-M-Y')) as $line) {
            if (strpos($line, '* SEARCH') === 0) {
                $uids = array_merge($uids, array_map('intval', array_filter(explode(' ', trim(substr($line, 8))))));
            }
        }
        return $uids;
    }

    // Raw message, fetched without marking it as read.
    public function fetch($uid) {
        foreach ($this->command('UID FETCH ' . (int) $uid . ' BODY.PEEK[]') as $line) {
            if (preg_match('/\{(\d+)\}\r\n/', $line, $m, PREG_OFFSET_CAPTURE)) {
                $start = $m[0][1] + strlen($m[0][0]);
                return substr($line, $start, (int) $m[1][0]);
            }
        }
        throw new RuntimeException("IMAP message $uid not found");
    }

    public function logout() {
        try {
            $this->command('LOGOUT');
        } catch (RuntimeException $e) {
        }
        fclose($this->sock);
    }

    private function read_bytes($n) {
        $data = '';
        while (strlen($data) < $n && !feof($this->sock)) {
            $data .= fread($this->sock, $n - strlen($data));
        }
        return $data;
    }

    private function quote($s) {
        return '"' . addcslashes($s, '"\\') . '"';
    }
}

// Splits a raw message into what the poster flow needs:
// message_id, from (address), subject, text, images [[bytes, mime], ...].
function mail_parse($raw) {
    list($headers, $body) = mail_split($raw);
    $parsed = [
        'message_id' => trim($headers['message-id'] ?? '', " <>\r\n") ?: hash('sha256', $raw),
        'from'       => mail_address($headers['from'] ?? ''),
        'subject'    => mail_decode_header($headers['subject'] ?? ''),
        'text'       => '',
        'images'     => [],
    ];
    mail_walk($headers, $body, $parsed);
    return $parsed;
}

function mail_split($raw) {
    $raw = str_replace("\r\n", "\n", $raw);
    $pos = strpos($raw, "\n\n");
    $head = $pos === false ? $raw : substr($raw, 0, $pos);
    $body = $pos === false ? '' : substr($raw, $pos + 2);
    $headers = [];
    foreach (explode("\n", preg_replace("/\n[ \t]+/", ' ', $head)) as $line) {
        if (strpos($line, ':') !== false) {
            list($name, $value) = explode(':', $line, 2);
            $headers[strtolower(trim($name))] = trim($value);
        }
    }
    return [$headers, $body];
}

function mail_walk(array $headers, $body, array &$parsed) {
    $type = $headers['content-type'] ?? 'text/plain';
    $mime = strtolower(trim(explode(';', $type)[0]));

    if (strpos($mime, 'multipart/') === 0 && preg_match('/boundary="?([^";]+)"?/i', $type, $m)) {
        $parts = explode('--' . $m[1], $body);
        array_shift($parts); // preamble
        foreach ($parts as $part) {
            if (strpos($part, '--') === 0) {
                break; // closing boundary
            }
            list($h, $b) = mail_split(ltrim($part, "\n"));
            mail_walk($h, $b, $parsed);
        }
        return;
    }

    $encoding = strtolower($headers['content-transfer-encoding'] ?? '');
    if ($encoding === 'base64') {
        $data = base64_decode(preg_replace('/\s+/', '', $body));
    } elseif ($encoding === 'quoted-printable') {
        $data = quoted_printable_decode($body);
    } else {
        $data = $body;
    }

    if (strpos($mime, 'image/') === 0) {
        $parsed['images'][] = [$data, $mime];
    } elseif ($mime === 'text/plain' && $parsed['text'] === '') {
        if (preg_match('/charset="?([^";]+)"?/i', $type, $c) && strtolower($c[1]) !== 'utf-8') {
            $data = mb_convert_encoding($data, 'UTF-8', $c[1]);
        }
        $parsed['text'] = trim($data);
    }
}

function mail_address($from) {
    if (preg_match('/<([^>]+)>/', $from, $m)) {
        return strtolower(trim($m[1]));
    }
    return strtolower(trim($from));
}

function mail_decode_header($value) {
    return function_exists('iconv_mime_decode') ? (iconv_mime_decode($value, ICONV_MIME_DECODE_CONTINUE_ON_ERROR, 'UTF-8') ?: $value) : $value;
}

// Sends a plain-text UTF-8 email through the mailbox's SMTP server.
function mail_send($to, $subject, $text) {
    $cfg = mail_config();
    $sock = stream_socket_client($cfg['smtp_host'] . ':' . $cfg['smtp_port'], $errno, $errstr, 30);
    if (!$sock) {
        throw new RuntimeException("SMTP connect failed: $errstr");
    }
    stream_set_timeout($sock, 60);

    $expect = function ($code) use ($sock) {
        $reply = '';
        while (($line = fgets($sock)) !== false) {
            $reply .= $line;
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        if (strpos($reply, (string) $code) !== 0) {
            throw new RuntimeException('SMTP error: ' . trim($reply));
        }
    };
    $send = function ($line, $code) use ($sock, $expect) {
        fwrite($sock, $line . "\r\n");
        $expect($code);
    };

    $expect(220);
    $send('EHLO hinduupm.org', 250);
    $send('AUTH LOGIN', 334);
    $send(base64_encode($cfg['username']), 334);
    $send(base64_encode($cfg['app_password']), 235);
    $send('MAIL FROM:<' . $cfg['username'] . '>', 250);
    $send('RCPT TO:<' . $to . '>', 250);
    $send('DATA', 354);

    $message = implode("\r\n", [
        'From: Hindu UPM <' . $cfg['username'] . '>',
        'To: <' . $to . '>',
        'Subject: =?UTF-8?B?' . base64_encode($subject) . '?=',
        'Date: ' . date('r'),
        'Message-ID: <' . bin2hex(random_bytes(12)) . '@hinduupm.org>',
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: base64',
        '',
        chunk_split(base64_encode($text)),
    ]);
    $send($message . "\r\n.", 250);
    $send('QUIT', 221);
    fclose($sock);
}
?>
