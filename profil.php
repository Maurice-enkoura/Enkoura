<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      padding-top: 70px;
      background-color: #f8f9fa;
    }
    .profile-card {
      max-width: 700px;
      margin: auto;
    }
    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
    }

    .sidebar {
      height: 100vh;
      background-color: #212529;
      color: #fff;
      padding-top: 20px;
      position: fixed;
      width: 250px;
      top: 56px;
    }
    .sidebar a {
      color: #adb5bd;
      padding: 15px 20px;
      display: block;
      text-decoration: none;
      transition: background 0.3s, color 0.3s;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #343a40;
      color: #fff;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <i class="bi bi-diagram-3-fill me-2"></i> EasyPlan Admin
      </a>
      <div class="d-flex ms-auto align-items-center">
      <div class="form-check form-switch text-white me-3">
        <input class="form-check-input" type="checkbox" id="darkModeToggle" />
        <label class="form-check-label" for="darkModeToggle">🌙</label>
      </div>
        </div>
        <a href="#" class="btn btn-outline-light me-2">
          <i class="bi bi-person-circle me-1"></i> Profil
        </a>
        <a href="logout.php" class="btn btn-outline-danger">
          <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
        </a>
      </div>
    </div>
  </nav>

  <div class="sidebar">
  <h5 class="text-center text-white mb-4">🎛️ Menu Admin</h5>
  <a href="#" class="active"><i class="bi bi-house-door-fill me-2"></i> Tableau de bord</a>
  <a href="evenement.php"><i class="bi bi-calendar-event me-2"></i> Événements</a>
  <a href="notifications.php"><i class="bi bi-bell me-2"></i> Notifications</a>
  <a href="users.php"><i class="bi bi-people me-2"></i> Utilisateurs</a>
  <a href="settings.php"><i class="bi bi-gear me-2"></i> Paramètres</a>
</div>

  <!-- PAGE PROFIL -->
  <div class="container mt-5">
    <div class="card shadow profile-card">
      <div class="card-body text-center">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNXu6lDeaf_e4M-VtDWyolZ9pqpKmb6gXifA&s" alt="Avatar" class="profile-avatar mb-3 shadow" />
        <h4 class="card-title">Administrateur</h4>
        <p class="text-muted">admin@easyplan.com</p>
        <hr>
        <div class="text-start">
          <p><strong>Nom complet :</strong> Maurice Enkoura</p>
          <p><strong>Rôle :</strong> Super Administrateur</p>
          <p><strong>Téléphone :</strong> +221 77 123 45 67</p>
          <p><strong>Adresse :</strong> Dakar, Sénégal</p>
        </div>
        <a href="#" class="btn btn-primary mt-3"><i class="bi bi-pencil me-1"></i> Modifier le profil</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
