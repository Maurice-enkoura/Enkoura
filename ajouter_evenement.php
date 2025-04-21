<?php
header('Content-Type: application/json');

// Inclure le fichier de connexion à la base de données
require_once 'db.php';

// Vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requiredFields = ['titre', 'date', 'heure_debut', 'heure_fin', 'description', 'statut'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Champ manquant : $field"]);
            exit;
        }
    }

    // Nettoyage et validation basique
    $titre = htmlspecialchars(trim($_POST['titre']));
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];
    $description = htmlspecialchars(trim($_POST['description']));
    $statut = htmlspecialchars(trim($_POST['statut']));

    // Validation simple (tu peux l'améliorer selon ton besoin)
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Format de date invalide.']);
        exit;
    }

    if (!preg_match('/^\d{2}:\d{2}$/', $heure_debut) || !preg_match('/^\d{2}:\d{2}$/', $heure_fin)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Format de l\'heure invalide.']);
        exit;
    }

    // Connexion à la base
    $database = new db();
    $pdo = $database->getConnection();

    try {
        $stmt = $pdo->prepare("
            INSERT INTO evenements (titre, date_event, heure_debut, heure_fin, description, statut)
            VALUES (:titre, :date_event, :heure_debut, :heure_fin, :description, :statut)
        ");

        $stmt->execute([
            ':titre' => $titre,
            ':date_event' => $date,
            ':heure_debut' => $heure_debut,
            ':heure_fin' => $heure_fin,
            ':description' => $description,
            ':statut' => $statut
        ]);

        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Événement ajouté avec succès']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erreur PDO : ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>
