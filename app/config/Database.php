<?php

namespace App\config;

use PDO;
use PDOException;

/**
 * Classe Database pour la Gestion de la Connexion à la Base de Données
 *
 */
class Database {

    /**
     * Établir une connexion à la base de données.
     *
     * @return \PDO|null Instance de la classe PDO représentant la connexion à la base de données ou null en cas d'échec.
     */
    public static function connect() {
        try {
            // Configuration de la connexion à la base de données 
            $conn = new PDO("mysql:host=localhost;port=3306;dbname=job_board;charset=utf8", "SUBSKILL", "SUBSKILL");

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
