<?php
include('db.php');

$database = new db();
$conn = $database->getConnection();

$query = "SELECT * FROM notifications ORDER BY date DESC LIMIT 10";
$stmt = $conn->prepare($query);
$stmt->execute();

$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($notifications);
?>
