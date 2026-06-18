<?php
/**
 * GoTrip Admin Password Reset
 * Visit: http://localhost/gotrip/reset_admin.php
 * DELETE this file after use!
 */
require_once 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GoTrip – Admin Setup</title>
<style>
body{font-family:sans-serif;background:#0a0a0a;color:#e0e0e0;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
.card{background:#1a1a1a;border:1px solid #333;border-radius:12px;padding:36px 40px;max-width:480px;width:100%}
h2{margin:0 0 20px;font-size:22px}
.success{color:#22c55e} .error{color:#ef4444} .info{color:#00c2ff}
p{margin:8px 0;line-height:1.6}
.cred{background:#0d1117;border:1px solid #333;border-radius:8px;padding:14px 18px;margin:16px 0;font-family:monospace;font-size:15px}
.cred span{color:#22c55e;font-weight:bold}
a{color:#00c2ff;font-weight:bold;text-decoration:none}
.warn{background:#2a1a00;border:1px solid #f59e0b;border-radius:8px;padding:12px 16px;color:#f59e0b;margin-top:20px;font-size:13px}
hr{border:none;border-top:1px solid #333;margin:20px 0}
</style>
</head>
<body>
<div class="card">
<?php
$new_password = 'YOUR_CHOSEN_PASSWORD'';
$hash = password_hash($new_password, PASSWORD_DEFAULT);

// Wipe and re-insert with fresh PHP-generated hash
$conn->query("DELETE FROM admins WHERE username='admin'");
$safe_hash = $conn->real_escape_string($hash);
$ok = $conn->query("INSERT INTO admins (username, password) VALUES ('admin', '$safe_hash')");

if ($ok):
?>
  <h2 class="success">✅ Admin Password Set!</h2>
  <p>Admin account is ready. Use these credentials to login:</p>
  <div class="cred">
    Username: <span>admin</span><br>
    Password: <span>'YOUR_CHOSEN_PASSWORD'</span>
  </div>
  <p><a href="admin/login.php">→ Go to Admin Login</a></p>
  <div class="warn">⚠️ <strong>DELETE this file (reset_admin.php) immediately after logging in!</strong></div>
<?php else: ?>
  <h2 class="error">❌ Error</h2>
  <p><?= htmlspecialchars($conn->error) ?></p>
  <hr>
  <p class="info">Try running this SQL manually in phpMyAdmin:</p>
  <div class="cred" style="font-size:12px;word-break:break-all">
    DELETE FROM admins WHERE username='admin';<br>
    INSERT INTO admins (username, password) VALUES ('admin', '<?= htmlspecialchars($hash) ?>');
  </div>
<?php endif;
$conn->close();
?>
</div>
</body>
</html>
