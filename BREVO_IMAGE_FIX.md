# 🖼️ Fix: Images Not Showing in Emails

## The Problem

When testing on `localhost:8080`, images in emails show as broken because:
- Image URLs are `http://localhost:8080/media/...`
- Email clients can't access your localhost
- They need publicly accessible URLs

## The Solution

You have **3 options**:

---

### Option 1: Use Production URL for Images (Recommended for Testing)

**If you have a production site** (e.g., `https://niehlerfreiheit.de`):

Add to your `.env`:
```env
BREVO_IMAGE_BASE_URL=https://niehlerfreiheit.de
```

Restart server:
```bash
kill -9 $(lsof -ti:8080); cd /Users/moritz/Projects/niehlerfreiheit && php -S localhost:8080 > /dev/null 2>&1 &
```

**Result**: Newsletter will use production images even when testing locally ✅

---

### Option 2: Use a Staging/Dev Server

If you have a dev server accessible online:
```env
BREVO_IMAGE_BASE_URL=https://dev.niehlerfreiheit.de
```

---

### Option 3: Upload to Public Host Temporarily

Use a free image host for testing:
- [Cloudinary](https://cloudinary.com/) (free tier)
- [Imgur](https://imgur.com/)
- Your own server

Then configure:
```env
BREVO_IMAGE_BASE_URL=https://your-image-host.com
```

---

## What About Production?

When you deploy to production, **no configuration needed!** Images will work automatically because the site URL will be public.

## Quick Test

1. **Do you have a production site?**
   - ✅ Yes → Use Option 1 (production URL)
   - ❌ No → Wait until deployed, or use placeholders

2. **Add to `.env`:**
   ```env
   BREVO_IMAGE_BASE_URL=https://niehlerfreiheit.de
   ```

3. **Restart server:**
   ```bash
   kill -9 $(lsof -ti:8080); cd /Users/moritz/Projects/niehlerfreiheit && php -S localhost:8080 > /dev/null 2>&1 &
   ```

4. **Send test email** → Images should now work! 🎉

## How It Works

```
Without config:
localhost:8080/media/page.png → ❌ Not accessible in email

With BREVO_IMAGE_BASE_URL:
https://niehlerfreiheit.de/media/page.png → ✅ Works everywhere!
```

## Alternative: Test Without Images

If you just want to test the email functionality without worrying about images:

1. Remove event images temporarily
2. Use placeholder image
3. Test email structure/layout/text
4. Add images back when deploying

---

## FAQ

**Q: Will this affect my local development?**  
A: No, only affects the newsletter emails. Your site still works normally.

**Q: Do I need to upload images twice?**  
A: No, images only need to be on your production server. The newsletter will reference them from there.

**Q: What if I don't have a production site yet?**  
A: Test without images for now, or use a free image host temporarily.

**Q: Will images work when I deploy?**  
A: Yes! No configuration needed. Just remove `BREVO_IMAGE_BASE_URL` from production config.

---

**Ready to test?** Add the `BREVO_IMAGE_BASE_URL` to your `.env` and restart! 🚀

