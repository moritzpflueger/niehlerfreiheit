# 🚀 Brevo Newsletter - Setup Instructions

## ✅ What's Already Done

1. ✅ phpdotenv installed (for .env support)
2. ✅ .env added to .gitignore (security)
3. ✅ config.localhost.php created (loads .env automatically)
4. ✅ Date format bug fixed (events now show correctly)

## 📝 What You Need To Do Now

### Step 1: Create Your .env File

Create a file named `.env` in your project root (`/Users/moritz/Projects/niehlerfreiheit/.env`) with this content:

```env
# Brevo Newsletter Configuration
BREVO_API_KEY=your_api_key_here
BREVO_SENDER_EMAIL=newsletter@niehlerfreiheit.de
BREVO_TEST_EMAIL=moritz@example.com
```

**Replace with your actual values!**

### Step 2: Add Your Brevo List ID

Edit `/Users/moritz/Projects/niehlerfreiheit/site/config/config.localhost.php` and add your List ID:

```php
'list_ids' => [
  2, // Replace with your actual Brevo List ID
]
```

### Step 3: Restart Your Server

**Important!** You must restart the PHP server for .env changes to take effect:

```bash
# Stop your current server (Ctrl+C)
# Then restart it
php -S localhost:8080
```

### Step 4: Test It!

1. Visit: `http://localhost:8080/brevo-newsletter/preview`
2. You should now see:
   ```
   Enthaltene Events: 4
   • Test Event - 22.11.2025
   • Another Test event - 25.11.2025
   • Super test Event... - 27.11.2025
   • Test Event 4000 - 22.12.2025
   ```
3. Click "📨 Send Test Email"
4. Check your inbox!

## 🔧 Alternative: Quick Test Without .env

If you want to test immediately without restarting, edit `config.localhost.php` directly:

```php
'brevo-newsletter' => [
  'brevo_api_key' => 'xkeysib-your-actual-key-here',
  'sender_email' => 'newsletter@niehlerfreiheit.de',
  'sender_name' => 'Niehler Freiheit',
  'test_email' => 'moritz@example.com',
  'list_ids' => [2]
]
```

**Note:** Don't commit this file with real credentials!

## 📋 Checklist

Before sending your first newsletter:

- [ ] Create `.env` file with your credentials
- [ ] Add Brevo List ID to config
- [ ] Restart PHP server
- [ ] Visit preview page - see 4 events
- [ ] Send test email
- [ ] Verify test email received
- [ ] Check email looks good on mobile
- [ ] Send to all subscribers! 🚀

## 🆘 Still Getting Errors?

### "Test email not configured"
→ Make sure you restarted the server after creating .env

### "Brevo API key not configured"
→ Check .env file exists and has correct format (no quotes around values)

### "Enthaltene Events: 0"
→ This should be fixed now! The date format issue is resolved.

### Server won't restart
```bash
# Make sure no other process is using port 8080
lsof -ti:8080 | xargs kill -9
# Then restart
php -S localhost:8080
```

## 🎉 You're Almost There!

Just:
1. Fill in your `.env` file
2. Restart the server
3. Test!

---

**Need the full documentation?** See `site/plugins/brevo-newsletter/README.md`

