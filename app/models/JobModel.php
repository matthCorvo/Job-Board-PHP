<?php

namespace App\Models;

use App\config\Database;

/**
 * Modèle de données pour la gestion des offres d'emploi.
 *
 * Cette classe gère les opérations liées aux offres d'emploi en se connectant à la base de données.
 */
class JobModel {

    // Déclaration de la propriété $database pour stocker l'instance de PDO.
    private ?\PDO $database = null;

    /**
     * initialise une instance de la classe Database pour les interactions avec la base de données.
     */
    public function __construct(){
        $this->database = Database::connect();
    }

    /**
     * Récupère toutes les offres d'emploi disponibles dans la base de données.
     *
     * @return array 
     */
    public function getAllJobs(): array {

        // Requête SQL à exécuter pour récupérer toutes les offres d'emploi
        $SQL = 'SELECT * FROM `job_listings`';

        // Préparation de la requête SQL
        $query = $this->database->prepare($SQL);

        // Exécution de la requête SQL
        $query->execute();

        // Récupération des données 
        $datas = $query->fetchAll(\PDO::FETCH_OBJ);
        
        // DEBUG
        //d($datas);

        // Renvoie les données récupérées
        return $datas;
    }
}
