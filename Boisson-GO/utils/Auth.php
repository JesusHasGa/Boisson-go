<?php
class Auth {
    public static function connecter($user) {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ];
    }

    public static function estConnecte() {
        return isset($_SESSION['user']);
    }

    public static function estAdmin() {
        return self::estConnecte() && $_SESSION['user']['role'] === 'admin';
    }

    public static function deconnecter() {
        session_destroy();
    }

    public static function getUtilisateur() {
        return $_SESSION['user'] ?? null;
    }
}


