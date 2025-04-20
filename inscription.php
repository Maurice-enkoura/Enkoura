<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription - Mon Agenda</title>
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
      background-image: url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1200&q=80');
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
    <!-- Formulaire d'inscription -->
    <div class="col-md-6 left-section">
      <div class="form-container">
        <h3 class="text-center mb-4">S'inscrire</h3>
        <!-- Affichage de l'erreur, si nécessaire -->
        <!-- <div class="alert alert-danger">Message d'erreur ici</div> -->
        <form action="inscription.php" method="POST">
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
          <div class="mb-3">
            <label class="form-label"><i class="fa fa-lock"></i> Confirmer le mot de passe</label>
            <input type="password" class="form-control" name="confirm_password" required placeholder="Confirmez votre mot de passe">
            <small class="form-text text-muted">Les mots de passe doivent correspondre.</small>
          </div>
          <button type="submit" class="btn btn-blue w-100">S'inscrire</button>
          <p class="mt-3 text-center">Déjà un compte ? <a href="se_connecter.php">Se connecter</a></p>
        </form>
      </div>
    </div>

    <!-- Image + Branding -->
    <div class="col-md-6 right-section d-none d-md-block">
      <div class="overlay"></div>
      <div class="overlay-text">
        <h2>Bienvenue sur Mon Agenda</h2>
        <p>Rejoignez-nous et commencez à organiser vos journées, tâches et projets.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
