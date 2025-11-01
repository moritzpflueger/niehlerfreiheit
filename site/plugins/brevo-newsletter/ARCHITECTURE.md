# Brevo Newsletter Plugin - Architecture

## 📐 System Architecture

```
┌─────────────────────────────────────────────────────────────────────┐
│                         Kirby CMS (Your Site)                       │
│                                                                     │
│  ┌────────────────┐         ┌──────────────────┐                  │
│  │                │         │                  │                  │
│  │  Events Pages  │────────▶│  Event Content   │                  │
│  │  (/events)     │         │  (Title, Date,   │                  │
│  │                │         │   Time, Image)   │                  │
│  └────────────────┘         └──────────────────┘                  │
│                                      │                             │
│                                      ▼                             │
│  ┌─────────────────────────────────────────────────────────────┐  │
│  │         Brevo Newsletter Plugin                             │  │
│  │                                                             │  │
│  │  ┌──────────────┐    ┌──────────────┐    ┌─────────────┐  │  │
│  │  │   Routes     │    │ BrevoClient  │    │  Snippets   │  │  │
│  │  │              │    │              │    │             │  │  │
│  │  │ • /preview   │───▶│ • API calls  │◀───│ • Email     │  │  │
│  │  │ • /send-test │    │ • Auth       │    │   Template  │  │  │
│  │  │ • /send-now  │    │ • Campaigns  │    │ • Preview   │  │  │
│  │  │ • /schedule  │    │              │    │   Page      │  │  │
│  │  └──────────────┘    └──────────────┘    └─────────────┘  │  │
│  │                              │                              │  │
│  └──────────────────────────────┼──────────────────────────────┘  │
│                                 │                                 │
└─────────────────────────────────┼─────────────────────────────────┘
                                  │
                                  │ HTTPS/cURL
                                  ▼
                    ┌─────────────────────────┐
                    │   Brevo API (Cloud)     │
                    │                         │
                    │  • Campaign Creation    │
                    │  • Email Sending        │
                    │  • List Management      │
                    │  • Scheduling           │
                    │                         │
                    └─────────────────────────┘
                                  │
                                  ▼
                    ┌─────────────────────────┐
                    │   Email Subscribers     │
                    │   (Contact Lists)       │
                    └─────────────────────────┘
```

## 🔄 Data Flow

### Preview Workflow
```
Admin clicks preview URL
         │
         ▼
Route /preview receives request
         │
         ▼
Check user authentication
         │
         ▼
Fetch upcoming events from Kirby
         │
         ▼
Render email-template.php with events
         │
         ▼
Render preview-page.php with controls
         │
         ▼
Display to admin with buttons
```

### Send Test Workflow
```
Admin clicks "Send Test"
         │
         ▼
POST to /send-test
         │
         ▼
BrevoClient::sendTestEmail()
         │
         ├─ Get email HTML
         │  └─ Fetch events
         │     └─ Render template
         │
         ├─ Build API request
         │  └─ Include sender info
         │     └─ Include recipient (test email)
         │
         └─ cURL to Brevo API
            └─ /smtp/email endpoint
               │
               ▼
         Brevo sends email
               │
               ▼
         Test inbox receives email
```

### Send Campaign Workflow
```
Admin clicks "Send Now"
         │
         ▼
Confirm dialog (twice for safety)
         │
         ▼
POST to /send-now
         │
         ▼
BrevoClient::sendCampaign()
         │
         ├─ Get email HTML
         │  └─ Fetch events
         │     └─ Render template
         │
         ├─ Create campaign via API
         │  └─ POST /emailCampaigns
         │     (returns campaign ID)
         │
         └─ Send campaign via API
            └─ POST /emailCampaigns/{id}/sendNow
               │
               ▼
         Brevo queues campaign
               │
               ▼
         Brevo sends to all list subscribers
               │
               ▼
         Subscribers receive emails
```

### Schedule Workflow
```
Admin clicks "Schedule"
         │
         ▼
Date/time picker appears
         │
         ▼
Admin selects date & time
         │
         ▼
POST to /schedule with ISO 8601 timestamp
         │
         ▼
BrevoClient::scheduleCampaign()
         │
         ├─ Get email HTML
         │
         └─ Create campaign with scheduledAt
            └─ POST /emailCampaigns
               │
               ▼
         Brevo schedules campaign
               │
               ▼
         At scheduled time: Brevo sends automatically
```

## 🗂️ File Structure

```
site/plugins/brevo-newsletter/
│
├── index.php                           # Plugin Registration
│   ├── Plugin options                  # Configuration defaults
│   ├── Routes                          # HTTP endpoints
│   │   ├── GET  /brevo-newsletter/preview
│   │   ├── POST /brevo-newsletter/send-test
│   │   ├── POST /brevo-newsletter/send-now
│   │   └── POST /brevo-newsletter/schedule
│   ├── Snippets                        # Template registration
│   └── Sections                        # Panel components
│
├── src/
│   └── BrevoClient.php                # API Integration
│       ├── __construct()               # Initialize with config
│       ├── sendTestEmail()             # Send to test address
│       ├── sendCampaign()              # Send to all subscribers
│       ├── scheduleCampaign()          # Schedule for later
│       ├── getEmailHtml()              # Generate email content
│       ├── generateSubject()           # Create subject line
│       └── apiRequest()                # Generic API call wrapper
│
├── snippets/
│   ├── email-template.php             # Newsletter HTML
│   │   ├── Header section
│   │   ├── Event loop
│   │   │   ├── Event image
│   │   │   ├── Event details
│   │   │   └── Call-to-action button
│   │   └── Footer with links
│   │
│   └── preview-page.php               # Admin Interface
│       ├── Header with title
│       ├── Control panel
│       │   ├── Event info box
│       │   ├── Action buttons
│       │   └── Schedule form
│       ├── Email preview (iframe)
│       └── JavaScript handlers
│
└── Documentation/
    ├── README.md                       # Full documentation
    ├── SETUP.md                        # Step-by-step setup
    ├── QUICKSTART.md                   # Quick reference
    └── ARCHITECTURE.md                 # This file
```

## 🔐 Security Model

```
┌─────────────────────────────────────────┐
│         Security Layers                 │
├─────────────────────────────────────────┤
│                                         │
│  1. Route Access Control                │
│     ├─ Preview: Login required          │
│     ├─ Test Send: Login required        │
│     └─ Send/Schedule: Admin required    │
│                                         │
│  2. Double Confirmation                 │
│     └─ "Send Now" requires 2 confirms   │
│                                         │
│  3. Environment Variables               │
│     ├─ API keys in .env (not git)       │
│     └─ Sensitive data never hardcoded   │
│                                         │
│  4. API Authentication                  │
│     └─ Brevo API key in headers         │
│                                         │
│  5. HTTPS                               │
│     └─ All API calls over SSL           │
│                                         │
└─────────────────────────────────────────┘
```

## 🔌 API Integration Points

### Brevo API Endpoints Used

| Endpoint | Method | Purpose |
|----------|--------|---------|
| `/smtp/email` | POST | Send transactional test email |
| `/emailCampaigns` | POST | Create email campaign |
| `/emailCampaigns/{id}/sendNow` | POST | Send campaign immediately |

### API Request Structure

**Test Email:**
```json
{
  "sender": {
    "name": "Niehler Freiheit",
    "email": "newsletter@niehlerfreiheit.de"
  },
  "to": [
    {
      "email": "test@example.com",
      "name": "Test Recipient"
    }
  ],
  "subject": "[TEST] Veranstaltungen - November 2025",
  "htmlContent": "<!DOCTYPE html>..."
}
```

**Campaign:**
```json
{
  "name": "Newsletter - 2025-11-01 14:30:00",
  "subject": "Veranstaltungen - November 2025",
  "sender": {
    "name": "Niehler Freiheit",
    "email": "newsletter@niehlerfreiheit.de"
  },
  "type": "classic",
  "htmlContent": "<!DOCTYPE html>...",
  "recipients": {
    "listIds": [2]
  },
  "scheduledAt": "2025-11-05T10:00:00.000Z" // Optional
}
```

## 🎨 Template Rendering

### Event Data Pipeline

```
Kirby Events
     │
     ├─ Title (String)
     ├─ Date (Date Field)
     ├─ Start Time (Time Field)
     ├─ Admission Time (Time Field, optional)
     ├─ Category (String)
     ├─ Text (Textarea with Markdown)
     ├─ Images (Files)
     └─ Is Canceled (Toggle)
     │
     ▼
PHP Template Loop
     │
     ├─ Format dates with IntlDateFormatter
     ├─ Escape HTML special characters
     ├─ Generate image URLs
     ├─ Excerpt long text (200 chars)
     └─ Build HTML structure
     │
     ▼
Email HTML Output
     │
     └─ Inline CSS (email clients)
        └─ Responsive design
           └─ Dark mode considerations
```

## 🔧 Configuration Flow

```
.env file
   │
   ├─ BREVO_API_KEY
   ├─ BREVO_SENDER_EMAIL
   └─ BREVO_TEST_EMAIL
        │
        ▼
getenv() reads environment
        │
        ▼
config.php
        │
        ├─ 'brevo-newsletter.brevo_api_key'
        ├─ 'brevo-newsletter.sender_email'
        ├─ 'brevo-newsletter.sender_name'
        ├─ 'brevo-newsletter.test_email'
        └─ 'brevo-newsletter.list_ids'
              │
              ▼
        kirby()->option()
              │
              ▼
        BrevoClient reads options
              │
              ▼
        Used in API calls
```

## 📊 Error Handling

```
Try/Catch Blocks
      │
      ├─ cURL errors
      │  └─ Connection failures
      │     └─ Return: {success: false, message: "cURL error"}
      │
      ├─ HTTP errors (4xx/5xx)
      │  └─ API rate limits
      │     └─ Return: {success: false, message: "Brevo API error"}
      │
      ├─ Configuration errors
      │  └─ Missing API key
      │     └─ Throw: Exception "API key not configured"
      │
      └─ Content errors
         └─ No events found
            └─ Display: Warning message in preview
```

## 🚀 Deployment Checklist

- [ ] Plugin files in place
- [ ] `.env` file configured
- [ ] `config.php` updated with List IDs
- [ ] Brevo sender email verified
- [ ] Test email sent successfully
- [ ] Preview page accessible
- [ ] Panel shortcut created (optional)
- [ ] Team trained on usage

## 🔄 Maintenance

### Regular Tasks
- Monthly: Send newsletter
- Quarterly: Review Brevo analytics
- Annually: Check API key expiration

### Updates
- Plugin updates: via git pull or manual
- Brevo SDK: N/A (using direct API)
- Template updates: Edit snippets as needed

### Monitoring
- Brevo dashboard for delivery stats
- Error logs in Kirby
- Subscriber list growth

## 📈 Scalability

Current implementation handles:
- ✅ Up to 300 emails/day (Brevo free tier)
- ✅ Unlimited contacts
- ✅ Unlimited events in newsletter
- ✅ Multiple contact lists

To scale beyond free tier:
1. Upgrade Brevo plan
2. Update `list_ids` configuration
3. No code changes needed!

## 🧪 Testing Strategy

### Unit Testing
- BrevoClient API calls (mock responses)
- Email template rendering
- Route authentication

### Integration Testing
- End-to-end preview workflow
- Test email sending
- Campaign creation

### Manual Testing
- Email client rendering
- Link functionality
- Mobile responsiveness
- Unsubscribe flow

---

**Architecture Version:** 1.0.0  
**Last Updated:** November 2025  
**Kirby Version:** 3.x+  
**Brevo API Version:** v3

