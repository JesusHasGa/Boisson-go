<?php
require_once __DIR__ . '/../utils/DB.php';
require_once __DIR__ . '/../models/User.php';

class UserDAO {
    private $connexion;

    public function __construct() {
        $this->connexion = DB::getConnection();
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['username'], $row['email'], $row['password'], $row['role']);
        }
        return null;
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['username'], $row['email'], $row['password'], $row['role']);
        }
        return null;
    }

    public function save(User $user) {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->connexion->prepare($sql);
        return $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole()
        ]);
    }
public function getAllUsers() {
    $sql = "SELECT * FROM users ORDER BY id ASC";
    $stmt = $this->connexion->query($sql);

    $resultats = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $resultats[] = new User(
            $row['id'],
            $row['username'],
            $row['email'],
            $row['password'],
            $row['role']
        );
    }
    return $resultats;
}


public function deleteById($id) {
    $stmt = $this->connexion->prepare("DELETE FROM users WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
public function findById($id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $this->connexion->prepare($sql);
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return new User($row['id'], $row['username'], $row['email'], $row['password'], $row['role']);
    }
    return null;
}
public function delete($id) {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $this->connexion->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

}
