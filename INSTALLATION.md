# 🚀 QUICK START GUIDE - AJWrites Portfolio

## ⚡ 5-Minute Setup

### Step 1: Install Local Server (Choose One)
- **XAMPP** (Windows/Mac/Linux): https://www.apachefriends.org/
- **WAMP** (Windows): https://www.wampserver.com/
- **MAMP** (Mac): https://www.mamp.info/

### Step 2: Copy Files
1. Extract all files
2. Copy to server folder:
   - XAMPP: `C:/xampp/htdocs/ajwrites/`
   - WAMP: `C:/wamp64/www/ajwrites/`
   - MAMP: `/Applications/MAMP/htdocs/ajwrites/`

### Step 3: Create Database
1. Start Apache & MySQL from your control panel
2. Open browser: `http://localhost/phpmyadmin`
3. Click "New" → Create database: `ajwrites_portfolio`

### Step 4: Configure (Optional)
Only if you're NOT using default settings:
1. Open `config.php`
2. Update:
   - `DB_HOST` (usually `localhost`)
   - `DB_USER` (usually `root`)
   - `DB_PASS` (usually empty)
   - `DB_NAME` (must be `ajwrites_portfolio`)

### Step 5: Run Setup
1. Open browser
2. Go to: `http://localhost/ajwrites/setup.php`
3. Wait for "Setup Complete!" message

### Step 6: You're Live! 🎉

**View Portfolio**: http://localhost/ajwrites/index.html

**Admin Panel**: http://localhost/ajwrites/admin-login.html
- Username: `admin`
- Password: `admin123`

---

## 📝 First Things To Do

1. ✅ Login to admin panel
2. ✅ **CHANGE PASSWORD** (very important!)
3. ✅ Add your real projects
4. ✅ Update services
5. ✅ Add testimonials
6. ✅ Customize colors in `index.html`
7. ✅ Update contact info in footer

---

## 🆘 Having Issues?

### "Connection failed"
- Check MySQL is running
- Verify database name in phpMyAdmin
- Double-check `config.php` settings

### "404 Not Found"
- Files in correct folder?
- Apache running?
- URL correct: `http://localhost/ajwrites/`

### "Unauthorized" in Admin
- Run `setup.php` again
- Clear browser cache
- Try different browser

---

## 🎯 File Checklist

Make sure you have ALL these files:

**Frontend:**
- ✅ index.html (main portfolio)
- ✅ admin-login.html (login page)
- ✅ admin-dashboard.html (admin panel)

**Backend:**
- ✅ config.php (database config)
- ✅ auth.php (authentication)
- ✅ api.php (CRUD operations)
- ✅ contact-handler.php (contact form)
- ✅ setup.php (database setup)

**Documentation:**
- ✅ README.md (full guide)
- ✅ INSTALLATION.md (this file)

---

## 💡 Pro Tips

1. **Backup**: Before making changes, backup your database from phpMyAdmin
2. **Testing**: Always test on localhost before deploying live
3. **Security**: Change admin password immediately after setup
4. **Updates**: Keep portfolio fresh with new projects regularly

---

## 🌐 Ready to Go Live?

When ready for production:

1. Export database from phpMyAdmin
2. Upload files to web hosting
3. Import database to live server
4. Update `config.php` with live credentials
5. Ensure HTTPS is enabled
6. Test thoroughly!

---

**Need More Help?** Check the full README.md file for detailed documentation.

**Let's Build Something Amazing! 🚀**
