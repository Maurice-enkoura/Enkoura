<?php
require_once 'db.php';

$db = new db();
$conn = $db->getConnection();

$sql = "SELECT * FROM events ORDER BY date, startTime";
$stmt = $conn->prepare($sql);
$stmt->execute();

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($events);
?>
