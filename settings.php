<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EasyPlan – Paramètres</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }
    .dark-mode {
      background-color: #121212;
      color: #f0f0f0;
    }
    .dark-mode .card {
      background-color: #1e1e1e;
      color: #f0f0f0;
    }
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 260px;
      height: 100vh;
      background: #343a40;
      color: white;
      padding-top: 60px;
    }
    .sidebar a {
      display: block;
      padding: 12px 24px;
      color: #ddd;
      text-decoration: none;
      transition: 0.3s;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #495057;
      color: #fff;
    }
    .topbar {
      position: fixed;
      top: 0;
      left: 260px;
      right: 0;
      background-color: #ffffff;
      border-bottom: 1px solid #dee2e6;
      height: 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 25px;
      z-index: 1000;
    }
    .dark-mode .topbar {
      background-color: #1e1e1e;
      border-bottom: 1px solid #333;
    }
    .main-content {
      margin-left: 260px;
      padding: 80px 30px 30px;
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }
    .navbar {
      z-index: 1050;
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

  <!-- Sidebar
  <div class="sidebar">
    <h4 class="text-center mb-4">EasyPlan</h4>
    <a href="dashboard.html"><i class="bi bi-speedometer2 me-2"></i>Tableau de bord</a>
    <a href="tasks.html"><i class="bi bi-list-check me-2"></i>Tâches</a>
    <a href="calendar.html"><i class="bi bi-calendar-event me-2"></i>Calendrier</a>
    <a href="notifications.html"><i class="bi bi-bell-fill me-2"></i>Notifications</a>
    <a href="users.html"><i class="bi bi-people-fill me-2"></i>Utilisateurs</a>
    <a href="settings.html" class="active"><i class="bi bi-gear-fill me-2"></i>Paramètres</a>
    <hr class="text-white" />
    <a href="#" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a>
  </div>
  -->
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
      <a href="profil.php" class="btn btn-outline-light me-2"><i class="bi bi-person-circle me-1"></i> Profil</a>
      <a href="#" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right me-1"></i> Déconnexion</a>
    </div>
  </div>
</nav>

<div class="sidebar">
  <h5 class="text-center text-white mb-4">🎛️ Menu Admin</h5>
  <a href="admin_dashboard.php" class="active"><i class="bi bi-house-door-fill me-2"></i> Tableau de bord</a>
  <a href="evenement.php"><i class="bi bi-calendar-event me-2"></i> Événements</a>
  <a href="notifications.php"><i class="bi bi-bell me-2"></i> Notifications</a>
  <a href="users.php"><i class="bi bi-people me-2"></i> Utilisateurs</a>
  <a href="#"><i class="bi bi-gear me-2"></i> Paramètres</a>
</div>


  <!-- Topbar -->
  <div class="topbar">
    <h5 class="mb-0 fw-semibold"><i class="bi bi-gear-fill me-2"></i>Paramètres</h5>
    <div class="d-flex align-items-center gap-3">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="darkModeToggle" />
        <label class="form-check-label" for="darkModeToggle">🌙</label>
      </div>
      <a href="#" class="btn btn-outline-dark btn-sm"><i class="bi bi-person-circle me-1"></i>Profil</a>
    </div>
  </div>

  <!-- Main -->
  <div class="main-content">
    <div class="container-fluid">
      <h4 class="mb-4">Préférences de l'utilisateur</h4>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card p-4">
            <h5 class="mb-3">Informations du compte</h5>
            <div class="mb-3">
              <label class="form-label">Nom</label>
              <input type="text" class="form-control" placeholder="Votre nom">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Votre email">
            </div>
            <button class="btn btn-primary">Mettre à jour</button>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card p-4">
            <h5 class="mb-3">Mot de passe</h5>
            <div class="mb-3">
              <label class="form-label">Mot de passe actuel</label>
              <input type="password" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Nouveau mot de passe</label>
              <input type="password" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Confirmer le mot de passe</label>
              <input type="password" class="form-control">
            </div>
            <button class="btn btn-warning">Changer le mot de passe</button>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card p-4">
            <h5 class="mb-3">Notifications</h5>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" type="checkbox" id="notif1" checked>
              <label class="form-check-label" for="notif1">Recevoir les notifications de tâches</label>
            </div>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" type="checkbox" id="notif2">
              <label class="form-check-label" for="notif2">Recevoir les rappels par email</label>
            </div>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" type="checkbox" id="notif3" checked>
              <label class="form-check-label" for="notif3">Notifications système (pop-up)</label>
            </div>
            <button class="btn btn-success mt-3">Enregistrer</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('darkModeToggle').addEventListener('change', function () {
      document.body.classList.toggle('dark-mode', this.checked);
    });
  </script>
</body>
</html>
