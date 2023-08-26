<?php

namespace App\Models;

use App\config\Database;

/**
 * Modèle de données pour la gestion des offres d'emploi.
 *
 * Cette classe gère les opérations liées aux offres d'emploi en se connectant à la base de données.
 */
class FiltreModel {
    protected ?\PDO $database = null;


    /**
     * Initialise les variables.
     */
    public function __construct(){
        $this->database = Database::connect();
    }

   /**
     * Récupère les métiers disponibles dans la base de données.
     *
     * @return array Les métiers disponibles.
     */
    public function getFiltreMetiers() {
        $sql = $this->database->query('SELECT DISTINCT * FROM metiers');
        $sql->execute();
        $metiers = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $metiers;
    }

    /**
     * Récupère les villes disponibles dans la base de données.
     *
     * @return array Les villes disponibles.
     */
    public function getFiltreVilles() {
        $sql = $this->database->query('SELECT DISTINCT * FROM villes');
        $sql->execute();
        $villes = $sql->fetchAll(\PDO::FETCH_OBJ);
        return  $villes;
    }

    /**
     * Récupère les contrats disponibles dans la base de données.
     *
     * @return array Les contrats disponibles.
     */
    public function getFiltreContrats() {
        $sql = $this->database->query('SELECT DISTINCT * FROM contrats');
        $sql->execute();
        $contrats = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $contrats;
    }
}

?>
