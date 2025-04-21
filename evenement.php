<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EasyPlan - Gestion des Événements</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
      transition: background-color 0.3s, color 0.3s;
    }
    .dark-mode {
      background-color: #181a1b;
      color: #e0e0e0;
    }
    .dark-mode .table,
    .dark-mode .card,
    .dark-mode .modal-content {
      background-color: #242526;
      color: #e0e0e0;
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

    .content {
      margin-left: 250px;
      padding: 30px;
      margin-top: 56px;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table th {
      background-color: #e9ecef;
    }

    #calendar {
      margin-top: 40px;
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    #backToTop {
      position: fixed;
      bottom: 80px;
      right: 20px;
      display: none;
      z-index: 1090;
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

<!-- Navbar 
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
      <a href="logout.php" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right me-1"></i> Déconnexion</a>
    </div>
  </div>
</nav>

<div class="sidebar">
  <h5 class="text-center text-white mb-4">🎛️ Menu Admin</h5>
  <a href="admin_dashboard.php" class="active"><i class="bi bi-house-door-fill me-2"></i> Tableau de bord</a>
  <a href="#"><i class="bi bi-calendar-event me-2"></i> Événements</a>
  <a href="notifications.php"><i class="bi bi-bell me-2"></i> Notifications</a>
  <a href="users.php"><i class="bi bi-people me-2"></i> Utilisateurs</a>
  <a href="settings.php"><i class="bi bi-gear me-2"></i> Paramètres</a>
</div>


<!-- Sidebar 
<div class="sidebar">
<a href="admin_dashboard.php" class="active"><i class="bi bi-house-door-fill me-2"></i> Tableau de bord</a>
  <a href="#" class="active"><i class="bi bi-calendar-event me-2"></i>Événements</a>
  <a href="#"><i class="bi bi-people me-2"></i>Utilisateurs</a>
  <a href="#"><i class="bi bi-gear me-2"></i>Paramètres</a>
</div>
-->
<!-- Contenu -->
<div class="content">
  <h2 class="mb-4"><i class="bi bi-calendar-event me-2"></i>Gestion des Événements</h2>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>📅 Événements programmés</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
      <i class="bi bi-plus-circle me-1"></i> Ajouter un événement
    </button>
  </div>

  <div class="card p-4">
    <table class="table" id="eventTable">
      <thead class="table-light">
        <tr>
          <th>Titre</th>
          <th>Date</th>
          <th>Jour</th>
          <th>Mois</th>
          <th>Heure début</th>
          <th>Heure fin</th>
          <th>Description</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="eventTableBody">
        <!-- Événements dynamiques ici -->
      </tbody>
    </table>
  </div>

  <div id="calendar"></div>
</div>

<!-- Modal Ajouter Événement -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter un événement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="eventForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Titre</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Heure début</label>
              <input type="time" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Heure fin</label>
              <input type="time" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Statut</label>
              <select class="form-select">
                <option value="À venir">À venir</option>
                <option value="En cours">En cours</option>
                <option value="Terminé">Terminé</option>
              </select>
            </div>
            <div class="col-12 text-end">
              <button type="submit" class="btn btn-success mt-3">
                <i class="bi bi-check-circle me-1"></i> Enregistrer
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('darkModeToggle').addEventListener('change', function () {
    document.body.classList.toggle('dark-mode');
  });

  document.getElementById('eventForm').addEventListener('submit', function (e) {
    e.preventDefault();
    // Logique d’ajout ici
    alert("Événement ajouté !");
    const modal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
    modal.hide();
    this.reset();
  });
</script>
</body>
</html>
