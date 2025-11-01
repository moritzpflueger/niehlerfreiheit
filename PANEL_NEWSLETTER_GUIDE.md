# 📧 Panel-Integrated Newsletter Generator

## ✨ What's New

I've built a **proper panel-integrated solution** that's much better than the standalone page!

### Access It:
1. Log into Kirby panel
2. Go to "Site" page
3. See "📧 Newsletter" section in sidebar
4. Click **"📧 Newsletter Generator öffnen"**

Or directly: `http://localhost:8080/panel/newsletter`

## 🎯 The Interface

Clean, simple form with everything editors need:

```
┌─────────────────────────────────────────┐
│  📧 Newsletter Generator                 │
├─────────────────────────────────────────┤
│                                         │
│  Monat: [December 2025 ▼]              │
│                                         │
│  Willkommenstext:                       │
│  ┌─────────────────────────────────┐   │
│  │ Hallo liebe Freund:innen,       │   │
│  │ ...                             │   │
│  └─────────────────────────────────┘   │
│                                         │
│  Bild des Monats: [URL oder Datei]     │
│  [Datei wählen]                         │
│                                         │
│  Abschlusstext:                         │
│  ┌─────────────────────────────────┐   │
│  │ Wir freuen uns auf euch!        │   │
│  └─────────────────────────────────┘   │
│                                         │
│  Events (4)                             │
│  ☑ Test Event - 22.12.2025             │
│  ☑ Another Event - 25.12.2025          │
│  ☑ Super Event - 27.12.2025            │
│  ☑ Test Event 4000 - 22.12.2025        │
│                                         │
│  [✏️ Draft in Brevo erstellen]         │
│  [🚀 Sofort senden]                     │
│  [← Zurück zum Panel]                   │
└─────────────────────────────────────────┘
```

## 🔄 Complete Workflow

### Step 1: Select Month
- Month picker defaults to **next month**
- Shows past months too (for resending)
- Events auto-load when month changes

### Step 2: Fill in Text
- **Welcome text**: Your personal message (required)
- **Image URL**: Optional highlight image
- **Goodbye text**: Closing message (optional)

### Step 3: Review Events
- Auto-populated from selected month
- Shows count and list
- All events included (no deselection needed for now)

### Step 4: Generate
- **Draft**: Creates editable campaign in Brevo
  - With template: Full WYSIWYG editing
  - Without template: HTML with your custom content
- **Send Now**: Immediate send (admin only, double confirm)

## ✨ Benefits Over Old Approach

| Feature | Old (Standalone) | New (Panel) |
|---------|------------------|-------------|
| **Access** | Remember URL | Button in panel ✅ |
| **Look & Feel** | External page | Integrated ✅ |
| **Authentication** | Manual check | Panel auth ✅ |
| **Structure** | Just events | Form with all fields ✅ |
| **Month filtering** | All future events | Specific month ✅ |
| **Custom content** | Edit in Brevo | Fill form first ✅ |

## 🎨 With Brevo Template (Recommended)

When you set `template_id` in config:

1. **Fill form** in panel
2. **Click "Draft"**
3. **Brevo opens** with:
   - Welcome text already there
   - Image already there  
   - Events already there (styled with images)
   - Goodbye text already there
4. **Edit in WYSIWYG**: Drag-and-drop, click to edit
5. **Send from Brevo**

## 🔧 Setup Requirements

### Already Done:
- ✅ Panel route (`/panel/newsletter`)
- ✅ Form interface
- ✅ Month filtering
- ✅ API endpoints
- ✅ Template support
- ✅ Site blueprint with link

### You Need To:
1. **(Optional)** Create Brevo template with:
   - `{{params.WELCOME_TEXT}}`
   - `{{params.IMAGE_URL}}` (use conditional: `{{#if params.HAS_IMAGE}}`)
   - `{{params.EVENTS_HTML}}`
   - `{{params.GOODBYE_TEXT}}`
2. Add template ID to config
3. Done!

## 📋 Template Setup Example

In Brevo drag-and-drop editor:

### Header Section:
- Text block: "Niehler Freiheit"
- Text block: "Newsletter {{params.MONTH_YEAR}}"

### Welcome Section:
- Text block with: `{{params.WELCOME_TEXT}}`
- This will be filled from form!

### Image Section (Conditional):
- HTML block with:
```html
{{#if params.HAS_IMAGE}}
<img src="{{params.IMAGE_URL}}" alt="Bild des Monats" style="width: 100%; max-width: 600px; border-radius: 8px;">
{{/if}}
```

### Events Section:
- HTML block with: `{{params.EVENTS_HTML}}`
- This is where all events go!

### Goodbye Section:
- Text block with: `{{params.GOODBYE_TEXT}}`

### Footer:
- Text/links as usual
- Use `{{params.CURRENT_YEAR}}` for copyright

## 🚀 Quick Test

1. Visit: `http://localhost:8080/panel`
2. Click "Site"
3. See "Newsletter" section
4. Click button
5. Fill form:
   - Month: December 2025
   - Welcome: "Hallo liebe Freund:innen!"
   - Goodbye: "Bis bald!"
6. Click "Draft in Brevo erstellen"
7. Brevo opens with everything!

## 💡 File Upload (Future Enhancement)

Currently: Paste image URL

Future: Integrate with Kirby's file picker
- Would need Vue.js component
- For now, upload to media library
- Copy URL and paste

## 🎯 Monthly Routine

**Once set up, every month:**

1. **Go to panel** → Site → Newsletter
2. **Select next month**
3. **Type welcome message** (2 min)
4. **(Optional) Add image URL**
5. **Click "Draft"**
6. **Edit in Brevo if needed**
7. **Send!**

**Total time**: ~5 minutes 🚀

## 📖 Documentation

All docs still apply:
- `BREVO_TEMPLATE_SETUP.md` - How to create template
- `BREVO_EDITOR_SOLUTION.md` - Understanding limitations
- `BREVO_NEWSLETTER_IMPLEMENTATION.md` - Original implementation

## ⚙️ Configuration

All in `/site/config/config.localhost.php`:

```php
'brevo-newsletter' => [
  'brevo_api_key' => $_ENV['BREVO_API_KEY'],
  'sender_email' => $_ENV['BREVO_SENDER_EMAIL'],
  'sender_name' => 'Niehler Freiheit',
  'test_email' => $_ENV['BREVO_TEST_EMAIL'],
  'list_ids' => [4],
  'image_base_url' => $_ENV['BREVO_IMAGE_BASE_URL'] ?? null,
  'template_id' => null,  // Add your Brevo template ID here!
]
```

## 🎉 Summary

**You now have a professional, panel-integrated newsletter system!**

- ✅ Easy to find (button in panel)
- ✅ Structured input (form fields)
- ✅ Month filtering (only relevant events)
- ✅ Template support (WYSIWYG editing)
- ✅ No URL to remember
- ✅ Feels like native Kirby feature

**Old preview page still works** at `/brevo-newsletter/preview` for backwards compatibility, but the new panel interface is much better!

---

**Try it now**: `http://localhost:8080/panel/newsletter` 🚀

