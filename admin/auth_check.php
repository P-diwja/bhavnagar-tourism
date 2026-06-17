<?php
// Fix session persistence - set lifetime before session_start
ini_set('session.cookie_lifetime', 86400);   // 24 hours
ini_set('session.gc_maxlifetime',  86400);   // 24 hours
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
