<?php
// admin/logout.php — Destroy session and redirect to home.php
ini_set('session.cookie_lifetime', 86400);
ini_set('session.gc_maxlifetime',  86400);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_unset();
session_destroy();

// Clear the session cookie
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Redirect to index.php (main site) after logout
header('Location: ../index.php');
exit;
?>