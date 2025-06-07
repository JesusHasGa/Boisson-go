<?php
require_once __DIR__ . '/controllers/BoissonController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/utils/Auth.php';
require_once __DIR__ . '/models/Boisson.php';
session_start();


$boissonController = new BoissonController();
$userController = new UserController();

$action = $_GET['action'] ?? null;

switch ($action) {

    // === AUTHENTIFICATION ===
    case 'register':
        $userController->showRegisterForm();
        break;

    case 'register_submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->register();
        }
        break;

    case 'login':
        $userController->showLoginForm();
        break;

    case 'login_submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->login();
        }
        break;

    case 'logout':
        $userController->logout();
        break;

    // === ADMINISTRATION ===
    case 'admin_dashboard':
        if (Auth::estAdmin()) {
            require __DIR__ . '/views/admin/dashboard.php';
        } else {
            header('Location: index.php');
            exit;
        }
        break;

    case 'gerer_utilisateurs':
        if (Auth::estAdmin()) {
            $userController->gererUtilisateurs();
        } else {
            header('Location: index.php');
            exit;
        }
        break;

    case 'supprimer_utilisateur':
        $userController->supprimerUtilisateur();
        break;

    case 'admin_gestion_boissons':
        if (Auth::estAdmin()) {
            $boissonController->gererBoissons();
        } else {
            header('Location: index.php');
        }
        break;

    case 'ajouter_boisson':
        if (Auth::estAdmin()) {
            $boissonController->showAddForm();
        } else {
            header('Location: index.php');
        }
        break;

    case 'ajouter_boisson_submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && Auth::estAdmin()) {
            $boissonController->addBoisson();
        } else {
            header('Location: index.php');
        }
        break;

    case 'supprimer_boisson':
        $boissonController->supprimerBoisson();
        break;

    case 'modifier_boisson':
        $boissonController->showEditForm();
        break;

    case 'modifier_boisson_submit':
        $boissonController->updateBoisson();
        break;

    case 'filtrer_categorie':
        $categorieId = isset($_GET['categorie_id']) && $_GET['categorie_id'] !== '' ? (int)$_GET['categorie_id'] : null;
        if ($categorieId) {
            $boissonController->afficherParCategorie($categorieId);
        } else {
            $boissonController->afficherCatalogue();
        }
        break;

    // PANIER
    case 'ajouter_au_panier':
        $boissonController->ajouterAuPanier();
        break;

    case 'panier':
        $boissonController->afficherPanier();
        break;

    case 'supprimer_panier':
        $boissonController->supprimerPanier();
        break;

    case 'vider_panier':
        $boissonController->viderPanier();
        break;
    case 'modifier_quantite':
        $boissonController->modifierQuantite();
    break;
        case 'passer_commande':
    $boissonController->passerCommande();
    break;


    // === PAR DÉFAUT : AFFICHAGE CATALOGUE ===
    default:
        $boissonController->afficherCatalogue();
        break;
}


