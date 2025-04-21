<?php
session_start();

// Vérifie la session
if (!isset($_SESSION['admin_id'])) {
    // Si non connecté mais cookies présents
    if (isset($_COOKIE['admin_email']) && isset($_COOKIE['admin_token'])) {
        // Ici tu pourrais ajouter une vérification en base du token
        $_SESSION['admin_id'] = 1;
        $_SESSION['admin_email'] = $_COOKIE['admin_email'];
    } else {
        // Sinon, rediriger vers la page de connexion
        header("Location: admin_login.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EasyPlan - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
      transition: background-color 0.3s, color 0.3s;
    }
    .dark-mode {
      background-color: #181a1b !important;
      color: #e0e0e0;
    }
    .dark-mode .table, .dark-mode .card, .dark-mode .modal-content {
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
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .table th {
      background-color: #e9ecef;
    }
    .toast-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1080;
    }
    #calendar {
      margin-top: 40px;
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    #backToTop {
      position: fixed;
      bottom: 80px;
      right: 20px;
      display: none;
      z-index: 1090;
    }
  </style>
</head>
<body>

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
      <a href="profil.php" class="btn btn-outline-light me-2">
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

<div class="content">
  <h2 class="mb-4"><i class="bi bi-speedometer2 me-2"></i>Dashboard Administrateur</h2>

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
  <button id="backToTop" class="btn btn-secondary"><i class="bi bi-arrow-up-circle"></i> Haut</button>
</div>

<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter un événement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="eventForm">
          <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" id="titre" required />
          </div>
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" id="date" required />
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="heure_debut" class="form-label">Heure début</label>
              <input type="time" class="form-control" name="heure_debut" id="heure_debut" required />
            </div>
            <div class="col mb-3">
              <label for="heure_fin" class="form-label">Heure fin</label>
              <input type="time" class="form-control" name="heure_fin" id="heure_fin" required />
            </div>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="2" required></textarea>
          </div>
          <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select class="form-select" name="statut" id="statut" required>
              <option value="Confirmé">Confirmé</option>
              <option value="En attente">En attente</option>
              <option value="Annulé">Annulé</option>
            </select>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-success">Ajouter</button>
            <button type="reset" class="btn btn-warning">Réinitialiser</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="toast-container">
  <div id="adminToast" class="toast align-items-center text-white bg-primary border-0" role="alert" data-bs-delay="3000">
    <div class="d-flex">
      <div class="toast-body" id="toastMessage">Action réalisée avec succès</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('eventForm');
  const tableBody = document.getElementById('eventTableBody');
  const toastMessage = document.getElementById('toastMessage');
  const adminToast = new bootstrap.Toast(document.getElementById('adminToast'));
  const modal = new bootstrap.Modal(document.getElementById('eventModal'));
  const toggle = document.getElementById('darkModeToggle');
  const backToTop = document.getElementById('backToTop');

  toggle.checked = localStorage.getItem('dark-mode') === 'true';
  document.body.classList.toggle('dark-mode', toggle.checked);
  toggle.addEventListener('change', () => {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('dark-mode', toggle.checked);
  });
  fetch('get_evenements.php')
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      data.evenements.forEach(event => {
        tableBody.innerHTML += `
          <tr>
            <td>${event.titre}</td>
            <td>${event.date}</td>
            <td>${event.heure_debut}</td>
            <td>${event.heure_fin}</td>
            <td>${event.description}</td>
            <td><span class="badge ${getBadgeClass(event.statut)}">${event.statut}</span></td>
            <td>
              <button class="btn btn-sm btn-outline-info me-1">Modifier</button>
              <button class="btn btn-sm btn-outline-danger">Supprimer</button>
            </td>
          </tr>
        `;
      });
    }
  });


  form.addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch('ajouter_evenement.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const row = `
          <tr>
            <td>${formData.get('titre')}</td>
            <td>${formData.get('date')}</td>
            <td>${formData.get('heure_debut')}</td>
            <td>${formData.get('heure_fin')}</td>
            <td>${formData.get('description')}</td>
            <td><span class="badge ${getBadgeClass(formData.get('statut'))}">${formData.get('statut')}</span></td>
            <td>
              <button class="btn btn-sm btn-outline-info me-1"><i class="bi bi-pencil-square"></i></button>
              <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
            </td>
          </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', row);
        showToast("Événement ajouté avec succès !");
        form.reset();
        modal.hide();
        calendar.refetchEvents();
      } else {
        showToast(data.message || "Erreur lors de l'ajout.");
      }
    });
  });

  function getBadgeClass(status) {
    return status === "Confirmé" ? "bg-success" : status === "En attente" ? "bg-warning text-dark" : "bg-danger";
  }

  function showToast(message) {
    toastMessage.textContent = message;
    adminToast.show();
  }

  window.addEventListener('scroll', () => {
    backToTop.style.display = window.scrollY > 300 ? 'block' : 'none';
  });
  backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  const calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 650,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    dateClick: function(info) {
      document.getElementById('date').value = info.dateStr;
      modal.show();
    },
    events: 'get_evenements.php'
  });
  calendar.render();
  

});

  

</script>
</body>
</html>
