
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
  bottom: 30px;
  right: 30px;
  display: none;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 50%;
  width: 45px;
  height: 45px;
  font-size: 24px;
  cursor: pointer;
  z-index: 9999;
  box-shadow: 0 2px 6px rgba(0,0,0,0.3);
  transition: opacity 0.3s ease;
}

.scroll-to-top:hover {
  background-color: #0056b3;
}

  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h3><i class="bi bi-calendar-event"></i> Dashboard</h3>
    <a href="#" class="active"><i class="bi bi-grid-fill"></i> Tableau de bord</a>
    <a href="mes_evenements.php"><i class="bi bi-calendar-check"></i> Mes événements</a>
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
  let events = [];
  let editIndex = null;

  document.addEventListener('DOMContentLoaded', () => {
    fetchEvents();

    document.getElementById('resetButton')?.addEventListener('click', () => {
      document.getElementById('eventForm').reset();
      editIndex = null;
    });

    document.getElementById('eventForm')?.addEventListener('submit', handleSubmit);
    document.getElementById('searchInput')?.addEventListener('input', searchEvent);
  });

  async function handleSubmit(e) {
    e.preventDefault();

    const newEvent = {
      title: document.getElementById('eventTitle').value,
      date: document.getElementById('eventDate').value,
      startTime: document.getElementById('eventStartTime').value,
      endTime: document.getElementById('eventEndTime').value,
      description: document.getElementById('eventDescription').value,
      status: document.getElementById('eventStatus').value
    };

    const url = editIndex === null ? 'create_event.php' : 'update_event.php';

    if (editIndex !== null) {
      newEvent.id = events[editIndex].id;
    }

    await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(newEvent)
    });

    document.getElementById('eventForm').reset();
    editIndex = null;

    const modal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
    modal?.hide();

    await fetchEvents();
  }

  async function fetchEvents() {
    try {
      const res = await fetch('read_events.php');
      events = await res.json();
      refreshEvents();
    } catch (err) {
      console.error('Erreur de récupération des événements :', err);
    }
  }

  function refreshEvents() {
    updateEventList();
    updateStats();
    updateCalendar();
  }

  function updateEventList(filteredEvents = events) {
    const tbody = document.getElementById('eventList');
    if (!tbody) return;

    tbody.innerHTML = '';
    filteredEvents.forEach((event, index) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${event.title}</td>
        <td>${event.date}</td>
        <td>${event.startTime}</td>
        <td>${event.endTime}</td>
        <td>${event.description}</td>
        <td><span class="badge bg-${getStatusColor(event.status)}">${event.status}</span></td>
        <td>
          <button class="btn btn-sm btn-warning me-1" onclick="editEvent(${index})"><i class="bi bi-pencil"></i></button>
          <button class="btn btn-sm btn-danger" onclick="deleteEvent(${index})"><i class="bi bi-trash"></i></button>
        </td>
      `;
      tbody.appendChild(row);
    });
  }

  function updateStats() {
    document.getElementById('statUpcoming').innerText = events.filter(e => e.status === 'À venir').length;
    document.getElementById('statOngoing').innerText = events.filter(e => e.status === 'En cours').length;
    document.getElementById('statCompleted').innerText = events.filter(e => e.status === 'Terminé').length;
  }

  function updateCalendar() {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    calendarEl.innerHTML = '';
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 500,
      selectable: true,
      events: events.map(e => ({
        title: e.title,
        start: `${e.date}T${e.startTime}`,
        end: `${e.date}T${e.endTime}`,
        description: e.description
      })),
      eventClick: function (info) {
        alert(`Événement : ${info.event.title}\n${info.event.extendedProps.description}`);
      },
      dateClick: function (info) {
        // Pré-remplir le champ date
        document.getElementById('eventDate').value = info.dateStr;

        // Réinitialiser les autres champs
        document.getElementById('eventTitle').value = '';
        document.getElementById('eventStartTime').value = '';
        document.getElementById('eventEndTime').value = '';
        document.getElementById('eventDescription').value = '';
        document.getElementById('eventStatus').value = 'À venir';

        editIndex = null;

        const modal = new bootstrap.Modal(document.getElementById('eventModal'));
        modal.show();
      }
    });

    calendar.render();
  }

  function getStatusColor(status) {
    switch (status) {
      case 'À venir': return 'primary';
      case 'En cours': return 'warning';
      case 'Terminé': return 'success';
      default: return 'secondary';
    }
  }

  function editEvent(index) {
    const e = events[index];
    document.getElementById('eventTitle').value = e.title;
    document.getElementById('eventDate').value = e.date;
    document.getElementById('eventStartTime').value = e.startTime;
    document.getElementById('eventEndTime').value = e.endTime;
    document.getElementById('eventDescription').value = e.description;
    document.getElementById('eventStatus').value = e.status;

    editIndex = index;
    const modal = new bootstrap.Modal(document.getElementById('eventModal'));
    modal.show();
  }

  async function deleteEvent(index) {
    if (confirm('Voulez-vous vraiment supprimer cet événement ?')) {
      const id = events[index].id;
      await fetch('delete_event.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });

      await fetchEvents();
    }
  }

  function searchEvent() {
    const query = document.getElementById('searchInput').value.toLowerCase();

    const filtered = events.filter(e =>
      e.title.toLowerCase().includes(query) ||
      e.description.toLowerCase().includes(query) ||
      e.status.toLowerCase().includes(query)
    );

    updateEventList(filtered);
  }

  // Mise à jour automatique toutes les 30 secondes
  setInterval(fetchEvents, 30000);




    // Afficher le bouton quand on scroll vers le bas
    window.addEventListener('scroll', function () {
    const scrollBtn = document.querySelector('.scroll-to-top');
    if (window.scrollY > 100) {
      scrollBtn.style.display = 'block';
    } else {
      scrollBtn.style.display = 'none';
    }
  });

  // Fonction pour revenir en haut
  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth' // défilement doux
    });
  }
</script>


</body>
</html>

