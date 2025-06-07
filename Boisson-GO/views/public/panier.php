<?php
require_once __DIR__ . '/../../models/Boisson.php';

$panier = $_SESSION['panier'] ?? [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Votre Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="container py-5">
    <h1 class="mb-4">Votre Panier 🛒</h1>

    <!-- Messages succès / erreur -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (empty($panier)): ?>
        <div class="alert alert-info">Votre panier est vide.</div>
        <a href="index.php" class="btn btn-primary">Retour au catalogue</a>
    <?php else: ?>
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Boisson</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalGeneral = 0;
                foreach ($panier as $id => $item): 
                    $boisson = $item['boisson'];
                    $quantite = $item['quantite'];
                    $total = $boisson->getPrix() * $quantite;
                    $totalGeneral += $total;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($boisson->getNom()) ?></td>
                        <td><?= number_format($boisson->getPrix(), 2) ?> €</td>
                        <td>
                            <form method="post" action="index.php?action=modifier_quantite&id=<?= $id ?>" class="d-flex align-items-center">
                                <input 
                                    type="number" 
                                    name="quantite" 
                                    value="<?= $quantite ?>" 
                                    min="1" 
                                    class="form-control form-control-sm me-2" 
                                    style="width: 70px;"
                                    required
                                />
                                <button type="submit" class="btn btn-sm btn-primary">OK</button>
                            </form>
                        </td>
                        <td><?= number_format($total, 2) ?> €</td>
                        <td>
                            <a href="index.php?action=supprimer_panier&id=<?= $id ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Supprimer cet article du panier ?');">
                               Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="fw-bold">
                    <td colspan="3" class="text-end">Total général :</td>
                    <td colspan="2"><?= number_format($totalGeneral, 2) ?> €</td>
                </tr>
            </tbody>
        </table>

        <a href="index.php?action=vider_panier" class="btn btn-warning" onclick="return confirm('Vider tout le panier ?');">Vider le panier</a>
        <a href="index.php" class="btn btn-secondary ms-2">Continuer mes achats</a>

        <!-- Bouton Passer commande -->
        <form method="post" action="index.php?action=passer_commande" class="mt-3">
            <button type="submit" class="btn btn-success">Passer commande</button>
        </form>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


