============================================================
  GoTrip Bhavnagar — SETUP INSTRUCTIONS (v3 — Full Build)
============================================================

## 🌐 Live Demo
Check it out here: [GoTrip]( https://gotrip.great-site.net/ )

---

## ⚠️ IMPORTANT — READ BEFORE STARTING

- There is NO default admin account — you MUST run reset_admin.php first
- Without running reset_admin.php you CANNOT login to the admin panel
- Never commit real passwords or db.php credentials to GitHub
- Delete reset_admin.php immediately after setting your credentials

---

## WHAT'S INCLUDED

```
✅ index.php              — Frontend + image upload in review form
✅ api/add_review.php     — Image upload with MIME validation, 5 MB limit
✅ api/get_reviews.php    — Returns image_path for display
✅ admin/reviews.php      — Image thumbnails, lightbox, delete removes file too
✅ admin/logout.php       — Redirects back to home.php
✅ all-reviews.php        — Shows review photos with lightbox
✅ uploads/               — Secure folder (PHP blocked via .htaccess)
✅ setup_full.sql         — Full database schema (no default admin)
✅ migrate_reviews.sql    — For existing installs (adds image_path column)
✅ reset_admin.php        — Creates your admin account (DELETE AFTER USE)
```

---

## FOLDER STRUCTURE
Place inside `htdocs/gotrip/`:

```
gotrip/
  index.php
  db.php
  all-reviews.php
  reset_admin.php        ← DELETE after first use!
  setup_full.sql
  migrate_reviews.sql
  uploads/
    .htaccess            ← blocks PHP execution in uploads
  admin/
    login.php
    logout.php
    dashboard.php
    places.php, foods.php, hotels.php, events.php
    nearby.php
    reviews.php
    sidebar.php, auth_check.php
    admin_styles.css.php
  api/
    get_places.php, get_foods.php, get_hotels.php
    get_events.php, get_nearby.php
    get_reviews.php
    add_review.php
```

---

## STEP 1 — START XAMPP
Open XAMPP Control Panel → Start **Apache** + **MySQL**

---

## STEP 2 — CONFIGURE DATABASE CONNECTION
Open `db.php` and fill in your own values:

```php
$host     = 'localhost';        // usually localhost for XAMPP
$dbname   = 'gotrip_db';       // your database name
$username = 'root';            // your MySQL username
$password = 'YOUR_PASSWORD';   // your MySQL password (blank for XAMPP default)
```

---

## STEP 3A — FRESH INSTALL (no existing database)
1. Go to `http://localhost/phpmyadmin`
2. Click **New** → name it `gotrip_db` → Create
3. Click **Import** → choose `setup_full.sql` → Go

## STEP 3B — EXISTING INSTALL (already have gotrip_db)
1. Select `gotrip_db` → click **SQL** tab
2. Paste contents of `migrate_reviews.sql` → Go

Your existing data will not be affected.

---

## STEP 4 — COPY FILES
Copy the entire `gotrip/` folder to:
```
C:\xampp\htdocs\gotrip\
```
Make sure the `uploads/` folder exists and is writable.

---

## STEP 5 — CREATE YOUR ADMIN ACCOUNT
This is mandatory — without this step you cannot login at all.

1. Open `reset_admin.php` and set your own username and password:
   ```php
   $new_username = 'YOUR_USERNAME';   // ← choose your username
   $new_password = 'YOUR_PASSWORD';   // ← choose a strong password
   ```
2. Save the file
3. Visit: `http://localhost/gotrip/reset_admin.php`
4. You will see a success screen showing your username and password
5. **DELETE `reset_admin.php` immediately after!**

> ⚠️ You can set ANY username — it does not have to be "admin"
> ⚠️ Use a strong password — mix letters, numbers and symbols
> ⚠️ If you want to change credentials later, repeat this step

---

## STEP 6 — DONE!

| URL | Purpose |
|-----|---------|
| `http://localhost/gotrip/home.php` | Entry point |
| `http://localhost/gotrip/index.php` | Main website |
| `http://localhost/gotrip/admin/login.php` | Admin panel |

Login using the username and password you set in Step 5.

---

## HOW TO RESET / CHANGE ADMIN PASSWORD LATER

If you forget your password or want to change credentials:

1. Add `reset_admin.php` back to your project root
2. Open it and set your new username and password:
   ```php
   $new_username = 'YOUR_NEW_USERNAME';
   $new_password = 'YOUR_NEW_PASSWORD';
   ```
3. Visit: `http://localhost/gotrip/reset_admin.php`
4. Old admin account is wiped and new one is created in the database
5. Delete `reset_admin.php` again immediately after!

> ⚠️ reset_admin.php wipes ALL existing admin rows before creating the new one
> so you never end up with duplicate or leftover accounts

---

## NAVIGATION FLOW
```
home.php
  ├─ [User button]  → opens index.php in a new tab
  └─ [Admin button] → admin/login.php (same tab)

index.php
  └─ Back button → home.php

admin/logout.php → home.php
```

---

## REVIEW SYSTEM — HOW IT WORKS
1. User fills in name, rating, message on `index.php`
2. Optional: attaches a photo (JPG/PNG/WEBP/GIF, max 5 MB)
3. Review is saved with `approved = 0` (pending)
4. Admin logs in → Reviews section → clicks ✅ Approve
5. Once approved, review appears live on the website

Images are stored in: `/uploads/YYYY/MM/review_<timestamp>_<random>.ext`

When admin deletes a review, the image file is also deleted from disk automatically.

---

## SECURITY FEATURES
- ✔ No default admin credentials — you set your own
- ✔ Passwords stored as bcrypt hash — never plain text
- ✔ Login checks database — no hardcoded credentials
- ✔ Prepared statements — no SQL injection possible
- ✔ finfo MIME validation — file type checked server-side
- ✔ 5 MB server-side size limit
- ✔ Unique randomised filenames (no guessable paths)
- ✔ uploads/.htaccess — blocks PHP execution in uploads folder
- ✔ htmlspecialchars() on all output
- ✔ strip_tags() on text inputs before DB insert
- ✔ session_regenerate_id() on admin login

---

## .gitignore RECOMMENDATION
Before pushing to GitHub, create a `.gitignore` file in your project root:

```
db.php
reset_admin.php
uploads/
```

This prevents accidentally pushing your live database credentials
or the reset file if you forget to delete it.

---

## CONTRIBUTING / FORKING
If you fork or clone this project:
- Never hardcode real passwords anywhere in the codebase
- Always set your own credentials via reset_admin.php
- Keep reset_admin.php out of production servers

============================================================
