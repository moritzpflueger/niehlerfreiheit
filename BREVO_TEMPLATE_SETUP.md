# 🎯 PERFECT SOLUTION: Brevo Template with WYSIWYG + Auto Events

## ✨ This Is What You Want!

**The best of both worlds:**
- ✅ Events automatically generated with images & styling
- ✅ Full WYSIWYG drag-and-drop editing for everything else
- ✅ Editor adds welcome text, image of month easily
- ✅ No HTML knowledge needed
- ✅ Takes 20 minutes to set up once, then works forever

## 🎯 How It Works

```
ONE-TIME SETUP (20 min):
1. Create template in Brevo with drag-and-drop
2. Add {{params.EVENTS_HTML}} placeholder
3. Note template ID
4. Add to config

MONTHLY WORKFLOW (5 min):
1. Click "Create Draft" in Kirby
2. Opens in Brevo with full WYSIWYG editor
3. Events are already there!
4. Edit welcome text, add image of month
5. Send!
```

## 📋 Step-by-Step Setup

### Step 1: Create Template in Brevo (10 min)

1. **Go to**: [https://app.brevo.com/camp/template/listing](https://app.brevo.com/camp/template/listing)

2. **Click**: "Create a new template"

3. **Choose**: "Drag & drop editor" ← Important!

4. **Name it**: "Newsletter Template"

5. **Design your template**:

#### Header Section:
- Drag "Text" block to top
- Type: "{{params.SITE_NAME}}"
- Or: Type "Niehler Freiheit" (fixed)
- Style as H1, center-aligned
- Background color: Black (#000000)
- Text color: White

#### Welcome Section (Editable by editor each month):
- Drag "Text" block
- Type your default welcome message:
  ```
  Hallo liebe Freund:innen,
  
  hier sind die kommenden Veranstaltungen im {{params.MONTH_YEAR}}!
  ```
- Style as you like

#### Image Section (Editable by editor each month):
- Drag "Image" block
- Upload placeholder image OR leave empty
- Caption: "Highlight des Monats"
- This is where editor adds "image of the month"

#### Events Section (AUTO-GENERATED):
- Drag "HTML" block  ← Important: Use HTML block!
- Click to edit the HTML block
- Delete any placeholder text
- Type exactly: `{{params.EVENTS_HTML}}`
- That's it! This will be replaced with event HTML

#### Footer Section:
- Drag "Divider" block
- Drag "Text" block
- Add:
  ```
  Niehler Freiheit
  
  Website | Impressum | Datenschutz
  
  © {{params.CURRENT_YEAR}}
  ```

6. **Save template**

7. **Note the Template ID**:
   - Look in URL: `https://app.brevo.com/camp/template/design/12345`
   - The number (12345) is your Template ID
   - Or click template → Settings → note ID

### Step 2: Configure Kirby (2 min)

Edit `/site/config/config.localhost.php`:

```php
'brevo-newsletter' => [
  // ... existing config ...
  
  // Add this line with your template ID:
  'template_id' => 12345,  // Replace with your actual Template ID
]
```

### Step 3: Restart Server

```bash
kill -9 $(lsof -ti:8080); cd /Users/moritz/Projects/niehlerfreiheit && php -S localhost:8080 > /dev/null 2>&1 &
```

### Step 4: Test It! (2 min)

1. **Visit**: `http://localhost:8080/brevo-newsletter/preview`
2. **Click**: "✏️ Draft in Brevo erstellen"
3. **Brevo opens** with FULL WYSIWYG editor!
4. **See**: Events are already there with images!
5. **Edit**: Welcome text, add image of month
6. **Preview**: Check desktop & mobile
7. **🎉 It works!**

## 🎨 What Editors Can Do Now

When editor clicks "Edit" on the draft campaign:

### Full WYSIWYG Editing:
- ✅ **Welcome text**: Click and type (like Word)
- ✅ **Image of month**: Drag image block, upload
- ✅ **Reorder sections**: Drag and drop
- ✅ **Add content**: Add more text blocks, dividers, buttons
- ✅ **Style everything**: Colors, fonts, spacing
- ✅ **Edit events**: Yes! Even edit individual event text if needed
- ✅ **Mobile preview**: One click
- ✅ **Test send**: Send to self first

### What's Automated:
- ✅ All events with images
- ✅ Event styling (cards, badges, etc.)
- ✅ Event links
- ✅ Responsive design
- ✅ Current month/year

## 📊 Template Variables Available

You can use these in your template:

| Variable | What It Shows | Example |
|----------|---------------|---------|
| `{{params.EVENTS_HTML}}` | All events with full styling & images | (auto-generated) |
| `{{params.MONTH_YEAR}}` | Current month and year | "November 2025" |
| `{{params.CURRENT_YEAR}}` | Current year | "2025" |

## 💡 Pro Tips

### Tip 1: Test Different Designs

Create multiple templates:
- "Newsletter Template - Simple"
- "Newsletter Template - Fancy"
- "Newsletter Template - Holiday"

Change `template_id` in config to switch!

### Tip 2: Make Sections Reorderable

In your template, put each section in separate blocks:
- Header block
- Welcome block  
- Image block
- Events block (HTML with `{{params.EVENTS_HTML}}`)
- Footer block

Editor can drag-and-drop to reorder!

### Tip 3: Add More Variables

Want more automation? Edit `BrevoClient.php`:

```php
'params' => [
  'EVENTS_HTML' => $eventsHtml,
  'MONTH_YEAR' => date('F Y'),
  'CURRENT_YEAR' => date('Y'),
  'EVENT_COUNT' => $events->count(),
  'SITE_NAME' => $this->kirby->site()->title(),
]
```

Then use in template: `{{params.EVENT_COUNT}}` events this month!

### Tip 4: Style the Events

The events HTML uses inline styles. Want different styling?
Edit: `/site/plugins/brevo-newsletter/snippets/events-only.php`

Change colors, fonts, spacing, etc.

## 🔄 Monthly Workflow

### Admin/Editor Workflow:

**Week 1**: Add events in Kirby (as usual)

**Week 2**: 
1. Visit `/brevo-newsletter/preview`
2. Click "✏️ Draft in Brevo erstellen"
3. Brevo opens with WYSIWYG editor
4. Events already there!

**Week 3**:
1. Edit welcome text (just click and type!)
2. Add image of month (drag image block, upload)
3. Preview desktop & mobile
4. Send test to yourself
5. Schedule for Monday 10 AM

**Week 4**: Automatic send! Done! 🎉

**Time**: ~5-10 minutes

## 🆚 Comparison: Before vs After

### Before (HTML editing):
```
Admin creates draft
  ↓
Editor opens
  ↓
Sees HTML code 😱
  ↓
Needs to find <!-- EDIT THIS SECTION -->
  ↓
Copy-paste HTML examples
  ↓
Hope it works
  ↓
Test and send
```

### After (Template with WYSIWYG):
```
Admin creates draft
  ↓
Editor opens
  ↓
Sees beautiful WYSIWYG editor ✨
  ↓
Events already there!
  ↓
Click welcome text, type new text
  ↓
Drag image block, upload
  ↓
Test and send
```

**Winner**: Template approach! 🏆

## ❓ FAQ

### Q: Do I have to create a template?
**A:** No! If you don't set `template_id`, it works like before (HTML editor). But template is WAY better!

### Q: Can I change the template design later?
**A:** Yes! Just edit the template in Brevo. All future campaigns will use the updated design.

### Q: Can editor edit individual events?
**A:** Yes! Even though events are auto-generated, they're editable in the WYSIWYG editor.

### Q: What if I want different templates for different months?
**A:** Create multiple templates, change `template_id` in config as needed.

### Q: Can I have different templates for different languages?
**A:** Yes! Create templates for each language, detect language in code, use appropriate template ID.

### Q: Will old "Send Now" and "Schedule" buttons still work?
**A:** Yes! Those create campaigns without templates (immediate send). Perfect for emergencies.

### Q: Can I preview before creating draft?
**A:** Yes! The preview page shows what events will look like. Then create draft to see full template.

## 🔧 Troubleshooting

### "{{params.EVENTS_HTML}} is showing literally"
→ You forgot to use HTML block. Use HTML block, not Text block!

### "Template not found"
→ Check template ID is correct. Look in Brevo template URL.

### "Events not showing"
→ Make sure `{{params.EVENTS_HTML}}` is exactly spelled (case-sensitive!)

### "Editor still sees HTML"
→ Template ID not in config, or server not restarted

### "Images not loading"
→ Set `image_base_url` in config to your production URL

## 🎉 Success Checklist

- [ ] Template created in Brevo with drag-and-drop
- [ ] HTML block added with `{{params.EVENTS_HTML}}`
- [ ] Template ID noted
- [ ] Config updated with template ID
- [ ] Server restarted
- [ ] Test draft created → Opens in WYSIWYG!
- [ ] Events visible with images
- [ ] Welcome text editable
- [ ] Can add image of month
- [ ] Test send works
- [ ] 🎉 Perfect!

---

## 🎯 Summary

**This is THE solution you want!**

- ✅ Automated events (from Kirby)
- ✅ WYSIWYG editing (drag-and-drop)
- ✅ Easy for editors (no HTML)
- ✅ Professional results
- ✅ Fast workflow (5-10 min/month)

**Setup time**: 20 minutes once  
**Monthly time**: 5-10 minutes  
**Result**: Perfect newsletters every time! ✨

---

**Ready to set it up?** Follow Step 1 above and create your template in Brevo! 🚀

