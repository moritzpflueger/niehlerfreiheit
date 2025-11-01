# 📝 Newsletter Editor Guide - Simple Version

## 🎯 Two Options for Editors

### Option A: Quick Edit HTML (10 minutes)
**Best for**: Adding welcome text & image of month  
**Skill needed**: Copy-paste (very minimal HTML)

### Option B: Full Custom Design (30 minutes first time)
**Best for**: Fully customized design each month  
**Skill needed**: Using Brevo's visual editor (like Word)

---

## ✅ Option A: Edit HTML Draft (RECOMMENDED)

### What You Get Automatically:
- ✅ All events with images
- ✅ All styling done
- ✅ All formatting done
- ✅ Responsive mobile design
- ✅ All links working

### What You Need to Add:
- Welcome paragraph (your personal message)
- Image of the month (optional)

### Step-by-Step:

#### 1. Create Draft
1. Admin clicks **"✏️ Draft in Brevo erstellen"**
2. Brevo opens in new tab

#### 2. Find Editable Section
In Brevo's HTML editor, look for this:
```html
<!-- ============================================ -->
<!-- EDITOR: EDIT THIS SECTION -->
<!-- Add your welcome text here -->
<!-- ============================================ -->
```

#### 3. Add Your Welcome Text
Replace the example text with yours:

**Before:**
```html
<p>Hallo liebe Freund:innen,</p>
<p>hier sind die kommenden Veranstaltungen im Niehler Freiheit:</p>
```

**After:**
```html
<p>Hallo liebe Freund:innen,</p>
<p>Der November ist da und mit ihm viele spannende Events!</p>
<p>Wir freuen uns besonders auf unser Highlight: das Konzert am 22.11.</p>
<p>Hier findet ihr alle kommenden Veranstaltungen:</p>
```

#### 4. Add Image of the Month (Optional)
Copy this code and replace the URL:

```html
<img src="https://your-domain.com/image.jpg" alt="Image of the Month" style="width: 100%; max-width: 600px; margin: 20px 0; border-radius: 8px;">
<p style="text-align: center; font-style: italic; color: #666;">Unser Highlight im November</p>
```

**Where to upload image?**
- Option 1: Upload to your Kirby site media
- Option 2: Use Brevo's image library
- Option 3: Use image hosting service

#### 5. Preview & Send
1. Click **"Preview"** in Brevo
2. Check desktop & mobile
3. Send test to yourself
4. If good → **Schedule** or **Send now**

### HTML Cheat Sheet for Editors

**Add a paragraph:**
```html
<p>Your text here</p>
```

**Add bold text:**
```html
<p><strong>Important text</strong> normal text</p>
```

**Add a link:**
```html
<p>Visit <a href="https://your-site.com">our website</a> for more info</p>
```

**Add an image:**
```html
<img src="image-url-here" alt="description" style="width: 100%; max-width: 600px; margin: 20px 0;">
```

**Add spacing:**
```html
<div style="height: 30px;"></div>
```

That's it! You only need these 5 patterns.

---

## 🎨 Option B: Full Custom Design

If you want complete design freedom:

### Step 1: Copy Event Info
1. Go to Kirby preview: `/brevo-newsletter/preview`
2. Click **"📋 Events als Text kopieren"**
3. Event info copied to clipboard

### Step 2: Create Campaign in Brevo
1. Go to: [Brevo Campaigns](https://app.brevo.com/camp/listing/message)
2. Click: **"Create a campaign"**
3. Choose: **"Drag & Drop editor"** ← Important!
4. Name it: "Newsletter [Month] [Year]"

### Step 3: Design Your Newsletter
Use drag-and-drop blocks:

**Header:**
- Drag "Text" block
- Type: "Niehler Freiheit - November 2025"
- Make it H1, center-aligned

**Welcome Section:**
- Drag "Text" block
- Write your welcome message
- Format as you like

**Image of the Month:**
- Drag "Image" block
- Upload image
- Add caption

**Events Section:**
- Drag "Text" block for each event
- Paste info from clipboard
- Format using toolbar
- Add dividers between events

**Footer:**
- Drag "Text" block
- Add links and legal info

### Step 4: Send
1. Preview desktop & mobile
2. Send test
3. Schedule or send

**First time**: ~30 minutes  
**After that**: Duplicate last month's campaign = ~10 minutes!

---

## 🤷 Which Option Should I Use?

| Situation | Best Option |
|-----------|-------------|
| First time ever | Option A (easier to learn) |
| Just need to add welcome text | Option A (faster) |
| Want custom design/layout | Option B (more flexible) |
| Every month same structure | Option B + Duplicate previous |
| Tight deadline | Option A (quicker) |
| Time to be creative | Option B (more fun!) |

## 💡 Pro Tip: Hybrid Approach

**First month:**
1. Use Option A (edit HTML draft)
2. Add welcome text & image
3. Send

**Second month:**
1. In Brevo, find last month's campaign
2. Click "Duplicate"
3. Edit welcome text
4. Replace image of month
5. Events are old → Replace manually from Kirby preview
6. Send

**Result**: Gets easier each month!

## ⏱️ Time Comparison

| Task | Option A (Edit HTML) | Option B (Full Custom) |
|------|---------------------|----------------------|
| First time | 10-15 min | 30-45 min |
| Second time | 5-10 min | 10-15 min (duplicate) |
| Monthly avg | 5-10 min | 10-15 min |

## 🆘 Common Questions

### Q: I'm scared of breaking the HTML!
**A:** You can't really break it! The editable section is clearly marked. Worst case: create a new draft.

### Q: How do I know if my HTML is correct?
**A:** Use the Preview button in Brevo. If it looks good, it's correct!

### Q: Can I see what the HTML examples look like?
**A:** Yes! Create a draft, add an example, preview it. If you don't like it, delete and try again.

### Q: What if I want more control than Option A but Option B is too complex?
**A:** Start with Option A. Once comfortable with basic HTML, you'll naturally learn more. Or try Option B - Brevo's drag-and-drop is very user-friendly!

### Q: Do I need to learn HTML?
**A:** For Option A: Just 5 patterns (shown above)  
For Option B: No HTML at all!

## 📚 Learning Resources

**Option A (Basic HTML):**
- [W3Schools HTML Basics](https://www.w3schools.com/html/) (15 min read)
- Practice with our examples above

**Option B (Brevo Editor):**
- [Brevo Drag-and-Drop Guide](https://help.brevo.com/)
- [Video Tutorial](https://www.youtube.com/brevo) (5 min)

---

## 🎯 Quick Start Checklist

**First Newsletter:**
- [ ] Admin creates draft in Kirby
- [ ] Brevo opens with draft
- [ ] Find "EDITOR: EDIT THIS SECTION" comment
- [ ] Copy-paste example code for welcome text
- [ ] Replace text with your message
- [ ] (Optional) Add image of month
- [ ] Preview in Brevo
- [ ] Send test to yourself
- [ ] Looks good? Schedule or send!
- [ ] 🎉 Done!

**Time**: ~10 minutes after first try

---

**Remember**: The events are already perfectly formatted with images! You just add your personal touch on top. 🎨

