<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EasyPlan - Utilisateurs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
    }
    .dark-mode {
      background-color: #181a1b;
      color: #e0e0e0;
    }
    .dark-mode .card, .dark-mode .table {
      background-color: #242526;
      color: #e0e0e0;
    }
    .sidebar {
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      background-color: #343a40;
      padding-top: 60px;
      color: white;
      z-index: 1040;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .main-content {
      margin-left: 250px;
      padding: 30px;
    }
    .topbar {
      position: fixed;
      left: 250px;
      right: 0;
      top: 0;
      z-index: 1030;
      background-color: #343a40;
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .user-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
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
    <a href="users.html" class="bg-primary text-white"><i class="bi bi-people-fill me-2"></i>Utilisateurs</a>
    <a href="settings.html"><i class="bi bi-gear-fill me-2"></i>Paramètres</a>
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
      <a href="#" class="btn btn-outline-light me-2"><i class="bi bi-person-circle me-1"></i> Profil</a>
      <a href="#" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right me-1"></i> Déconnexion</a>
    </div>
  </div>
</nav>

<div class="sidebar">
  <h5 class="text-center text-white mb-4">🎛️ Menu Admin</h5>
  <a href="admin_dashboard.php" class="active"><i class="bi bi-house-door-fill me-2"></i> Tableau de bord</a>
  <a href="evenement.php"><i class="bi bi-calendar-event me-2"></i> Événements</a>
  <a href="notifications.php"><i class="bi bi-bell me-2"></i> Notifications</a>
  <a href="#"><i class="bi bi-people me-2"></i> Utilisateurs</a>
  <a href="settings.php"><i class="bi bi-gear me-2"></i> Paramètres</a>
</div>


  <!-- Topbar -->
  <div class="topbar">
    <span><i class="bi bi-people-fill me-2"></i>Liste des utilisateurs</span>
    <div class="d-flex align-items-center">
      <div class="form-check form-switch text-white me-3">
        <input class="form-check-input" type="checkbox" id="darkModeToggle" />
        <label class="form-check-label" for="darkModeToggle">🌙</label>
      </div>
      <a href="#" class="btn btn-sm btn-outline-light"><i class="bi bi-person-circle me-1"></i> Profil</a>
    </div>
  </div>

  <!-- Contenu principal -->
  <div class="main-content pt-5 mt-3">
    <div class="container-fluid">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">👤 Utilisateurs enregistrés</h5>
          <button class="btn btn-sm btn-primary"><i class="bi bi-person-plus-fill me-1"></i> Ajouter</button>
        </div>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><img src="https://randomuser.me/api/portraits/men/45.jpg" class="user-img" alt="Utilisateur 1"></td>
                <td>Jean Dupont</td>
                <td>jean.dupont@email.com</td>
                <td>Administrateur</td>
                <td><span class="badge bg-success">Actif</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td><img src="https://randomuser.me/api/portraits/women/44.jpg" class="user-img" alt="Utilisateur 2"></td>
                <td>Claire Moreau</td>
                <td>claire.moreau@email.com</td>
                <td>Utilisateur</td>
                <td><span class="badge bg-warning text-dark">En attente</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td><img src="https://randomuser.me/api/portraits/men/65.jpg" class="user-img" alt="Utilisateur 3"></td>
                <td>Ali Ndiaye</td>
                <td>ali.ndiaye@email.com</td>
                <td>Superviseur</td>
                <td><span class="badge bg-danger">Suspendu</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('darkModeToggle').addEventListener('change', function () {
      document.body.classList.toggle('dark-mode', this.checked);
    });
  </script>
</body>
</html>
