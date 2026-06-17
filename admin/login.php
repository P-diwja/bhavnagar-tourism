<?php
ini_set('session.cookie_lifetime', 86400);
ini_set('session.gc_maxlifetime',  86400);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';

    if ($u === 'admin' && $p === '1234') {
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username']  = $u;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Login – GoTrip Bhavnagar</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'DM Sans',sans-serif;background:#050b14;color:#e8edf5;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;background-image:linear-gradient(rgba(0,194,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(0,194,255,0.03) 1px,transparent 1px);background-size:60px 60px}
        .login-card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:24px;padding:44px 40px;width:100%;max-width:420px;backdrop-filter:blur(20px);animation:fadeUp .3s ease}
        @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
        .logo{font-family:'Playfair Display',serif;font-size:22px;font-weight:900;color:#00c2ff;margin-bottom:6px}
        .logo span{color:#e8edf5}
        .subtitle{font-size:13px;color:#7a8ba0;margin-bottom:32px}
        .shield{font-size:40px;margin-bottom:18px;display:block;text-align:center}
        .field{margin-bottom:18px}
        label{display:block;font-size:11px;font-weight:800;color:#7a8ba0;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px}
        input{width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:13px 16px;color:#e8edf5;font-family:inherit;font-size:14px;outline:none;transition:border-color .2s,box-shadow .2s}
        input:focus{border-color:#00c2ff;box-shadow:0 0 0 3px rgba(0,194,255,0.12)}
        input::placeholder{color:#7a8ba0}
        .btn-login{width:100%;padding:14px;border-radius:12px;background:linear-gradient(135deg,#00c2ff,#ff6b35);color:#fff;font-weight:800;font-size:15px;border:none;cursor:pointer;font-family:inherit;transition:transform .2s;margin-top:8px}
        .btn-login:hover{transform:scale(1.02)}
        .error{background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.3);color:#ef4444;padding:11px 16px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:18px}
        .back-link{display:block;text-align:center;margin-top:22px;font-size:13px;color:#7a8ba0}
        .back-link a{color:#00c2ff;font-weight:700;text-decoration:none}
    </style>
</head>
<body>
    <div class="login-card">
        <span class="shield">🔐</span>
        <div class="logo">GoTrip <span>Bhavnagar</span></div>
        <div class="subtitle">Admin Panel — Authorised Access Only</div>
        <?php if ($error): ?>
            <div class="error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="field"><label>Username</label><input name="username" type="text" placeholder="admin" required autocomplete="username"></div>
            <div class="field"><label>Password</label><input name="password" type="password" placeholder="••••••••" required autocomplete="current-password"></div>
            <button class="btn-login" type="submit">Login to Dashboard →</button>
        </form>
        <div class="back-link"><a href="/gotrip/index.php">← Go back to web</a></div>
    </div>
</body>
</html>
