<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {

    /**
     * Connexion à la base de données.
     *
     * @return \PDO|null Instance de la classe PDO - connexion à la base de données ou null en cas d'échec.
     */
    public static function connect() {
        try {
            // Configuration de la connexion à la base de données 
            $conn = new PDO("mysql:host=mysql-jobboard.alwaysdata.net;dbname=jobboard_matthc;charset=utf8", "jobboard", "Cyprie971!");

            // Configure PDO to throw exceptions on error
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Renvoie l'instance PDO pour la connexion à la base de données
            return $conn;
        } catch (PDOException $e) {
            // Le renvoi de null indique que la connexion a échoué.
            return null;
        }
    }
}
