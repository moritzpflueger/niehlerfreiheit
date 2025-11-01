# 🚀 Brevo Newsletter - Quick Start

## ✅ Pre-Flight Checklist

Before sending your first newsletter, complete these steps:

### 1. Brevo Account Setup
- [ ] Create Brevo account at [brevo.com](https://www.brevo.com)
- [ ] Verify sender email address
- [ ] Get API key from Brevo settings
- [ ] Create contact list in Brevo
- [ ] Note your List ID number

### 2. Local Configuration
- [ ] Create `.env` file with:
  ```
  BREVO_API_KEY=your_key_here
  BREVO_SENDER_EMAIL=newsletter@niehlerfreiheit.de
  BREVO_TEST_EMAIL=your-test@email.com
  ```
- [ ] Update `site/config/config.php` with your List ID
- [ ] Verify sender name is correct

### 3. Test Run
- [ ] Visit `/brevo-newsletter/preview`
- [ ] Check events are displayed correctly
- [ ] Send test email
- [ ] Verify test email received and looks good
- [ ] Check all links work

### 4. First Send
- [ ] Double-check content is correct
- [ ] Send one more test email
- [ ] Click "Send Now" or "Schedule"
- [ ] Monitor Brevo dashboard for delivery

## 📋 Monthly Workflow

### Standard Monthly Newsletter Send

```
┌─────────────────────────────────────────┐
│ 1. Content Ready                        │
│    ✓ Events added/updated in Kirby     │
│    ✓ Dates and times verified          │
└─────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────┐
│ 2. Preview & Test                       │
│    → Visit: /brevo-newsletter/preview   │
│    → Click: "📨 Send Test Email"        │
│    → Check: Your inbox                  │
└─────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────┐
│ 3. Send or Schedule                     │
│    Option A: Send immediately           │
│    → Click: "🚀 Send Now"               │
│                                          │
│    Option B: Schedule for later         │
│    → Click: "📅 Schedule"               │
│    → Pick: Date & time                  │
└─────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────┐
│ 4. Verify                               │
│    → Check Brevo dashboard              │
│    → Monitor open rates                 │
│    → Review any bounces                 │
└─────────────────────────────────────────┘
```

## 🎯 Usage Examples

### Example 1: Send Immediately
```
1. Check preview looks good
2. Send test to yourself
3. Verify test email
4. Click "Send Now"
5. Confirm twice
6. Done! ✅
```

### Example 2: Schedule for Next Week
```
1. Check preview
2. Click "Schedule"
3. Pick date/time (e.g., next Monday 10:00)
4. Confirm
5. Campaign scheduled ✅
```

### Example 3: Monthly Routine
```
1st of each month:
- Add upcoming events for the month
- Visit preview page
- Send test email
- Schedule for 5th of the month, 10:00 AM
```

## 🎨 Customization Quick Tips

### Change Email Colors
Edit: `/site/plugins/brevo-newsletter/snippets/email-template.php`

```css
/* Header background */
.header {
  background-color: #000000; /* Change this */
}

/* Category badge */
.event-category {
  background-color: #ffd700; /* Change this */
}

/* Button color */
.event-link {
  background-color: #000000; /* Change this */
}
```

### Change Subject Line
Edit: `/site/plugins/brevo-newsletter/src/BrevoClient.php`

Find the `generateSubject()` method:
```php
protected function generateSubject(): string
{
  $monthYear = date('F Y');
  return "Veranstaltungen - {$monthYear}"; // Change this
}
```

### Change Number of Events
Edit: `/site/plugins/brevo-newsletter/src/BrevoClient.php`

Find `.limit(10)` in the `getEmailHtml()` method and change to your desired number.

## 🔍 Troubleshooting Quick Fixes

| Problem | Quick Fix |
|---------|-----------|
| 403/401 Error | Check API key is correct |
| "Sender not verified" | Wait for email verification (can take 24h) |
| No events showing | Check events have future dates |
| Can't access preview | Log into Kirby panel first |
| Test email not received | Check spam folder, verify test email in config |
| Campaign not sending | Verify List ID is correct |

## 📊 Brevo Dashboard

After sending, monitor your campaign in Brevo:

1. **Dashboard**: Overview of sends, opens, clicks
2. **Campaigns**: List of all sent campaigns
3. **Statistics**: Detailed analytics per campaign
4. **Contacts**: Manage your subscriber lists

Access at: [https://app.brevo.com/](https://app.brevo.com/)

## 🔒 Security Notes

- ✅ API key stored in `.env` (not in git)
- ✅ Preview requires login
- ✅ Sending requires admin rights
- ✅ Double confirmation before sending
- ✅ Test mode available

## 📱 Recommended Testing

Before your first real send, test on these email clients:
- [ ] Gmail (web)
- [ ] Gmail (mobile app)
- [ ] Outlook (web)
- [ ] Apple Mail (if available)

## 🎓 Best Practices

1. **Always send a test first** - even if you've checked the preview
2. **Check mobile view** - most people read email on phones
3. **Verify links work** - click every link in the test email
4. **Schedule during business hours** - better open rates
5. **Monitor analytics** - learn what works for your audience
6. **Keep it consistent** - same day/time each month builds anticipation

## 📞 Getting Help

1. Check [README.md](README.md) - Full documentation
2. Check [SETUP.md](SETUP.md) - Detailed setup instructions  
3. Review [Brevo docs](https://developers.brevo.com/) - API documentation
4. Check Brevo support - Available in your account

---

**Ready to send your first newsletter?** 🚀

Visit: `/brevo-newsletter/preview` to get started!

