<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../db.php';
if ($conn->connect_error) { echo json_encode(['success'=>false,'events'=>[]]); exit; }
$r = $conn->query("SELECT * FROM events WHERE visible=1 ORDER BY seasonal DESC, id");
$d = [];
if ($r) while ($row = $r->fetch_assoc()) $d[] = $row;
echo json_encode(['success'=>true,'events'=>$d]);
$conn->close();
?>
