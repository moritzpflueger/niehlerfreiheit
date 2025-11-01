# ✏️ Brevo WYSIWYG Editor - The Reality & Solutions

## 🔍 The Issue

**Brevo's API limitation**: When creating campaigns via API with HTML content, they only support the **HTML editor** (code view), not the **drag-and-drop WYSIWYG editor**.

The drag-and-drop editor is **only available** when creating campaigns manually in Brevo's UI.

## ✅ Best Solution: Manual Campaign Creation

Here's the recommended workflow that gives editors full WYSIWYG control:

### The New Workflow:

```
1. Admin visits Kirby preview page
   ↓
2. Reviews events, sends test email
   ↓
3. Clicks "📋 Events als Text kopieren"
   ↓
4. Text with all events copied to clipboard
   ↓
5. Editor opens Brevo directly
   ↓
6. Creates new campaign with drag-and-drop editor
   ↓
7. Adds welcome text, images, styling
   ↓
8. Pastes event information from clipboard
   ↓
9. Sends or schedules from Brevo
```

## 📋 Step-by-Step Guide

### For Admin: Preparing Event Information

1. **Visit** `/brevo-newsletter/preview`
2. **Click** "📋 Events als Text kopieren" (collapsible section)
3. **Click** inside text area → auto-selects and copies
4. **Share** clipboard with editor (or editor does this themselves)

### For Editor: Creating Newsletter in Brevo

#### Step 1: Create Campaign in Brevo

1. **Go to**: [https://app.brevo.com/camp/listing/message](https://app.brevo.com/camp/listing/message)
2. **Click**: "Create a campaign"
3. **Select**: "Regular campaign"
4. **Choose**: "Drag & Drop editor" ← This is the key!
5. **Click**: "Continue"

#### Step 2: Design Your Newsletter

**Add Header:**
1. Drag **"Text"** block to top
2. Type: "Niehler Freiheit - Veranstaltungen [Month]"
3. Style as heading (H1)
4. Center align

**Add Welcome Section:**
1. Drag **"Text"** block
2. Write welcome message:
   ```
   Hallo liebe Freund:innen,
   
   hier sind die kommenden Veranstaltungen im [Month]:
   ```

**Add Image of the Month (Optional):**
1. Drag **"Image"** block
2. Upload image
3. Add caption if desired

**Add Events:**
1. **Paste** the copied event text (from Kirby preview)
2. **Format** using WYSIWYG toolbar:
   - Make event titles bold/larger
   - Add spacing/dividers between events
   - Color-code categories
   - Add emoji if desired

**Add Footer:**
1. Drag **"Divider"** block
2. Drag **"Text"** block
3. Add links: Website | Impressum | Datenschutz

#### Step 3: Configure & Send

1. **Recipients**: Select your list(s)
2. **Subject**: Write compelling subject line
3. **Preview text**: First line shown in inbox
4. **Preview**: Check desktop & mobile
5. **Test send**: Send to yourself
6. **Schedule or Send**: Choose send time

## 🎨 What Editors Can Do (Full WYSIWYG)

### Content Blocks Available:
- ✅ Text (with rich formatting)
- ✅ Images (upload, resize, link)
- ✅ Buttons (styled CTAs)
- ✅ Dividers (visual separators)
- ✅ Social icons (with links)
- ✅ Video (YouTube/Vimeo embeds)
- ✅ Columns (multi-column layouts)
- ✅ Spacer (control spacing)
- ✅ HTML (custom code if needed)

### Styling Options:
- Font family, size, color
- Background colors
- Padding/margins
- Borders and shadows
- Alignment
- Mobile responsiveness (automatic!)

### Template Features:
- **Save as template** for reuse
- **Duplicate last month's** newsletter
- **A/B testing** different versions
- **Personalization** with contact fields

## 💡 Pro Tips

### Tip 1: Create a Template

**First time:**
1. Design newsletter in Brevo with full WYSIWYG
2. Save as template: "Newsletter Template"

**Every month:**
1. Create campaign from template
2. Update event section with new info
3. Send!

### Tip 2: Use Duplicates

**After first send:**
1. Go to previous campaign
2. Click "Duplicate"
3. Update event section
4. Change date in subject
5. Send!

### Tip 3: Keep Kirby HTML for Backup

The "✏️ Draft in Brevo erstellen" button still works great for:
- **Quick sends** (no customization needed)
- **Emergency newsletters**
- **Backup copy** with all events formatted
- **Starting point** to copy HTML from

## 📊 Comparison: Methods

| Method | WYSIWYG | Setup Time | Flexibility | Best For |
|--------|---------|------------|-------------|----------|
| **Manual in Brevo** | ✅ Full | ~15 min first time | ⭐⭐⭐⭐⭐ | **RECOMMENDED** |
| **Draft from Kirby** | ❌ HTML only | ~2 min | ⭐⭐ | Quick/emergency |
| **Send Now from Kirby** | ❌ None | ~30 sec | ⭐ | Auto-sends only |

## 🔄 Recommended Monthly Workflow

### Week 1: Content Preparation
- Add/update events in Kirby
- Events go live on website

### Week 2: Newsletter Creation
- Admin checks Kirby preview
- Copies event text
- Editor creates campaign in Brevo with drag-and-drop
- Adds welcome text, images, styling
- Saves as draft

### Week 3: Review & Schedule
- Editor reviews draft
- Sends test email
- Makes final adjustments
- Schedules for Monday 10 AM

### Week 4: Send & Monitor
- Brevo sends automatically
- Monitor opens/clicks
- Review performance

**Time investment**: ~20-30 minutes/month  
**Result**: Professional, customized newsletters ✨

## ❓ FAQ

### Q: Why can't the API create drag-and-drop campaigns?

**A:** Brevo's API limitation. The drag-and-drop editor uses a proprietary format that's not exposed via API. Only HTML campaigns can be created programmatically.

### Q: Can we at least get close?

**A:** The "✏️ Draft" button creates an HTML campaign. Editors can:
- Edit HTML (if comfortable)
- Use as reference
- Copy HTML into Brevo's "Code your own" option

But for true WYSIWYG, manual creation in Brevo is required.

### Q: Is manual creation really better?

**A:** Yes! Benefits:
- ✅ Full visual editor
- ✅ No HTML knowledge needed
- ✅ More design flexibility
- ✅ Easier for editors
- ✅ Can save as templates

### Q: What if editor isn't comfortable with Brevo?

**A:** First time might take 30 min, but:
- Brevo's editor is very user-friendly (like Word)
- After first time, they can duplicate previous campaigns
- Templates make it even faster
- Worth the small learning curve

### Q: Should we remove the "Draft" button?

**A:** No! Keep it for:
- Admins who know HTML
- Emergency sends
- Quick newsletters without customization
- Backup/reference

## 📚 Resources

### Brevo Help:
- [Drag & Drop Editor Guide](https://help.brevo.com/)
- [Video: Creating Campaigns](https://www.youtube.com/brevo)
- [Email Design Best Practices](https://www.brevo.com/blog/)

### Getting Started:
1. [Create Brevo account](https://www.brevo.com/)
2. [Watch 5-min tutorial](https://help.brevo.com/)
3. [Create first campaign](https://app.brevo.com/)

## 🎯 Summary

### The Reality:
API-created campaigns = HTML editor only  
Manual campaigns = Full WYSIWYG ✨

### The Solution:
1. Use Kirby preview to see/copy events
2. Create campaign manually in Brevo
3. Enjoy full WYSIWYG editing
4. Save as template for future use

### The Result:
- 🎨 Beautiful, customized newsletters
- ✏️ Easy editing for non-technical editors
- ⚡ Fast workflow after first time
- 💪 Full control over design

---

**Bottom line**: Manual creation in Brevo is actually the BETTER approach - more flexibility, easier for editors, and better results! 🎉

