<?php
header('Content-Type: application/json');
require_once 'db.php'; // Connexion PDO

try {
    $stmt = $pdo->query("SELECT * FROM evenements ORDER BY date");
    $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['success' => true, 'evenements' => $evenements]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
