<?php

namespace App\config;

/**
 * Classe Database pour la Gestion de la Connexion à la Base de Données
 *
 */
class Database {

    /**
     * Établir une connexion à la base de données.
     *
     * @return \PDO  instance de la classe PDO représentant la connexion à la base de données.
     */
    public static function connect() {

        // Configuration de la connexion à la base de données 
        $conn = new \PDO("mysql:host=localhost;port=3306;dbname=matthc_jobboard;charset=utf8", "SUBSKILL", "SUBSKILL");

        // Renvoie l'instance PDO pour la connexion à la base de données
        return $conn;
    }
}
?>
