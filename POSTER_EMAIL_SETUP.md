# Emailed poster setup

Volunteers email an activity poster to **hinduupm+posters@gmail.com**. To do that from WhatsApp, open the poster, tap Share and choose Gmail. Every few minutes the website checks that address, and Claude reads the Tamil title, district, place and date. The approvers then get an email with a summary and a link to `pendingActivities.php`. They check the details there and press Publish. The volunteer gets an email once their poster is live.

Mail sent to the `+posters` address arrives in the normal hinduupm@gmail.com inbox. The website reads only messages addressed to `+posters`, from senders on the approved list. It never marks any mail as read, so the rest of the org's mail stays untouched.

Do these steps once, in order.

## 1. Database

Open phpMyAdmin and run `migration_posters.sql`. Existing activities stay published.

## 2. Gmail

1. Sign in to hinduupm@gmail.com and turn on 2-Step Verification under Google Account > Security, if it isn't on already.
2. Open Google Account > Security > App passwords. Create one named "website" and copy the 16-character password.
   - The app password can read and send the org's mail. Keep it only in the server config file. You can revoke it at any time from the same page.
3. IMAP is on by default for Gmail. If it has been turned off, turn it on in Gmail Settings > Forwarding and POP/IMAP.

## 3. Claude API key

Create a key at https://platform.claude.com and add some prepaid credit. One poster costs about ₹1–3.

## 4. Config

In `hinduupm_config.php` on the server, fill in the `mail` and `anthropic` sections. `config.example.php` shows each field.

- `app_password`: the app password from step 2.
- `approvers`: the email addresses that review and publish posters.
- `submitters`: the volunteers' email addresses. Approvers can always send posters too.

## 5. Cron job

In cPanel > Cron Jobs, add a job that runs every 5 minutes:

```
php /home/oan0s2tg1t72/public_html/process_inbox.php
```

## Trying it

From an address on the list, email a poster to hinduupm+posters@gmail.com. Use the subject or body for any correction, for example "date is 31-10-2026".

Within about 5 minutes the approvers should get an email with the link. Open it, check the details and press Publish.

If nothing arrives, look at the `poster_inbox` table (the `status` and `error` columns) and at the cron job's output in cPanel. A sender who isn't on the list shows up there with the status `ignored`.
