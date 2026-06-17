<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../db.php';
if ($conn->connect_error) { echo json_encode(['success'=>false,'hotels'=>[]]); exit; }
$r = $conn->query("SELECT * FROM hotels WHERE visible=1 ORDER BY FIELD(tier,'ultra','budget','comfort','midrange','premium','luxury'), id");
$d = [];
if ($r) while ($row = $r->fetch_assoc()) {
    $row['amenities'] = array_map('trim', explode(',', $row['amenities'] ?? ''));
    $d[] = $row;
}
echo json_encode(['success'=>true,'hotels'=>$d]);
$conn->close();
?>
