<?php
session_start();

// Supprimer toutes les variables de session
$_SESSION = [];

// Détruire la session
session_destroy();

// Supprimer les cookies s'ils existent
if (isset($_COOKIE['admin_email'])) {
    setcookie('admin_email', '', time() - 3600, '/');
}
if (isset($_COOKIE['admin_token'])) {
    setcookie('admin_token', '', time() - 3600, '/');
}

// Rediriger vers la page de connexion
header("Location: admin_login.php");
exit;
