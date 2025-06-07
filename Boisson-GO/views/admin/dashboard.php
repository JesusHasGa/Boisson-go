<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../utils/Auth.php';

if (!Auth::estAdmin()) {
    header('Location: ../../index.php');
    exit;
}
?>
<!-- Ton code HTML du dashboard ici -->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <h1 class="mb-4">Bienvenue dans le tableau de bord, <?= htmlspecialchars($_SESSION['user']['username']) ?> 👑</h1>

        <div class="list-group">
            <a href="index.php?action=gerer_utilisateurs"class="list-group-item list-group-item-action">Gérer les utilisateurs</a>
            <a href="index.php?action=admin_gestion_boissons" class="list-group-item list-group-item-action">Gérer les boissons</a>
            <a href="index.php" class="list-group-item list-group-item-action">Retour au site</a>
        </div>
    </div>
</body>
</html>
