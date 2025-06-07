<?php include __DIR__ . '/../partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Modifier une boisson</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<main class="container mt-5">
    <h1>Modifier une boisson</h1>
    <form method="post" action="index.php?action=modifier_boisson_submit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($boisson->getId()) ?>">
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($boisson->getNom()) ?>" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($boisson->getDescription()) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Prix (€)</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="<?= htmlspecialchars($boisson->getPrix()) ?>" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars($boisson->getStock()) ?>" required>
        </div>
        <div class="mb-3">
            <label>Catégorie</label>
            <input type="number" name="categorie_id" class="form-control" value="<?= htmlspecialchars($boisson->getCategorieId()) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="index.php?action=admin_gestion_boissons" class="btn btn-secondary">Annuler</a>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
