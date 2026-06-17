<?php
// api/add_review.php — Accepts review + optional image upload
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'POST only.']);
    exit;
}

// ── 1. TEXT FIELD VALIDATION ─────────────────────────────────────────────────
$name    = trim($_POST['name']    ?? '');
$rating  = intval($_POST['rating'] ?? 0);
$message = trim($_POST['message'] ?? '');

if (!$name || mb_strlen($name) < 2) {
    echo json_encode(['success' => false, 'message' => 'Name is too short (min 2 characters).']);
    exit;
}
if ($rating < 1 || $rating > 5) {
    echo json_encode(['success' => false, 'message' => 'Please select a star rating (1–5).']);
    exit;
}
if (!$message || mb_strlen($message) < 10) {
    echo json_encode(['success' => false, 'message' => 'Review is too short (min 10 characters).']);
    exit;
}

// Sanitise text inputs
$name    = htmlspecialchars(strip_tags($name),    ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(strip_tags($message), ENT_QUOTES, 'UTF-8');

// ── 2. OPTIONAL IMAGE UPLOAD ─────────────────────────────────────────────────
$image_path = null;

if (!empty($_FILES['photo']) && $_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE) {

    $file  = $_FILES['photo'];
    $error = $file['error'];

    // PHP upload error check
    if ($error !== UPLOAD_ERR_OK) {
        $phpErrors = [
            UPLOAD_ERR_INI_SIZE   => 'File exceeds server upload limit.',
            UPLOAD_ERR_FORM_SIZE  => 'File exceeds form size limit.',
            UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded.',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder on server.',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
            UPLOAD_ERR_EXTENSION  => 'Upload blocked by a server extension.',
        ];
        $msg = $phpErrors[$error] ?? 'Unknown upload error (code ' . $error . ').';
        echo json_encode(['success' => false, 'message' => '📷 Image upload failed: ' . $msg]);
        exit;
    }

    // Size limit: 5 MB
    if ($file['size'] > 5 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => '📷 Image is too large. Max allowed size is 5 MB.']);
        exit;
    }

    // Validate MIME type via finfo (not just extension)
    $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMime, true)) {
        echo json_encode(['success' => false, 'message' => '📷 Invalid file type. Only JPG, PNG, WEBP and GIF are allowed.']);
        exit;
    }

    // Map MIME → extension
    $extMap = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/gif'  => 'gif',
    ];
    $ext = $extMap[$mime];

    // Build upload path: /uploads/<year>/<month>/
    $uploadBase = dirname(__DIR__) . '/uploads';
    $uploadDir  = $uploadBase . '/' . date('Y') . '/' . date('m');

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            echo json_encode(['success' => false, 'message' => 'Server could not create upload folder. Check permissions.']);
            exit;
        }
    }

    // Generate a unique, safe filename
    $filename   = 'review_' . time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
    $targetPath = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo json_encode(['success' => false, 'message' => 'Could not save the uploaded image. Check folder permissions.']);
        exit;
    }

    // Store relative path for DB & display
    $image_path = 'uploads/' . date('Y') . '/' . date('m') . '/' . $filename;
}

// ── 3. INSERT INTO DATABASE ──────────────────────────────────────────────────
// approved = 0 → pending admin verification (changed from instant-approve)
$stmt = $conn->prepare(
    "INSERT INTO reviews (name, rating, message, image_path, approved) VALUES (?, ?, ?, ?, 0)"
);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'DB prepare error: ' . $conn->error]);
    exit;
}

$stmt->bind_param('siss', $name, $rating, $message, $image_path);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your review! It will appear after admin verification. 🎉'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'DB error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
