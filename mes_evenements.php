<?php
// Inclure la classe db pour la connexion à la base de données
include('db.php');

// Créer une instance de la classe db et obtenir la connexion
$database = new db();
$db = $database->getConnection();

// Vérifier si la connexion a échoué
if (!$db) {
    die("Échec de la connexion à la base de données.");
}

// Récupérer les événements de la base de données
$query = $db->prepare("SELECT * FROM events");
$query->execute();
$events = $query->fetchAll(PDO::FETCH_ASSOC);

// Modifier un événement
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $editQuery = $db->prepare("SELECT * FROM events WHERE id = :id");
    $editQuery->bindParam(':id', $edit_id);
    $editQuery->execute();
    $eventToEdit = $editQuery->fetch(PDO::FETCH_ASSOC);

    // Vérification de la soumission du formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_event'])) {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $startTime = $_POST['start_time'];
        $endTime = $_POST['end_time'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        // Mettre à jour l'événement dans la base de données
        $updateQuery = $db->prepare("UPDATE events SET title = :title, date = :date, startTime = :startTime, endTime = :endTime, description = :description, status = :status WHERE id = :id");
        $updateQuery->bindParam(':title', $title);
        $updateQuery->bindParam(':date', $date);
        $updateQuery->bindParam(':startTime', $startTime);
        $updateQuery->bindParam(':endTime', $endTime);
        $updateQuery->bindParam(':description', $description);
        $updateQuery->bindParam(':status', $status);
        $updateQuery->bindParam(':id', $edit_id);
        $updateQuery->execute();
        
        header("Location: mes_evenements.php"); // Rediriger après la mise à jour
    }
}

// Supprimer un événement
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deleteQuery = $db->prepare("DELETE FROM events WHERE id = :id");
    $deleteQuery->bindParam(':id', $delete_id);
    $deleteQuery->execute();
    header("Location: mes_evenements.php"); // Rediriger après la suppression
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes Événements</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar, .navbar-custom {
      position: fixed;
      top: 0;
      left: 0;
    }
    .sidebar {
      height: 100vh;
      width: 250px;
      background-color: #0d6efd;
      padding-top: 2rem;
      color: white;
      z-index: 500;
    }
    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 0.75rem 1.5rem;
      color: white;
      text-decoration: none;
      transition: background 0.2s;
      font-weight: 500;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #0b5ed7;
    }
    .content-wrapper {
      margin-left: 250px;
      padding: 2rem;
      z-index: 100;
    }
    .navbar-custom {
      background-color: #ffffff;
      border-bottom: 1px solid #dee2e6;
      z-index: 1001;
    }
    .card-shadow {
      box-shadow: 0 6px 18px rgba(0,0,0,0.07);
      border-radius: 0.75rem;
    }
    .btn-back {
      margin-bottom: 20px;
      z-index: 1002;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h3><i class="bi bi-calendar-event"></i> Dashboard</h3>
    <a href="front.php"><i class="bi bi-grid-fill"></i> Tableau de bord</a>
    <a href="mes_evenements.php" class="active"><i class="bi bi-calendar-check"></i> Mes événements</a>
    <a href="notifications.html"><i class="bi bi-bell"></i> Notifications</a>
    <a href="profil.html"><i class="bi bi-person-circle"></i> Profil</a>
    <a href="contact.html"><i class="bi bi-envelope-fill"></i> Contact</a>
    <a href="logout.html"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
  </div>

  <!-- Contenu principal -->
  <div class="container py-4 content-wrapper">
    <a href="front.php" class="btn btn-secondary btn-back"><i class="bi bi-arrow-left"></i> Retour</a>
    
    <h2>Mes événements</h2>

    <?php if (isset($eventToEdit)): ?>
      <!-- Formulaire de modification d'événement -->
      <h3>Modifier l'événement</h3>
      <form method="POST">
        <div class="mb-3">
          <label for="title" class="form-label">Titre</label>
          <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($eventToEdit['title']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($eventToEdit['date']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="start_time" class="form-label">Heure de début</label>
          <input type="time" name="start_time" class="form-control" value="<?= htmlspecialchars($eventToEdit['startTime']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="end_time" class="form-label">Heure de fin</label>
          <input type="time" name="end_time" class="form-control" value="<?= htmlspecialchars($eventToEdit['endTime']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($eventToEdit['description']) ?></textarea>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Statut</label>
          <select name="status" class="form-select">
            <option value="À venir" <?= $eventToEdit['status'] == 'À venir' ? 'selected' : '' ?>>À venir</option>
            <option value="En cours" <?= $eventToEdit['status'] == 'En cours' ? 'selected' : '' ?>>En cours</option>
            <option value="Terminé" <?= $eventToEdit['status'] == 'Terminé' ? 'selected' : '' ?>>Terminé</option>
          </select>
        </div>
        <button type="submit" name="update_event" class="btn btn-primary">Mettre à jour</button>
      </form>
    <?php else: ?>
      <!-- Affichage des événements -->
      <div class="table-responsive mb-4">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Titre</th>
              <th>Date</th>
              <th>Début</th>
              <th>Fin</th>
              <th>Description</th>
              <th>Statut</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="eventList">
            <?php
            // Affichage des événements récupérés de la base de données
            foreach ($events as $event) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($event['title']) . "</td>";
                echo "<td>" . htmlspecialchars($event['date']) . "</td>";
                echo "<td>" . htmlspecialchars($event['startTime']) . "</td>";
                echo "<td>" . htmlspecialchars($event['endTime']) . "</td>";
                echo "<td>" . htmlspecialchars($event['description']) . "</td>";
                echo "<td>" . htmlspecialchars($event['status']) . "</td>";
                echo "<td>
                        <a href='?edit_id=" . $event['id'] . "' class='btn btn-primary btn-sm'><i class='bi bi-pencil'></i> Modifier</a>
                        <a href='?delete_id=" . $event['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet événement ?\")'><i class='bi bi-trash'></i> Supprimer</a>
                      </td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>
