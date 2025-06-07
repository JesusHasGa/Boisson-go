<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

<div class="container py-5">
    <h1>Inscription</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

<form method="post" action="/Techno 2 projet/Boisson-GO/index.php?action=register_submit">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required class="form-control" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" id="email" name="email" required class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" id="password" name="password" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
            <input type="password" id="confirm_password" name="confirm_password" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>

    <p class="mt-3">Déjà inscrit ? <a href="index.php?action=login">Se connecter</a></p>
</div>

</body>
</html>



