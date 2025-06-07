<?php
require_once __DIR__ . '/../../utils/Auth.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
  <a class="navbar-brand" href="index.php">Boisson-GO</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ms-auto">
      <?php if (Auth::estConnecte()): ?>
        <li class="nav-item me-3">
          <span class="nav-link">Bonjour, <?= htmlspecialchars(Auth::getUtilisateur()['username']) ?> !</span>
        </li>

        <li class="nav-item me-3">
<a class="nav-link" href="index.php?action=panier">Panier</a>
        </li>
        
        <?php if (Auth::estAdmin()): ?>
          <li class="nav-item me-3">
            <a class="nav-link" href="index.php?action=admin_dashboard">Admin</a>
          </li>
        <?php endif; ?>
        
        <li class="nav-item">
          <a class="nav-link text-danger" href="index.php?action=logout">Déconnexion</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=login">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=register">Inscription</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>



