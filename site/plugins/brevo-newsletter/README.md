# Brevo Newsletter Plugin for Kirby

This plugin provides a one-click solution to preview, test, and send event newsletters via Brevo (formerly Sendinblue) directly from your Kirby CMS admin panel.

## Features

- 🔍 **Live Preview** - See exactly what your newsletter will look like before sending
- 📧 **Test Sending** - Send test emails to verify everything works
- 🚀 **Instant Send** - Send campaigns to all subscribers with one click
- 📅 **Schedule Campaigns** - Plan newsletter sends for specific dates/times
- 🎨 **Beautiful Email Template** - Responsive, email-client-tested HTML template
- 🔄 **Auto-generated Content** - Automatically pulls upcoming events from Kirby
- ✅ **Zero Copy-Paste** - All content comes directly from your CMS

## Installation

The plugin is already installed in `/site/plugins/brevo-newsletter/`.

## Configuration

### 1. Get Brevo API Credentials

1. Create a free account at [Brevo](https://www.brevo.com/) (formerly Sendinblue)
2. Verify your sender email address in Brevo
3. Get your API key from: [https://app.brevo.com/settings/keys/api](https://app.brevo.com/settings/keys/api)
4. Create a contact list and note the List ID: [https://app.brevo.com/contact/list](https://app.brevo.com/contact/list)

### 2. Configure Environment Variables

Create a `.env` file in your project root (if you don't have one already):

```env
# Brevo Configuration
BREVO_API_KEY=your_api_key_here
BREVO_SENDER_EMAIL=newsletter@niehlerfreiheit.de
BREVO_TEST_EMAIL=your-test-email@example.com
```

### 3. Update Config

The configuration has already been added to `/site/config/config.php`. Update the `list_ids` array with your Brevo contact list IDs:

```php
'brevo-newsletter' => [
  'brevo_api_key' => env('BREVO_API_KEY', null),
  'sender_email' => env('BREVO_SENDER_EMAIL', null),
  'sender_name' => 'Niehler Freiheit',
  'test_email' => env('BREVO_TEST_EMAIL', null),
  'list_ids' => [
    2, // Replace with your actual Brevo list ID(s)
  ]
]
```

## Usage

### Access the Newsletter Preview

Navigate to: `https://your-domain.com/brevo-newsletter/preview`

Or create a shortcut in your panel (see Panel Integration below).

### Preview Page Features

The preview page shows:
- **Live email preview** - Exactly what subscribers will receive
- **Event list** - All events included in the newsletter
- **Action buttons**:
  - 📨 **Send Test** - Sends to your configured test email
  - 🚀 **Send Now** - Immediately sends to all subscribers (with double confirmation)
  - 📅 **Schedule** - Plan send for a future date/time

### Workflow

1. **Preview** - Check the email looks good
2. **Send Test** - Verify everything works correctly
3. **Send Now or Schedule** - Distribute to all subscribers

## Email Template Customization

The email template is located at:
```
/site/plugins/brevo-newsletter/snippets/email-template.php
```

You can customize:
- Colors and styling
- Layout structure
- Text content
- Footer information

The template automatically includes:
- Event title, date, time
- Event category and image
- Event description (excerpt)
- Link to full event page
- Unsubscribe link (Brevo standard)

## Panel Integration (Optional)

To add a quick link to the newsletter preview in your Kirby panel, update your site blueprint:

**`/site/blueprints/site.yml`**:

```yaml
sections:
  brevo-newsletter:
    type: info
    label: Newsletter
    text: |
      <a href="/brevo-newsletter/preview" target="_blank" class="k-button">
        📧 Newsletter Preview & Send
      </a>
```

## API Endpoints

The plugin provides these API routes:

- `GET /brevo-newsletter/preview` - Preview page (requires login)
- `POST /brevo-newsletter/send-test` - Send test email (requires login)
- `POST /brevo-newsletter/send-now` - Send to all subscribers (requires admin)
- `POST /brevo-newsletter/schedule` - Schedule campaign (requires admin)

### Example Schedule Request

```javascript
fetch('/brevo-newsletter/schedule', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    scheduledAt: '2025-11-15T10:00:00Z' // ISO 8601 format
  })
});
```

## Newsletter Content

The newsletter automatically includes:
- **Upcoming Events**: Next 10 upcoming events sorted by date
- **Event Details**: Date, time, category, description, image
- **Site Information**: Header with site title and current month/year
- **Footer Links**: Website, Impressum, Datenschutz
- **Unsubscribe**: Automatic Brevo unsubscribe link

## Email Client Compatibility

The email template is tested and optimized for:
- Gmail
- Outlook (desktop & web)
- Apple Mail
- iOS Mail
- Android Mail
- Thunderbird
- Yahoo Mail

## Troubleshooting

### "Brevo API key not configured"
- Check your `.env` file exists and contains `BREVO_API_KEY`
- Verify the API key is correct in Brevo settings

### "Sender email not configured"
- Add `BREVO_SENDER_EMAIL` to your `.env` file
- Ensure this email is verified in your Brevo account

### "Test email not sent"
- Verify `BREVO_TEST_EMAIL` is set in `.env`
- Check Brevo dashboard for sending logs

### "Campaign not sending"
- Verify `list_ids` array contains valid Brevo list IDs
- Check that lists have active subscribers
- Review Brevo account sending limits

### No events showing
- Ensure events exist in `/content/4_events/` with future dates
- Check event pages are published (not drafts)
- Verify date format is correct (YYYY-MM-DD)

## Security

- Preview page requires Kirby user login
- Test email sending requires login
- Campaign sending requires admin role
- API key stored in environment variables (not in git)

## Brevo Free Plan Limits

Brevo's free plan includes:
- 300 emails per day
- Unlimited contacts
- Email support
- Email template builder

For higher volumes, upgrade to a paid plan.

## Development

### File Structure

```
site/plugins/brevo-newsletter/
├── index.php                        # Plugin registration
├── src/
│   └── BrevoClient.php             # Brevo API integration
├── snippets/
│   ├── email-template.php          # Newsletter HTML template
│   └── preview-page.php            # Admin preview interface
└── README.md                       # This file
```

### Extending the Plugin

To modify what events are included, edit the event query in:
- `src/BrevoClient.php` → `getEmailHtml()` method

To change email styling, edit:
- `snippets/email-template.php` → `<style>` section

## Credits

- Plugin by: [Your Name]
- Built for: Niehler Freiheit
- Powered by: [Brevo](https://www.brevo.com/)

## License

MIT License - feel free to modify and use as needed.

## Support

For issues or questions:
1. Check the Troubleshooting section above
2. Review [Brevo API documentation](https://developers.brevo.com/)
3. Check [Kirby documentation](https://getkirby.com/docs)

---

**Note**: Remember to test thoroughly before sending to your entire subscriber list. Always use the "Send Test" feature first!

