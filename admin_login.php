<?php
session_start();

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=calendrier_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Redirection si déjà connecté
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit;
}

// Vérification via cookies (se souvenir de moi)
if (isset($_COOKIE['admin_email']) && isset($_COOKIE['admin_token'])) {
    // En production : vérifier le token dans la base
    $_SESSION['admin_id'] = 1;
    $_SESSION['admin_email'] = $_COOKIE['admin_email'];
    header("Location: admin_dashboard.php");
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    // Exemple simple (à remplacer par base de données)
    $admin_email = "admin@example.com";
    $admin_password = "supersecret123";

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin_id'] = 1;
        $_SESSION['admin_email'] = $email;

        if ($remember) {
            setcookie('admin_email', $email, time() + (86400 * 30), "/");
            setcookie('admin_token', bin2hex(random_bytes(16)), time() + (86400 * 30), "/");
        }

        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }

        .card {
            background-color: #ffffffcc;
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        h4 {
            color: #343a40;
            font-weight: bold;
        }

        .form-label {
            color: #495057;
        }

        .form-check-label {
            color: #6c757d;
        }

        .btn-dark {
            background-color: #343a40;
            border: none;
        }

        .btn-dark:hover {
            background-color: #212529;
        }

        .alert {
            font-size: 0.9rem;
        }

        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            height: 100%;
            width: 220px;
            background-color: #212529;
            padding-top: 20px;
            z-index: 999;
        }

        .sidebar a {
            color: #adb5bd;
            padding: 15px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #343a40;
            color: #ffffff;
            border-left: 4px solid #0dcaf0;
        }

        .sidebar h5 {
            color: #dee2e6;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> EasyPlan Admin</a>
    </div>
</nav>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-3">Connexion Administrateur</h4>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="email" class="form-label">Email Administrateur</label>
                <input type="email" class="form-control" name="email" id="email" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-dark">Connexion</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
