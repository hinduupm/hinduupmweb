# WhatsApp poster setup

Volunteers forward an activity poster to the HinduUPM WhatsApp number. Claude reads the poster, and the approvers get a summary on WhatsApp. They reply 1 to publish it, 2 to edit it first, or 3 to reject it. Admins can also review posters at `pendingActivities.php`.

Do these steps once, in order. Merge the secure-config change and create `hinduupm_config.php` first.

## 1. Database

Open phpMyAdmin and run `migration_whatsapp_posters.sql`. Existing activities stay published.

## 2. Phone number and Meta app

1. Get a phone number that is not registered on WhatsApp. It can be a new SIM that can receive one SMS or call.
2. Go to https://developers.facebook.com, create an app of type **Business**, and add the **WhatsApp** product. This creates a Meta Business account if you don't have one yet.
3. Under WhatsApp > API Setup, add the phone number and verify it. Then copy the **Phone number ID**.
4. In Business Settings > Users > System users, create a system user with the Admin role. Give it the app and the WhatsApp account. Generate a token with the `whatsapp_business_messaging` and `whatsapp_business_management` permissions, and set it to never expire.
5. In App settings > Basic, copy the **App secret**.
6. In WhatsApp > Configuration, add a payment method. Since 1 October 2026, Meta needs one on file even when you stay inside the 1,000 free replies a month.

## 3. Claude API key

Create a key at https://platform.claude.com and add some prepaid credit. One poster costs about ₹1–3.

## 4. Config

Fill in the `site_url`, `whatsapp` and `anthropic` sections of `hinduupm_config.php`. `config.example.php` shows each field.

- `verify_token`: any long random string you make up.
- `approvers`: numbers that can publish. `submitters`: numbers that can only forward posters. Write numbers with the country code and no `+`, for example `919876543210`.

## 5. Webhook

In WhatsApp > Configuration > Webhook:

- Callback URL: `https://hinduupm.org/whatsapp_webhook.php`
- Verify token: the same `verify_token` you put in the config
- After saving, subscribe to the **messages** field.

## 6. Cron job

In cPanel > Cron Jobs, add a job that runs every minute:

```
php /home/oan0s2tg1t72/public_html/process_inbox.php
```

## 7. Optional: review template

WhatsApp only allows free-text messages to people who messaged the number in the last 24 hours. If an approver hasn't, the bot sends them an approved template instead.

To set one up, go to WhatsApp Manager > Message templates and create a **Utility** template in Tamil. Its body should contain one variable, for example:

> புதிய செயல்பாட்டு போஸ்டர்: {{1}}. வெளியிட 1, திருத்த 2, நிராகரிக்க 3 என்று பதில் அனுப்பவும்.

Put its name in `review_template`. Without a template, an approver who hasn't messaged the number in the last 24 hours won't get the summary. The poster still shows on `pendingActivities.php`.

## Trying it

1. From an approver's phone, send "hi" to the number. This opens the 24-hour window.
2. Forward a poster to the number. Within a minute or two you should get the summary.
3. Reply 1. The activity should then appear on the website.

If nothing arrives, look at the `whatsapp_inbox` table (the `error` column) and the PHP error log in cPanel.
