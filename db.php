<?php
$host     = 'YOUR_HOST_NAME';
$dbname   = 'YOUR_DB_NAME';
$username = 'YOUR_DB_USERNAME';
$password = 'YOUR_DB_PASSWORD';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    // Check if caller expects JSON (API files) or HTML (admin pages)
    $isApi = (strpos($_SERVER['SCRIPT_NAME'] ?? '', '/api/') !== false);
    if ($isApi) {
        header('Content-Type: application/json');
        die(json_encode(['success' => false, 'message' => 'DB connection failed: ' . $conn->connect_error]));
    } else {
        die('<div style="font-family:sans-serif;padding:40px;background:#fee;border:1px solid red;border-radius:8px;max-width:600px;margin:40px auto">
            <h2>⚠️ Database Connection Error</h2>
            <p>Could not connect to MySQL. Please check:</p>
            <ul>
                <li>XAMPP is running (Apache + MySQL both green)</li>
                <li>Database <strong>gotrip_db</strong> exists in phpMyAdmin</li>
                <li>You have imported <strong>setup_full.sql</strong></li>
            </ul>
            <p><strong>Error:</strong> ' . htmlspecialchars($conn->connect_error) . '</p>
        </div>');
    }
}

$conn->set_charset('utf8mb4');
?>
