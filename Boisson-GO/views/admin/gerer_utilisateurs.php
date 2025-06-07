<?php
require_once __DIR__ . '/../../utils/Auth.php';
if (!Auth::estAdmin()) {
    header('Location: ../../index.php');
    exit;
}

// Récupérer et afficher les messages flash puis les supprimer
$success = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Admin - Gestion des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<main class="container mt-5">
    <h1 class="mb-4">Gestion des utilisateurs</h1>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr><td colspan="5" class="text-center">Aucun utilisateur trouvé.</td></tr>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->getId() ?></td>
                        <td><?= htmlspecialchars($user->getUsername()) ?></td>
                        <td><?= htmlspecialchars($user->getEmail()) ?></td>
                        <td><?= htmlspecialchars($user->getRole()) ?></td>
                        <td>
                            <a href="index.php?action=supprimer_utilisateur&id=<?= $user->getId() ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Supprimer cet utilisateur ?');">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary mt-3">Retour à l'accueil</a>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



