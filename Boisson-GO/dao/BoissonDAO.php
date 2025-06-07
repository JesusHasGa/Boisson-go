<?php
require_once __DIR__ . '/../utils/DB.php';
require_once __DIR__ . '/../models/Boisson.php';

class BoissonDAO {
    private $connexion;

    public function __construct() {
        $this->connexion = DB::getConnection();
    }

    public function getAllBoissons() {
        $sql = "SELECT * FROM boissons";
        $stmt = $this->connexion->query($sql);
        $resultats = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultats[] = new Boisson(
                $row['id'],
                $row['nom'],
                $row['description'],
                $row['prix'],
                $row['stock'],
                $row['categorie_id']
                
            );
        }

        return $resultats;
    }
    public function save(Boisson $boisson) {
    if ($boisson->getId() === null) {
        // Insert
        $sql = "INSERT INTO boissons (nom, description, prix, stock, categorie_id) 
                VALUES (:nom, :description, :prix, :stock, :categorie_id)";
        $stmt = $this->connexion->prepare($sql);
        $success = $stmt->execute([
            'nom' => $boisson->getNom(),
            'description' => $boisson->getDescription(),
            'prix' => $boisson->getPrix(),
            'stock' => $boisson->getStock(),
            'categorie_id' => $boisson->getCategorieId()
        ]);
        if ($success) {
            // Met à jour l'ID dans l'objet Boisson si besoin
            $boissonId = $this->connexion->lastInsertId();
            // Si tu veux setter l'id dans l'objet, il faut une méthode setId() dans Boisson
            // $boisson->setId($boissonId);
        }
        return $success;
    } else {
        // Update
        $sql = "UPDATE boissons SET nom = :nom, description = :description, prix = :prix, stock = :stock, categorie_id = :categorie_id
                WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        return $stmt->execute([
            'nom' => $boisson->getNom(),
            'description' => $boisson->getDescription(),
            'prix' => $boisson->getPrix(),
            'stock' => $boisson->getStock(),
            'categorie_id' => $boisson->getCategorieId(),
            'id' => $boisson->getId()
        ]);
    }
}
public function supprimer($id) {
    $sql = "DELETE FROM boissons WHERE id = :id";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
public function findById(int $id): ?Boisson {
    $sql = "SELECT * FROM boissons WHERE id = :id";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return new Boisson(
            $row['id'],
            $row['nom'],
            $row['description'],
            $row['prix'],
            $row['stock'],
            $row['categorie_id']
        );
    }
    return null;
}
public function getBoissonsParCategorie(int $categorieId): array {
    $sql = "SELECT * FROM boissons WHERE categorie_id = :categorie_id";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindParam(':categorie_id', $categorieId, PDO::PARAM_INT);
    $stmt->execute();

    $boissons = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $boissons[] = new Boisson(
            $row['id'],
            $row['nom'],
            $row['description'],
            $row['prix'],
            $row['stock'],
            $row['categorie_id']
        );
    }
    return $boissons;
}


}
