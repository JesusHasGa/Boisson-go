<?php

class Boisson {
    private $id;
    private $nom;
    private $description;
    private $prix;
    private $stock;
    private $categorie_id;
    

    public function __construct($id, $nom, $description, $prix, $stock, $categorie_id) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->categorie_id = $categorie_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getCategorieId() {
        return $this->categorie_id;
    }
}

