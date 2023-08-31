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
        $sql = $this->database->query(
               'SELECT metiers.id AS metier_id, metiers.nom AS metier_nom, 
                COUNT(offres_emploi.id) AS total
                FROM metiers
                LEFT JOIN offres_emploi ON metiers.id = offres_emploi.metier_id
                GROUP BY metiers.id, metiers.nom
                ORDER BY metiers.nom ASC');
    

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
        $sql = $this->database->query(
        'SELECT villes.id AS ville_id, villes.nom AS ville_nom, 
        COUNT(offres_emploi.id) AS total
        FROM villes
        LEFT JOIN offres_emploi ON villes.id = offres_emploi.ville_id
        GROUP BY villes.id, villes.nom
        ORDER BY villes.nom ASC');

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
        $sql = $this->database->query(
            'SELECT contrats.id AS contrat_id, contrats.nom AS contrat_nom, 
             COUNT(offres_emploi.id) AS total
             FROM contrats
             JOIN offres_emploi ON contrats.id = offres_emploi.contrat_id
             GROUP BY contrats.id, contrats.nom
             ORDER BY contrats.nom ASC');

        $sql->execute();
        // Récupère les résultats sous forme d'objets
        $contrats = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $contrats;

    }
    
    
    
}

?>
