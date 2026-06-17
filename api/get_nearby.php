<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../db.php';
if ($conn->connect_error) { echo json_encode(['success'=>false,'nearby'=>[]]); exit; }
$r = $conn->query("SELECT * FROM nearby WHERE visible=1 ORDER BY id");
$d = [];
if ($r) while ($row = $r->fetch_assoc()) {
    $row['highlights'] = array_map('trim', explode(',', $row['highlights'] ?? ''));
    $d[] = $row;
}
echo json_encode(['success'=>true,'nearby'=>$d]);
$conn->close();
?>
