
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planning des Événements</title>

  <!-- Lien vers Bootstrap et FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #0d6efd;
      padding-top: 2rem;
      color: white;
      z-index: 1000;
    }
    .sidebar h3 {
      font-weight: bold;
      margin-bottom: 2rem;
      text-align: center;
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
    }
    .navbar-custom {
      margin-left: 250px;
      background-color: #ffffff;
      border-bottom: 1px solid #dee2e6;
    }
    .card-shadow {
      box-shadow: 0 6px 18px rgba(0,0,0,0.07);
      border-radius: 0.75rem;
    }
    .scroll-to-top {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #0d6efd;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 50%;
      font-size: 18px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h3><i class="bi bi-calendar-event"></i> Dashboard</h3>
    <a href="#" class="active"><i class="bi bi-grid-fill"></i> Tableau de bord</a>
    <a href="mes_evenements.html"><i class="bi bi-calendar-check"></i> Mes événements</a>
    <a href="notifications.html"><i class="bi bi-bell"></i> Notifications</a>
    <a href="profil.html"><i class="bi bi-person-circle"></i> Profil</a>
    <a href="contact.html"><i class="bi bi-envelope-fill"></i> Contact</a>
    <a href="logout.html"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light navbar-custom shadow-sm px-4">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-primary" href="#"><i class="bi bi-calendar3"></i> Planificateur</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
        <form class="d-flex me-3">
          <input class="form-control me-2" type="search" id="searchInput" placeholder="Recherche rapide..." aria-label="Search">
          <button class="btn btn-outline-primary" type="button" onclick="searchEvent()"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Contenu principal -->
  <div class="container py-4 content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0">Tableau de Bord - Planning</h2>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">Ajouter un événement</button>
    </div>

    <!-- Statistiques des événements -->
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <div class="card card-stat border-primary">
          <div class="card-body text-center">
            <h5>Événements à venir</h5>
            <h3 id="statUpcoming">0</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-stat border-warning">
          <div class="card-body text-center">
            <h5>En cours</h5>
            <h3 id="statOngoing">0</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-stat border-success">
          <div class="card-body text-center">
            <h5>Terminés</h5>
            <h3 id="statCompleted">0</h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Tableau des événements -->
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
        <tbody id="eventList"></tbody>
      </table>
    </div>

    <!-- Calendrier -->
    <div id="calendar"></div>
  </div>

  <!-- Modal ajout d'événement -->
  <div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="eventForm">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter un événement</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-2">
              <label class="form-label">Titre</label>
              <input type="text" class="form-control" id="eventTitle" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Date</label>
              <input type="date" class="form-control" id="eventDate" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Heure de début</label>
              <input type="time" class="form-control" id="eventStartTime" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Heure de fin</label>
              <input type="time" class="form-control" id="eventEndTime" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Description</label>
              <textarea class="form-control" id="eventDescription" required></textarea>
            </div>
            <div class="mb-2">
              <label class="form-label">Statut</label>
              <select class="form-select" id="eventStatus" required>
                <option value="À venir">À venir</option>
                <option value="En cours">En cours</option>
                <option value="Terminé">Terminé</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <button type="button" class="btn btn-secondary" id="resetButton">Réinitialiser</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Scroll to Top Button -->
  <button class="scroll-to-top" onclick="scrollToTop()">↑</button>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
  // Variable pour stocker les événements
let events = [];
let editIndex = null;

// Rafraîchir la liste des événements toutes les 30 secondes
setInterval(refreshEvents, 30000); // Rafraîchissement toutes les 30 secondes

// Fonction pour rafraîchir la liste des événements et le calendrier
function refreshEvents() {
    updateEventList();
    updateCalendar();
    updateStats();
}

// Fonction pour réinitialiser le formulaire sans fermer le modal
document.getElementById('resetButton').addEventListener('click', function () {
  document.getElementById('eventForm').reset();
  editIndex = null; // Réinitialiser l'index d'édition
});

// Fonction pour ajouter ou modifier un événement
document.getElementById('eventForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const title = document.getElementById('eventTitle').value;
  const date = document.getElementById('eventDate').value;
  const startTime = document.getElementById('eventStartTime').value;
  const endTime = document.getElementById('eventEndTime').value;
  const description = document.getElementById('eventDescription').value;
  const status = document.getElementById('eventStatus').value;

  const newEvent = {
    title,
    date,
    startTime,
    endTime,
    description,
    status,
  };

  if (editIndex === null) {
    // Ajouter un nouvel événement
    events.push(newEvent);
  } else {
    // Modifier un événement existant
    events[editIndex] = newEvent;
  }

  // Rafraîchir la liste et le calendrier sans recharger la page
  refreshEvents();

  // Réinitialiser le formulaire après ajout ou modification
  document.getElementById('eventForm').reset();
  editIndex = null; // Réinitialiser l'index d'édition
  const modal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
  modal.hide();
});

// Mise à jour du tableau des événements
function updateEventList() {
  const eventList = document.getElementById('eventList');
  eventList.innerHTML = ''; // Réinitialise la liste avant de la remplir

  events.forEach((event, index) => {
    eventList.innerHTML += `
      <tr>
        <td>${event.title}</td>
        <td>${event.date}</td>
        <td>${event.startTime}</td>
        <td>${event.endTime}</td>
        <td>${event.description}</td>
        <td>${event.status}</td>
        <td>
          <button class="btn btn-warning" onclick="editEvent(${index})">Modifier</button>
          <button class="btn btn-danger" onclick="deleteEvent(${index})">Supprimer</button>
        </td>
      </tr>
    `;
  });
}

// Fonction pour modifier un événement
function editEvent(index) {
  const event = events[index];
  editIndex = index; // Stocker l'index de l'événement en cours de modification

  // Remplir le formulaire avec les données de l'événement
  document.getElementById('eventTitle').value = event.title;
  document.getElementById('eventDate').value = event.date;
  document.getElementById('eventStartTime').value = event.startTime;
  document.getElementById('eventEndTime').value = event.endTime;
  document.getElementById('eventDescription').value = event.description;
  document.getElementById('eventStatus').value = event.status;

  // Ouvrir le modal
  const modal = new bootstrap.Modal(document.getElementById('eventModal'));
  modal.show();
}

// Fonction pour supprimer un événement
function deleteEvent(index) {
  events.splice(index, 1);
  refreshEvents();
}

// Mise à jour du calendrier avec les événements
function updateCalendar() {
  const calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: events.map(event => ({
      title: event.title,
      start: `${event.date}T${event.startTime}`,
      end: `${event.date}T${event.endTime}`,
    })),
    dateClick: function(info) {
      const selectedDate = info.dateStr;
      document.getElementById('eventDate').value = selectedDate;
      const modal = new bootstrap.Modal(document.getElementById('eventModal'));
      modal.show();
    }
  });
  calendar.render();
}

// Mise à jour des statistiques
function updateStats() {
  const upcoming = events.filter(e => e.status === 'À venir').length;
  const ongoing = events.filter(e => e.status === 'En cours').length;
  const completed = events.filter(e => e.status === 'Terminé').length;

  document.getElementById('statUpcoming').textContent = upcoming;
  document.getElementById('statOngoing').textContent = ongoing;
  document.getElementById('statCompleted').textContent = completed;
}

// Initialisation du tableau et du calendrier
updateEventList();
updateCalendar();
updateStats();

// Fonction de recherche des événements
function searchEvent() {
  const searchValue = document.getElementById('searchInput').value.toLowerCase();
  const filteredEvents = events.filter(e =>
    e.title.toLowerCase().includes(searchValue) ||
    e.description.toLowerCase().includes(searchValue)
  );
  events = filteredEvents; // Met à jour le tableau des événements filtrés
  updateEventList(); // Met à jour la liste avec les événements filtrés
}

// Fonction de défilement vers le haut
function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

</script>

</body>
</html>




