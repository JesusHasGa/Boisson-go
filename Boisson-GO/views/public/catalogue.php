<?php
// Mapping des catégories
$categories = [
    1 => ['label' => 'Soda', 'color' => 'primary'],
    2 => ['label' => 'Jus', 'color' => 'warning'],
    3 => ['label' => 'Eau', 'color' => 'info'],
    4 => ['label' => 'Alcool', 'color' => 'danger'],
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue des Boissons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php require_once __DIR__ . '/../../controllers/BoissonController.php'; ?>
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold text-primary">Notre sélection de boissons 🍹</h1>

    <!-- Formulaire de filtrage -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form method="get" action="index.php" class="d-flex align-items-center gap-3">
                <input type="hidden" name="action" value="filtrer_categorie">
                <label for="categorie_id" class="form-label mb-0">Catégorie</label>
                <select class="form-select" name="categorie_id" id="categorie_id" onchange="this.form.submit()">
                    <option value="">Toutes les catégories</option>
                    <option value="1" <?= (isset($_GET['categorie_id']) && $_GET['categorie_id'] == 1) ? 'selected' : '' ?>>Soda</option>
                    <option value="2" <?= (isset($_GET['categorie_id']) && $_GET['categorie_id'] == 2) ? 'selected' : '' ?>>Jus</option>
                    <option value="3" <?= (isset($_GET['categorie_id']) && $_GET['categorie_id'] == 3) ? 'selected' : '' ?>>Eau</option>
                    <option value="4" <?= (isset($_GET['categorie_id']) && $_GET['categorie_id'] == 4) ? 'selected' : '' ?>>Alcool</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Affichage des boissons -->
    <div class="row">
        <?php foreach ($boissons as $boisson): 
            $cat = $categories[$boisson->getCategorieId()] ?? ['label' => 'Inconnu', 'color' => 'secondary'];
        ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title"><?= htmlspecialchars($boisson->getNom()) ?></h5>
                            <span class="badge bg-<?= $cat['color'] ?>"><?= $cat['label'] ?></span>
                        </div>
                        <p class="card-text text-muted small flex-grow-1"><?= htmlspecialchars($boisson->getDescription()) ?></p>
                        <p class="card-text fw-bold mb-1">💶 <?= number_format($boisson->getPrix(), 2) ?> €</p>
                        <p>
                            <?php if ($boisson->getStock() > 0): ?>
                                <span class="badge bg-success">Stock : <?= $boisson->getStock() ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger">Rupture de stock</span>
                            <?php endif; ?>
                        </p>
                        <a href="index.php?action=ajouter_au_panier&id=<?= $boisson->getId() ?>" 
                           class="btn btn-outline-primary mt-auto w-100 <?= $boisson->getStock() == 0 ? 'disabled' : '' ?>">
                           Ajouter au panier
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    $commandes = $_SESSION['commandes'] ?? [];
    ?>

    <?php if (!empty($commandes)): ?>
        <hr class="my-5">
        <h2 class="mb-4 text-center text-secondary">Vos commandes passées</h2>

        <div class="accordion" id="accordionCommandes">
            <?php foreach ($commandes as $index => $cmd): ?>
                <div class="accordion-item mb-3 shadow-sm rounded">
                    <h2 class="accordion-header" id="heading<?= $index ?>">
                        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                            Commande #<?= htmlspecialchars($cmd['id']) ?> — <small class="text-muted ms-2">passée le <?= htmlspecialchars($cmd['date']) ?></small>
                            <span class="badge bg-success ms-auto"><?= count($cmd['items']) ?> article<?= count($cmd['items']) > 1 ? 's' : '' ?></span>
                        </button>
                    </h2>
                    <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#accordionCommandes">
                        <div class="accordion-body">
                            <ul class="list-group">
                                <?php 
                                $totalCmd = 0;
                                foreach ($cmd['items'] as $id => $item):
                                    $boisson = $item['boisson'];
                                    $quantite = $item['quantite'];
                                    $total = $boisson->getPrix() * $quantite;
                                    $totalCmd += $total;
                                ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <?= htmlspecialchars($boisson->getNom()) ?> 
                                            <span class="badge bg-info text-dark ms-2"><?= $quantite ?> × <?= number_format($boisson->getPrix(), 2) ?> €</span>
                                        </div>
                                        <span class="fw-bold"><?= number_format($total, 2) ?> €</span>
                                    </li>
                                <?php endforeach; ?>
                                <li class="list-group-item list-group-item-warning fw-bold d-flex justify-content-between">
                                    Total commande :
                                    <span><?= number_format($totalCmd, 2) ?> €</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





