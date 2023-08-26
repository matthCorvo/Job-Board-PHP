<?php

namespace App\Models;

use App\config\Database;

/**
 * Modèle de données pour la gestion des filtres.
 *
 * Cette classe gère les opérations liées aux filtres en se connectant à la base de données.
 */
class FiltreModel {
    protected ?\PDO $database = null;
 

    /**
     * Initialise la connexion à la base de données.
     */
    public function __construct(){
        $this->database = Database::connect();
    }

   /**
     * Récupère les métiers disponibles dans la base de données.
     *
     * @return array Un tableau contenant les métiers disponibles.
     */
    public function getFiltreMetiers() {
        // Exécute une requête pour récupérer les métiers distincts
        $sql = $this->database->query('SELECT DISTINCT * FROM metiers');
        $sql->execute();
        // Récupère les résultats sous forme d'objets
        $metiers = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $metiers;
    }

    /**
     * Récupère les villes disponibles dans la base de données.
     *
     * @return array Un tableau contenant les villes disponibles.
     */
    public function getFiltreVilles() {
        // Exécute une requête pour récupérer les villes distinctes
        $sql = $this->database->query('SELECT DISTINCT * FROM villes');
        $sql->execute();
        // Récupère les résultats sous forme d'objets
        $villes = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $villes;
    }

    /**
     * Récupère les contrats disponibles dans la base de données.
     *
     * @return array Un tableau contenant les contrats disponibles.
     */
    public function getFiltreContrats() {
        // Exécute une requête pour récupérer les contrats distincts
        $sql = $this->database->query('SELECT DISTINCT * FROM contrats');
        $sql->execute();
        // Récupère les résultats sous forme d'objets
        $contrats = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $contrats;
    }
}

?>
