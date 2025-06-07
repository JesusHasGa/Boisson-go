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
    <title>Ajouter une boisson</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<main class="container mt-5">
    <h1>Ajouter une boisson</h1>

    <form method="post" action="index.php?action=ajouter_boisson_submit">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix (€)</label>
            <input type="number" id="prix" name="prix" class="form-control" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie (ID)</label>
            <input type="number" id="categorie_id" name="categorie_id" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="index.php?action=admin_gestion_boissons" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
