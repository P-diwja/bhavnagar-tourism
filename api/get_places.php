<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../db.php';
if ($conn->connect_error) { echo json_encode(['success'=>false,'places'=>[]]); exit; }
$r = $conn->query("SELECT * FROM places WHERE visible=1 ORDER BY id");
$d = [];
if ($r) while ($row = $r->fetch_assoc()) $d[] = $row;
echo json_encode(['success'=>true,'places'=>$d]);
$conn->close();
?>
