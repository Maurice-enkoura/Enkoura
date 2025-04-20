<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - Mon Agenda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f2f8ff;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container-fluid {
      min-height: 100vh;
    }

    .left-section {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #fff;
      padding: 3rem 2rem;
    }

    .form-container {
      width: 100%;
      max-width: 400px;
    }

    .btn-blue {
      background-color: #007bff;
      color: white;
    }

    .btn-blue:hover {
      background-color: #0056b3;
    }

    .right-section {
      background-image: url('https://media.istockphoto.com/id/1447963729/fr/photo/%C3%A9pingles-miniatures-sur-un-calendrier.jpg?s=612x612&w=0&k=20&c=VxkDPzGI-TWtDzSjE5JB4sZZlUaLbz2tkoBfWpK303Y=');
      background-size: cover;
      background-position: center;
      position: relative;
      height: 100vh;
      color: white;
    }

    .overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .overlay-text {
      position: relative;
      z-index: 2;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 2rem;
    }

    .overlay-text h2 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 1rem;
      text-shadow: 0 2px 4px rgba(0,0,0,0.6);
    }

    .overlay-text p {
      font-size: 1.2rem;
      text-shadow: 0 1px 3px rgba(0,0,0,0.5);
    }

    .form-check {
      margin-top: 1rem;
    }

    @media (max-width: 767px) {
      .right-section {
        display: none;
      }
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Formulaire de connexion -->
    <div class="col-md-6 left-section">
      <div class="form-container">
        <h3 class="text-center mb-4">Se connecter</h3>
    
        <form action="login.php" method="POST">
          <div class="mb-3">
            <label class="form-label"><i class="fa fa-envelope"></i> Email</label>
            <input type="email" class="form-control" name="email" required placeholder="Entrez votre adresse email">
            <small class="form-text text-muted">Entrez une adresse email valide.</small>
          </div>
          <div class="mb-3">
            <label class="form-label"><i class="fa fa-lock"></i> Mot de passe</label>
            <input type="password" class="form-control" name="password" required placeholder="Votre mot de passe">
            <small class="form-text text-muted">Le mot de passe doit comporter au moins 8 caractères.</small>
          </div>
          
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
          </div>

          <button type="submit" class="btn btn-blue w-100">Se connecter</button>
          <p class="mt-3 text-center">Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
        </form>
      </div>
    </div>

    <!-- Image + Branding -->
    <div class="col-md-6 right-section d-none d-md-block">
      <div class="overlay"></div>
      <div class="overlay-text">
        <h2>Bienvenue sur Mon Agenda</h2>
        <p>Planifiez vos journées, vos tâches et vos projets plus facilement.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
