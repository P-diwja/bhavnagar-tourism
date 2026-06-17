<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../db.php';
if ($conn->connect_error) { echo json_encode(['success'=>false,'foods'=>[]]); exit; }
$r = $conn->query("SELECT * FROM foods WHERE visible=1 ORDER BY id");
$d = [];
if ($r) while ($row = $r->fetch_assoc()) {
    $row['mustTry'] = array_map('trim', explode(',', $row['must_try'] ?? ''));
    $d[] = $row;
}
echo json_encode(['success'=>true,'foods'=>$d]);
$conn->close();
?>
