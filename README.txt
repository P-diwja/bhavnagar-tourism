============================================================
  GoTrip Bhavnagar — SETUP INSTRUCTIONS (v3 — Full Build)
============================================================

WHAT'S NEW IN THIS VERSION
  ✅ home.php          — New entry point (User / Admin chooser)
  ✅ index.php         — Frontend (unchanged UI) + image upload in review form
  ✅ api/add_review.php — Image upload with MIME validation, 5 MB limit
  ✅ api/get_reviews.php — Returns image_path for display
  ✅ admin/reviews.php  — Image thumbnails, lightbox, delete removes file too
  ✅ admin/logout.php   — Now redirects back to home.php
  ✅ all-reviews.php    — Shows review photos with lightbox
  ✅ uploads/           — Secure folder (PHP blocked via .htaccess)
  ✅ setup_full.sql     — Updated schema (image_path + approved=0 default)
  ✅ migrate_reviews.sql — For existing installs (just adds image_path column)

------------------------------------------------------------
FOLDER STRUCTURE (place inside htdocs/gotrip/)
------------------------------------------------------------
  gotrip/
    home.php            ← NEW — entry point
    index.php           ← main frontend (renamed from final_version.html)
    db.php
    all-reviews.php
    reset_admin.php     ← DELETE after first use!
    setup_full.sql      ← fresh install DB
    migrate_reviews.sql ← for existing DB (adds image_path column only)
    uploads/
      .htaccess         ← security: blocks PHP in uploads
    admin/
      login.php
      logout.php        ← updated: redirects to home.php on logout
      dashboard.php
      places.php, foods.php, hotels.php, events.php
      nearby.php
      reviews.php       ← updated: images + lightbox + delete-with-file
      sidebar.php, auth_check.php
      admin_styles.css.php
    api/
      get_places.php, get_foods.php, get_hotels.php
      get_events.php, get_nearby.php
      get_reviews.php   ← updated: returns image_path
      add_review.php    ← updated: image upload + validation

------------------------------------------------------------
STEP 1 — START XAMPP
  Open XAMPP Control Panel → Start Apache + MySQL

------------------------------------------------------------
STEP 2A — FRESH INSTALL (no existing database)
  1. Go to http://localhost/phpmyadmin
  2. Click "New"
  3. click "Import" → choose setup_full.sql → Go

STEP 2B — EXISTING INSTALL (already have gotrip_db)
  Only need to add the new column. In phpMyAdmin:
  1. Select gotrip_db → click "SQL" tab
  2. Paste contents of migrate_reviews.sql → Go
  Done! Your existing reviews are untouched.

------------------------------------------------------------
STEP 3 — COPY FILES
  Copy the entire gotrip/ folder to:
    C:\xampp\htdocs\gotrip\

  Make sure the uploads/ folder exists and is writable:
    C:\xampp\htdocs\gotrip\uploads\   (XAMPP is writable by default)

------------------------------------------------------------
STEP 4 — SET ADMIN PASSWORD
  Visit: http://localhost/gotrip/reset_admin.php
  *** DELETE reset_admin.php immediately after! ***

------------------------------------------------------------
STEP 5 — DONE!
  Entry point:  http://localhost/gotrip/home.php
  Website:      http://localhost/gotrip/index.php
  Admin Panel:  http://localhost/gotrip/admin/login.php

  Admin credentials:
    Username: admin
    Password: admin@567

------------------------------------------------------------
NAVIGATION FLOW
  home.php
    ├─ [User button]  → opens index.php in a NEW TAB
    └─ [Admin button] → admin/login.php (same tab)

  index.php
    └─ Back button / Alt+Backspace → home.php

  admin/logout.php → home.php

------------------------------------------------------------
REVIEW SYSTEM — HOW IT WORKS
  1. User fills in name, rating, message on index.php
  2. Optional: attaches a photo (JPG/PNG/WEBP/GIF, max 5 MB)
  3. Review is saved with approved = 0 (pending)
  4. Admin logs in → Reviews section → clicks ✅ Approve
  5. Once approved, review appears live on the website

  Images are stored in:
    /uploads/YYYY/MM/review_<timestamp>_<random>.ext

  When admin deletes a review, the image file is also deleted
  from disk automatically.

------------------------------------------------------------
SECURITY FEATURES
  ✔ Prepared statements — no SQL injection possible
  ✔ finfo MIME validation — file type checked server-side (not just extension)
  ✔ 5 MB server-side size limit
  ✔ Unique randomised filenames (no guessable paths)
  ✔ uploads/.htaccess — blocks PHP execution in uploads folder
  ✔ htmlspecialchars() on all output
  ✔ strip_tags() on text inputs before DB insert
  ✔ session_regenerate_id() on admin login
============================================================
