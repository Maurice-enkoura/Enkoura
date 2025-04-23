<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $db = new db();
    $conn = $db->getConnection();

    $sql = "INSERT INTO events (title, date, startTime, endTime, description, status) 
            VALUES (:title, :date, :startTime, :endTime, :description, :status)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':title' => $data['title'],
        ':date' => $data['date'],
        ':startTime' => $data['startTime'],
        ':endTime' => $data['endTime'],
        ':description' => $data['description'],
        ':status' => $data['status']
    ]);

    echo json_encode(["message" => "Événement ajouté avec succès"]);
}
?>
