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

     /**
     * Count the total number of filtered job offers.
     *
     * @return int The total count of filtered job offers.
     */
    public function countFilteredOffres($selectionVilles, $selectionMetiers, $selectionContrats) {
        // Initialize an empty array to hold the conditions
        $conditions = [];
    
        // Check if there are selected values for ville_id
        if (!empty($selectionVilles)) {
            $conditions[] = 'ville_id IN (' . implode(',', $selectionVilles) . ')';
        }
    
        // Check if there are selected values for metier_id
        if (!empty($selectionMetiers)) {
            $conditions[] = 'metier_id IN (' . implode(',', $selectionMetiers) . ')';
        }
    
        // Check if there are selected values for contrat_id
        if (!empty($selectionContrats)) {
            $conditions[] = 'contrat_id IN (' . implode(',', $selectionContrats) . ')';
        }
    
        // Build the SQL query dynamically based on the conditions
        $sql = 'SELECT COUNT(*) as total FROM offres_emploi';
    
        if (!empty($conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }
    
        // Prepare and execute the query
        $stmt = $this->database->prepare($sql);
        $stmt->execute();
    
        // Fetch the total count
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
        // Return the total count
        return (int)$result->total;
    }
    
    
}

?>
