<?php
class DB {
    private static $connexion = null;

    public static function getConnection() {
        if (self::$connexion === null) {
            try {
                self::$connexion = new PDO(
                    'pgsql:host=localhost;port=5432;dbname=boissons',
                    'postgres',  // ton utilisateur PG
                    'postgres' // ton mot de passe PG
                );
                self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base : ' . $e->getMessage());
            }
        }
        return self::$connexion;
    }
}


