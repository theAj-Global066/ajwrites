# 🎨 AJWrites - Creative Content Writer Portfolio

A professional, client-centric portfolio website with a full-featured admin panel for managing content dynamically.

## 📋 Features

### Frontend Portfolio
- ✨ **Stunning Design**: Modern, conversion-focused design with smooth animations
- 📱 **Fully Responsive**: Perfect on all devices (mobile, tablet, desktop)
- 🎯 **Client-Centric**: Built with marketing psychology and conversion optimization
- ⚡ **Fast Performance**: Optimized for speed and SEO
- 🎨 **Beautiful Typography**: Premium fonts (Playfair Display + Work Sans)
- 📊 **Stats Section**: Showcase your achievements with dynamic counters
- 💼 **Services Display**: Highlight your service offerings
- 🖼️ **Portfolio Gallery**: Showcase your best work
- 💬 **Testimonials**: Build trust with client reviews
- 📧 **Contact Form**: Easy client communication

### Admin Panel
- 🔐 **Secure Authentication**: Login system with password hashing
- 📝 **Full CRUD Operations**: Create, Read, Update, Delete
- 🎨 **Manage Projects**: Add/edit/delete portfolio items
- 💼 **Manage Services**: Control your service offerings
- ⭐ **Manage Testimonials**: Add client reviews
- 📨 **Message Management**: View and respond to contact form submissions
- 📊 **Dashboard Overview**: See all your content at a glance
- 🎯 **User-Friendly Interface**: Clean, intuitive design

## 🗂️ File Structure

```
ajwrites-portfolio/
│
├── index.html              # Main portfolio homepage
├── admin-login.html        # Admin panel login page
├── admin-dashboard.html    # Admin dashboard with CRUD functionality
│
├── config.php             # Database configuration
├── auth.php               # Authentication handler
├── api.php                # REST API for all CRUD operations
├── setup.php              # Database setup script
│
└── README.md              # This file
```

## 🚀 Installation Instructions

### Prerequisites
- Web server (Apache/Nginx) with PHP support
- MySQL/MariaDB database
- PHP 7.4 or higher
- phpMyAdmin (optional, for database management)

### Step 1: Set Up Your Environment

**Option A: Using XAMPP (Recommended for Beginners)**
1. Download and install [XAMPP](https://www.apachefriends.org/)
2. Start Apache and MySQL from XAMPP Control Panel

**Option B: Using WAMP**
1. Download and install [WAMP](https://www.wampserver.com/)
2. Start WAMP server

**Option C: Using MAMP (Mac)**
1. Download and install [MAMP](https://www.mamp.info/)
2. Start MAMP server

### Step 2: Create Database

1. Open phpMyAdmin (usually at `http://localhost/phpmyadmin`)
2. Create a new database named `ajwrites_portfolio`
3. Click on the database name

### Step 3: Configure Database Connection

1. Open `config.php` in a text editor
2. Update these lines if your settings are different:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');           // Your MySQL username
define('DB_PASS', '');               // Your MySQL password
define('DB_NAME', 'ajwrites_portfolio');
```

### Step 4: Copy Files to Server

1. Copy ALL files to your web server directory:
   - **XAMPP**: `C:/xampp/htdocs/ajwrites/`
   - **WAMP**: `C:/wamp64/www/ajwrites/`
   - **MAMP**: `/Applications/MAMP/htdocs/ajwrites/`

### Step 5: Run Database Setup

1. Open your browser
2. Navigate to: `http://localhost/ajwrites/setup.php`
3. This will automatically:
   - Create all necessary tables
   - Insert default admin user
   - Add sample portfolio data

**Default Admin Credentials:**
- **Username**: `admin`
- **Password**: `admin123`

⚠️ **IMPORTANT**: Change this password after first login!

### Step 6: Access Your Portfolio

**Portfolio (Public)**: `http://localhost/ajwrites/index.html`

**Admin Panel**: `http://localhost/ajwrites/admin-login.html`

## 📖 Usage Guide

### Managing Portfolio Content

#### 1. Login to Admin Panel
- Navigate to `admin-login.html`
- Enter username: `admin`
- Enter password: `admin123`

#### 2. Manage Projects
- Click "Portfolio Projects" tab
- **Add**: Click "+ Add New Project" button
- **Edit**: Click "Edit" next to any project
- **Delete**: Click "Delete" (with confirmation)

**Project Fields:**
- Title (required)
- Category
- Description (required)
- Tags (comma-separated)
- Image URL

#### 3. Manage Services
- Click "Services" tab
- **Add**: Click "+ Add New Service"
- **Edit/Delete**: Same as projects

**Service Fields:**
- Title (required)
- Icon (emoji or text)
- Description (required)

#### 4. Manage Testimonials
- Click "Testimonials" tab
- **Add**: Click "+ Add New Testimonial"
- **Edit/Delete**: Same as projects

**Testimonial Fields:**
- Client Name (required)
- Client Title/Position
- Message (required)
- Rating (1-5 stars)

#### 5. View Messages
- Click "Messages" tab
- View all contact form submissions
- Mark as "Read" or "Responded"
- Badge shows count of new messages

## 🎨 Customization Guide

### Change Colors
Edit the CSS variables in `index.html`:

```css
:root {
    --primary: #1a1a1a;      /* Dark background */
    --accent: #ff6b35;        /* Orange accent color */
    --secondary: #f7f7f7;     /* Light background */
    --text: #333333;          /* Text color */
    --border: #e0e0e0;        /* Border color */
}
```

### Change Fonts
In `index.html`, replace the Google Fonts link:

```html
<link href="https://fonts.googleapis.com/css2?family=YOUR_FONT&display=swap" rel="stylesheet">
```

### Update Contact Information
Edit the footer section in `index.html`:

```html
<p class="text-center text-gray-600">
    📧 <strong>Email:</strong> YOUR_EMAIL &nbsp; | &nbsp; 
    📱 <strong>Phone:</strong> YOUR_PHONE
</p>
```

### Modify Stats
Update the stats section in `index.html`:

```html
<div class="stats-number" id="stat1">YOUR_NUMBER</div>
<p class="text-gray-600 mt-2 font-medium">YOUR_DESCRIPTION</p>
```

## 🔒 Security Best Practices

1. **Change Default Password**: Immediately after setup
2. **Use Strong Passwords**: Minimum 12 characters, mix of letters/numbers/symbols
3. **HTTPS**: Use SSL certificate for production
4. **Regular Backups**: Backup your database regularly
5. **Update Credentials**: Don't use default database credentials in production
6. **File Permissions**: Set appropriate file permissions on server

## 📊 Database Structure

### Tables

**projects**
- id, title, description, category, tags, image_url, created_at, updated_at

**services**
- id, title, description, icon, created_at, updated_at

**testimonials**
- id, client_name, client_title, message, rating, created_at, updated_at

**messages**
- id, name, email, service, message, status, created_at

**admin_users**
- id, username, password (hashed), email, created_at

## 🐛 Troubleshooting

### "Connection failed" Error
- Check database credentials in `config.php`
- Ensure MySQL is running
- Verify database name exists

### "404 Not Found"
- Check file paths match your server directory
- Ensure all files are in the correct folder
- Verify Apache/Nginx is running

### Admin Login Not Working
- Run `setup.php` again
- Check browser console for JavaScript errors
- Verify `auth.php` is in the same directory

### Images Not Displaying
- Check image URLs are correct
- Ensure images are in accessible directory
- Use full URLs for external images

## 💡 Tips for Success

1. **Content is King**: Fill with real, compelling content
2. **Professional Images**: Use high-quality portfolio images
3. **SEO Optimization**: Add meta tags and descriptions
4. **Regular Updates**: Keep portfolio fresh with new work
5. **Test Responsiveness**: Check on multiple devices
6. **Backup Often**: Regular database backups
7. **Monitor Messages**: Check admin panel regularly for inquiries

## 🎯 Next Steps

1. ✅ Set up the portfolio
2. ✅ Login to admin panel
3. ✅ Change default password
4. 📝 Add your real projects
5. 💼 Update services with your offerings
6. ⭐ Add client testimonials
7. 📧 Update contact information
8. 🎨 Customize colors/fonts to your brand
9. 📸 Add professional images
10. 🚀 Deploy to production server

## 📞 Support

For issues or questions:
1. Check this README thoroughly
2. Review the troubleshooting section
3. Check browser console for errors
4. Verify all files are in correct locations

## 📜 License

This portfolio template is provided as-is for personal and commercial use.

---

**Built with ❤️ for Creative Content Writers**

Transform your online presence and start attracting premium clients today! 🚀
