<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $db = new db();
    $conn = $db->getConnection();

    $sql = "DELETE FROM events WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $data['id']]);

    echo json_encode(["message" => "Événement supprimé avec succès"]);
}
?>
