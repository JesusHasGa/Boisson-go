<?php
require_once __DIR__ . '/../../utils/Auth.php';
if (!Auth::estAdmin()) {
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Admin - Gestion des boissons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<main class="container mt-5">
    <h1 class="mb-4">Gestion des boissons</h1>

    <a href="index.php?action=ajouter_boisson" class="btn btn-success mb-3">Ajouter une boisson</a>

    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix (€)</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($boissons)): ?>
                <tr><td colspan="7" class="text-center">Aucune boisson trouvée.</td></tr>
            <?php else: ?>
                <?php foreach ($boissons as $boisson): ?>
                    <tr>
                        <td><?= $boisson->getId() ?></td>
                        <td><?= htmlspecialchars($boisson->getNom()) ?></td>
                        <td><?= htmlspecialchars($boisson->getDescription()) ?></td>
                        <td><?= number_format($boisson->getPrix(), 2) ?></td>
                        <td><?= $boisson->getStock() ?></td>
                        <td><?= $boisson->getCategorieId() ?></td> <!-- Tu peux améliorer pour afficher le nom catégorie -->
                        <td>
                            <a href="index.php?action=modifier_boisson&id=<?= $boisson->getId() ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="index.php?action=supprimer_boisson&id=<?= $boisson->getId() ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Supprimer cette boisson ?');">
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
