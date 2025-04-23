<?php
include('db.php');

$db = new db();
$conn = $db->getConnection();

$message = "🔔 Événement “Projet final” prévu demain à 10h.";

$query = "INSERT INTO notifications (message) VALUES (:message)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':message', $message);

if ($stmt->execute()) {
  echo "✅ Notification ajoutée.";
} else {
  echo "❌ Erreur.";
}
?>
