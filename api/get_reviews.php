<?php
// api/get_reviews.php — Returns approved reviews (with optional image paths)
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../db.php';

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.', 'reviews' => []]);
    exit;
}

// ?all=1 → return everything (used by all-reviews.php page)
// default  → latest 6 approved reviews for homepage
$limit = isset($_GET['all']) ? '' : 'LIMIT 6';

$r = $conn->query(
    "SELECT id, name, rating, message, image_path, created_at
       FROM reviews
      WHERE approved = 1
      ORDER BY created_at DESC
      $limit"
);

if (!$r) {
    echo json_encode(['success' => false, 'message' => 'Query failed: ' . $conn->error, 'reviews' => []]);
    exit;
}

$reviews = [];
while ($row = $r->fetch_assoc()) {
    $reviews[] = $row;   // image_path will be null or a relative path string
}

echo json_encode([
    'success' => true,
    'reviews' => $reviews,
    'count'   => count($reviews),
]);

$conn->close();
?>
