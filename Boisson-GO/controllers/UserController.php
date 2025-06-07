<?php
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../utils/Auth.php'; // ✅ Ajoute cette ligne


class UserController {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    }

    public function showRegisterForm() {
        require __DIR__ . '/../views/public/register.php';
    }

    public function register() {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($password !== $confirmPassword) {
            $error = "Les mots de passe ne correspondent pas.";
            require __DIR__ . '/../views/public/register.php';
            return;
        }

        if ($this->userDAO->findByUsername($username)) {
            $error = "Nom d'utilisateur déjà pris.";
            require __DIR__ . '/../views/public/register.php';
            return;
        }

        if ($this->userDAO->findByEmail($email)) {
            $error = "Email déjà utilisé.";
            require __DIR__ . '/../views/public/register.php';
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(null, $username, $email, $hashedPassword);

        if ($this->userDAO->save($user)) {
            header('Location: index.php?action=login');
            exit;
        } else {
            $error = "Erreur lors de l'inscription.";
            require __DIR__ . '/../views/public/register.php';
        }
    }

    public function showLoginForm() {
        require __DIR__ . '/../views/public/login.php';
    }

public function login() {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $user = $this->userDAO->findByUsername($username);

    if (!$user || !password_verify($password, $user->getPassword())) {
        $error = "Identifiants invalides.";
        require __DIR__ . '/../views/public/login.php';
        return;
    }

    // Authentifier l'utilisateur
    require_once __DIR__ . '/../utils/Auth.php';
    Auth::connecter($user);

    // Rediriger selon le rôle
    if ($user->getRole() === 'admin') {
        header('Location: index.php?action=admin_dashboard');
    } else {
        header('Location: index.php');
    }
    exit;
}


public function logout() {
    Auth::deconnecter();
    header('Location: index.php');
    exit;
}
public function gererUtilisateurs() {
    if (!Auth::estAdmin()) {
        header('Location: index.php');
        exit;
    }
    $users = $this->userDAO->getAllUsers(); // méthode à créer si elle n'existe pas
    require __DIR__ . '/../views/admin/gerer_utilisateurs.php';
}

public function supprimerUtilisateur() {
    if (!isset($_GET['id'])) {
        header('Location: index.php?action=gerer_utilisateurs');
        exit;
    }

    $id = (int)$_GET['id'];
    $user = $this->userDAO->findById($id);

    if (!$user) {
        // utilisateur non trouvé, redirection
        header('Location: index.php?action=gerer_utilisateurs');
        exit;
    }

    // Vérifier que l'utilisateur n'est pas admin
    if ($user->getRole() === 'admin') {
        // Message d'erreur ou redirection avec un message
        $_SESSION['error'] = "Impossible de supprimer un utilisateur admin.";
        header('Location: index.php?action=gerer_utilisateurs');
        exit;
    }

    // Sinon supprimer l'utilisateur
    $this->userDAO->delete($id);

    header('Location: index.php?action=gerer_utilisateurs');
    exit;
}




}

