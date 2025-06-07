<?php
require_once __DIR__ . '/../dao/BoissonDAO.php';
require_once __DIR__ . '/../models/Boisson.php';

class BoissonController {
    private $boissonDAO;

    public function __construct() {
        $this->boissonDAO = new BoissonDAO();
    }

    public function afficherCatalogue() {
        $boissons = $this->boissonDAO->getAllBoissons();
        require __DIR__ . '/../views/public/catalogue.php';
    }
    public function gererBoissons() {
    // Récupérer toutes les boissons (via DAO)
    $boissonDAO = new BoissonDAO();
$boissons = $this->boissonDAO->getAllBoissons();

    // Inclure la vue admin qui affichera la liste
    require __DIR__ . '/../views/admin/gerer_boissons.php';
}
public function showAddForm() {
    // Ici on pourrait récupérer les catégories si tu en as
    // $categorieDAO = new CategorieDAO();
    // $categories = $categorieDAO->findAll();

    require __DIR__ . '/../views/admin/ajouter_boisson.php';
}

public function addBoisson() {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $prix = floatval($_POST['prix']);
    $stock = intval($_POST['stock']);
    $categorie_id = intval($_POST['categorie_id']); // si tu as une catégorie

    // Tu peux ajouter des validations ici

    $boisson = new Boisson(null, $nom, $description, $prix, $stock, $categorie_id);

    $boissonDAO = new BoissonDAO();
    $boissonDAO->save($boisson); // save doit gérer insert ou update selon ID

    header('Location: index.php?action=admin_gestion_boissons');
    exit;
}
public function supprimerBoisson() {
    if (!Auth::estAdmin()) {
        header('Location: index.php');
        exit;
    }

    $id = $_GET['id'] ?? null;
    if ($id) {
        $this->boissonDAO->supprimer($id);
    }
    header('Location: index.php?action=admin_gestion_boissons');
    exit;
}
public function showEditForm() {
    if (!Auth::estAdmin()) {
        header('Location: index.php');
        exit;
    }

    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: index.php?action=admin_gestion_boissons');
        exit;
    }

    $boisson = $this->boissonDAO->findById($id);
    if (!$boisson) {
        header('Location: index.php?action=admin_gestion_boissons');
        exit;
    }

    require __DIR__ . '/../views/admin/edit_boisson.php';
}
public function updateBoisson() {
    if (!Auth::estAdmin()) {
        header('Location: index.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nom = trim($_POST['nom']);
        $description = trim($_POST['description']);
        $prix = floatval($_POST['prix']);
        $stock = intval($_POST['stock']);
        $categorie_id = intval($_POST['categorie_id']);

        $boisson = new Boisson($id, $nom, $description, $prix, $stock, $categorie_id);
        $this->boissonDAO->save($boisson);

        header('Location: index.php?action=admin_gestion_boissons');
        exit;
    }
}
public function afficherParCategorie(int $categorieId) {
    $boissonDAO = new BoissonDAO();
    $boissons = $boissonDAO->getBoissonsParCategorie($categorieId);

    require __DIR__ . '/../views/public/catalogue.php';
}
public function ajouterAuPanier() {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Location: index.php');
        exit;
    }

    $boisson = $this->boissonDAO->findById($id);
    if (!$boisson) {
        header('Location: index.php');
        exit;
    }

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Si déjà présent dans le panier, on augmente la quantité
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite']++;
    } else {
        $_SESSION['panier'][$id] = [
            'boisson' => $boisson,
            'quantite' => 1
        ];
    }

        header('Location: index.php?action=panier');
exit;
}
public function voirPanier() {
    $panier = $_SESSION['panier'] ?? [];
    require __DIR__ . '/../views/public/panier.php';
}
public function supprimerPanier() {
        
        $id = $_GET['id'] ?? null;

        if ($id !== null && isset($_SESSION['panier'][$id])) {
            unset($_SESSION['panier'][$id]);
        }

        header('Location: index.php?action=panier');
        exit;
    }

    public function viderPanier() {
        unset($_SESSION['panier']);
        
        header('Location: index.php?action=panier');
        exit;
    }
public function afficherPanier() {
    require_once __DIR__ . '/../models/Boisson.php';
    $panier = $_SESSION['panier'] ?? [];
    require __DIR__ . '/../views/public/panier.php';
}

public function modifierQuantite() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_GET['id'] ?? null;
        $quantite = intval($_POST['quantite'] ?? 1);

        if ($id !== null && $quantite > 0 && isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]['quantite'] = $quantite;
        }
    }
    header('Location: index.php?action=panier');
    exit;
}

public function passerCommande() {
    $panier = $_SESSION['panier'] ?? [];

    if (empty($panier)) {
        $_SESSION['error'] = "Votre panier est vide, impossible de passer commande.";
        header('Location: index.php?action=panier');
        exit;
    }

    $commande = [
        'id' => uniqid('cmd_'),
        'date' => date('Y-m-d H:i:s'),
        'items' => $panier
    ];

    if (!isset($_SESSION['commandes'])) {
        $_SESSION['commandes'] = [];
    }
    $_SESSION['commandes'][] = $commande;

    unset($_SESSION['panier']);

    $_SESSION['success'] = "Commande passée avec succès !";

    header('Location: index.php?action=panier');
    exit;
}
}

