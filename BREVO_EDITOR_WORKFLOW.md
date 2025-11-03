# ✏️ Brevo Newsletter - Editor Workflow

## 🎯 New Feature: Draft Campaigns

I've added a new button **"✏️ Draft in Brevo erstellen"** that creates an editable campaign in Brevo's WYSIWYG editor!

## 📝 How It Works

### The New Recommended Workflow:

```
1. Admin visits /brevo-newsletter/preview
   ↓
2. Clicks "✏️ Draft in Brevo erstellen"
   ↓
3. Plugin creates draft campaign with all events
   ↓
4. Brevo editor opens automatically
   ↓
5. Editor adds custom content:
   - Welcome text
   - "Image of the month"
   - Adjust event descriptions
   - Rearrange sections
   - Preview on mobile
   ↓
6. Editor clicks "Send" or "Schedule" in Brevo
   ↓
7. Done! 🎉
```

## 🆚 Comparison: All Methods

| Method | Use Case | Customization | Who Sends |
|--------|----------|---------------|-----------|
| **📨 Test Email** | Testing content | None (fixed HTML) | Automatic |
| **✏️ Create Draft** | ⭐ **RECOMMENDED** | Full WYSIWYG editing | Editor in Brevo |
| **🚀 Send Now** | Emergency/simple newsletters | None | Automatic |
| **📅 Schedule** | Auto-send at specific time | None | Automatic |

## ✨ What Editors Can Do in Brevo

Once the draft is created, editors can:

### ✅ Add Content Blocks
- **Text blocks** - Welcome message, intro, outro
- **Image blocks** - "Image of the month", sponsor logos
- **Dividers** - Visual separators
- **Buttons** - Custom CTAs
- **Social media** - Social icons with links

### ✅ Edit Existing Content
- **Modify event text** - Shorten, expand, rewrite
- **Rearrange events** - Drag & drop
- **Change styling** - Colors, fonts, spacing
- **Hide events** - Remove if needed

### ✅ Design Features
- **Mobile preview** - See how it looks on phones
- **Test sending** - Send to own email
- **A/B testing** - Test different subject lines
- **Scheduling** - Pick exact send time

## 📋 Step-by-Step Guide

### For Admin: Creating the Draft

1. **Visit** `/brevo-newsletter/preview`
2. **Review** events list and preview
3. **Click** "✏️ Draft in Brevo erstellen"
4. **Confirm** dialog
5. **Wait** for success message
6. **Brevo editor opens** in new tab
7. ✅ **Done!** Now editor can take over

### For Editor: Editing in Brevo

1. **Brevo editor opens** (or go to Campaigns → find draft)
2. **See your events** already in the email
3. **Add intro section**:
   - Click "+" button at top
   - Choose "Text block"
   - Write welcome message
4. **Add image of the month**:
   - Click "+" button
   - Choose "Image block"
   - Upload image
5. **Edit event descriptions** if needed:
   - Click on any event text
   - Edit directly
6. **Preview**:
   - Click "Preview" button
   - Check desktop & mobile
7. **Test send**:
   - Click "Send test"
   - Enter your email
   - Check inbox
8. **Send or Schedule**:
   - Click "Next" → "Schedule" or "Send now"
   - Choose date/time (if scheduling)
   - Confirm
9. 🎉 **Done!**

## 💡 Example: Adding Welcome Text

In Brevo editor:

1. **Click** "+" button above first event
2. **Select** "Text" block
3. **Write**: 
   ```
   Hallo liebe Freund:innen der Niehler Freiheit!
   
   Der November ist da und mit ihm ein spannendes Programm.
   Hier findet ihr alle kommenden Veranstaltungen:
   ```
4. **Style** using toolbar (bold, italic, alignment)
5. **Save** automatically

## 🖼️ Example: Adding Image of the Month

1. **Click** "+" button (anywhere you want)
2. **Select** "Image" block
3. **Upload** your image
4. **Add caption** (optional)
5. **Link** to page (optional)
6. **Adjust size** using handles
7. **Save** automatically

## 🎨 Brevo Editor Features

### Text Editing
- Bold, italic, underline
- Headings (H1, H2, H3)
- Font size, color
- Alignment
- Lists (bullet, numbered)

### Content Blocks
- Text
- Image
- Button
- Divider
- Social icons
- Video (YouTube, Vimeo)
- Custom HTML

### Layout
- Single column (default)
- Two columns
- Three columns
- Custom layouts

### Design
- Background colors
- Padding/spacing
- Borders
- Border radius

## 📱 Mobile Optimization

Always check mobile preview:
1. Click "Preview" in Brevo
2. Select "Mobile" tab
3. Check:
   - Text readable?
   - Images sized correctly?
   - Buttons tappable?
   - Spacing good?

## ⚙️ Settings You Can Change in Brevo

### Campaign Settings
- **Name**: Change from "Newsletter DRAFT - [date]"
- **Subject**: Customize subject line
- **Preview text**: First line shown in inbox
- **From name**: Keep as "Niehler Freiheit"
- **Reply-to**: Set different reply address

### Recipient Settings
- **Lists**: Already set (from config)
- **Exclusion lists**: Exclude certain groups
- **A/B test**: Test different versions

### Tracking
- **Opens**: Track who opens (enabled by default)
- **Clicks**: Track link clicks (enabled by default)
- **Google Analytics**: Add UTM parameters

## 🔄 Monthly Workflow Example

### Week 1: Content Ready
- Admin adds/updates events in Kirby
- Events are live on website

### Week 2: Create Draft
- Admin visits preview page
- Clicks "Create Draft"
- Draft created in Brevo

### Week 3: Editor Customization
- Editor opens draft in Brevo
- Adds welcome text
- Adds image of the month
- Adds sponsor logo (if any)
- Previews and tests
- Schedules for next Monday 10:00 AM

### Week 4: Automatic Send
- Brevo sends automatically on Monday 10:00 AM
- Editor monitors opens/clicks in dashboard
- Reviews performance

## 🚨 Important Notes

### ⚠️ Draft vs. Send Now

**Create Draft** (✏️):
- ✅ Full editing capability
- ✅ Editor can customize
- ✅ Can schedule later
- ✅ Can delete if mistake
- ⏰ Requires manual send from Brevo

**Send Now** (🚀):
- ❌ No editing after click
- ❌ Sends immediately
- ❌ Cannot cancel
- ✅ Fastest for urgent sends

### 🎯 Best Practices

1. **Always create draft** unless urgent
2. **Test send first** from Brevo editor
3. **Check mobile preview** before sending
4. **Schedule for business hours** (10 AM - 2 PM)
5. **Send on same day each month** (consistency)
6. **Monitor analytics** after sending

## 🔍 Finding Your Drafts in Brevo

If the editor window doesn't auto-open:

1. Go to: [https://app.brevo.com/](https://app.brevo.com/)
2. Click: **Campaigns** → **Email Campaigns**
3. Filter by: **Status: Draft**
4. Look for: **"Newsletter DRAFT - [date]"**
5. Click: **Edit** button
6. Starts editing!

## 📊 After Sending: View Statistics

1. **Campaigns** → **Email Campaigns**
2. **Click** on sent campaign
3. **See**:
   - Total sent
   - Delivered
   - Opens (%)
   - Clicks (%)
   - Bounces
   - Unsubscribes
4. **Export** data if needed

## 🆘 Troubleshooting

### "Can't find the draft"
→ Check Campaigns → filter by "Draft" status

### "Editor not opening"
→ Manually go to: `https://app.brevo.com/camp/listing/message`

### "Can't edit events"
→ You can! Click directly on event content to edit

### "Lost my changes"
→ Brevo auto-saves, check draft in Campaigns list

### "Want to start over"
→ Delete draft, create new one from Kirby

## 🎉 Summary

### Old Way (Limiting):
```
Kirby → Generate HTML → Send (no editing)
```

### New Way (Flexible):
```
Kirby → Generate events → Create Draft → 
Edit in Brevo → Add custom content → Send
```

**Result**: Best of both worlds!
- Automated event content ✅
- Editor customization ✅
- WYSIWYG editing ✅
- Professional campaigns ✅

---

**Ready to try it?** Visit the preview page and click "✏️ Draft in Brevo erstellen"! 🚀

