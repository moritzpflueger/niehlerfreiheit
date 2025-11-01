# Brevo Newsletter - Quick Setup Guide

## Step-by-Step Setup (5 minutes)

### 1. Create Brevo Account
1. Go to [https://www.brevo.com/](https://www.brevo.com/)
2. Sign up for a free account
3. Verify your email address

### 2. Verify Your Sender Email
1. In Brevo, go to **Senders & IP** → **Senders**
2. Add your email address (e.g., `newsletter@niehlerfreiheit.de`)
3. Follow the verification steps (DNS records or email confirmation)
4. Wait for verification (usually 1-24 hours)

### 3. Get Your API Key
1. In Brevo, go to **Settings** → **SMTP & API**
2. Click **Create a new API key**
3. Name it "Kirby Newsletter Plugin"
4. Copy the API key (you won't see it again!)

### 4. Create a Contact List
1. Go to **Contacts** → **Lists**
2. Click **Create a list**
3. Name it "Newsletter Subscribers"
4. Note the List ID (shown in the list overview)

### 5. Configure Your Kirby Site

#### A. Create .env file
Create `/Users/moritz/Projects/niehlerfreiheit/.env`:

```env
BREVO_API_KEY=xkeysib-xxxxxxxxxxxxxxxxxxxxx
BREVO_SENDER_EMAIL=newsletter@niehlerfreiheit.de
BREVO_TEST_EMAIL=your-personal-email@example.com
```

#### B. Update config.php
Edit `/site/config/config.php` and add your List ID:

```php
'brevo-newsletter' => [
  // ... other config ...
  'list_ids' => [
    2, // Replace 2 with your actual List ID from step 4
  ]
]
```

### 6. Test the Plugin

1. Navigate to: `http://localhost:8080/brevo-newsletter/preview`
   (or your production domain)
2. You should see the newsletter preview
3. Click **"📨 Send Test Email"**
4. Check your test email inbox

### 7. Send Your First Newsletter

Once the test looks good:
1. Click **"📨 Send Test"** one more time to be sure
2. Click **"🚀 Send Now"** to send to all subscribers
3. Confirm twice (safety feature)
4. Done! 🎉

## Common Issues

### ❌ "Brevo API key not configured"
**Solution**: Check your `.env` file exists and contains the correct API key.

### ❌ "Sender email not verified"
**Solution**: Complete sender verification in Brevo (see Step 2 above). This can take up to 24 hours.

### ❌ "Failed to create campaign"
**Solution**: Verify your List ID is correct in `config.php`.

### ❌ No events in preview
**Solution**: Make sure you have upcoming events in your CMS with future dates.

### ❌ Can't access preview page
**Solution**: Make sure you're logged into the Kirby panel first.

## Optional: Add Panel Shortcut

To add a button in your Kirby panel, create or edit:

**`/site/blueprints/site.yml`**:

```yaml
title: Site

tabs:
  content:
    label: Content
    icon: page
    columns:
      main:
        width: 2/3
        sections:
          # ... your existing sections ...
          
      sidebar:
        width: 1/3
        sections:
          newsletter:
            type: info
            label: 📧 Newsletter
            text: |
              Send monthly event newsletter via Brevo.
              
              <a href="/brevo-newsletter/preview" target="_blank" style="display: inline-block; background: #000; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 10px;">
                Preview & Send Newsletter
              </a>
```

## Monthly Workflow

Once set up, your monthly workflow is:

1. **Add/update events** in Kirby (as usual)
2. **Visit** `/brevo-newsletter/preview`
3. **Click** "Send Test" to review
4. **Click** "Send Now" or "Schedule" to distribute

That's it! 🚀

## Need Help?

- 📖 [Full README](README.md)
- 🔧 [Brevo Documentation](https://developers.brevo.com/)
- 💬 [Kirby Forum](https://forum.getkirby.com/)

