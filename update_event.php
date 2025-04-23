<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $db = new db();
    $conn = $db->getConnection();

    $sql = "UPDATE events SET 
                title = :title, 
                date = :date, 
                startTime = :startTime, 
                endTime = :endTime, 
                description = :description, 
                status = :status
            WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':title' => $data['title'],
        ':date' => $data['date'],
        ':startTime' => $data['startTime'],
        ':endTime' => $data['endTime'],
        ':description' => $data['description'],
        ':status' => $data['status'],
        ':id' => $data['id']
    ]);

    echo json_encode(["message" => "Événement mis à jour avec succès"]);
}
?>
