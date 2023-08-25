<?php

namespace App\Models;

use App\config\Database;

/**
 * Modèle de données pour la gestion des offres d'emploi.
 *
 * Cette classe gère les opérations liées aux offres d'emploi en se connectant à la base de données.
 */
class Pagination {

   // Déclaration de la propriété $database pour stocker l'instance de PDO.
   protected ?\PDO $database = null;

   public $resultsPerPage;

   /**
    * initialise une instance de la classe Database pour les interactions avec la base de données.
    */
   public function __construct(){
       $this->database = Database::connect();
       $this->resultsPerPage = 10; // Use $this->resultsPerPage to set the class property
   }

    /**
     * Récupère toutes les offres d'emploi disponibles dans la base de données.
     *
     * @return  
     */
    public function calculateTotalPages() {

        
        // Prepare a query to count the total number of job listings
        $query = 'SELECT COUNT(*) AS total FROM offres_emploi';
        $stmt = $this->database->prepare($query);
        $stmt->execute();
        
        // Fetch the total number of job listings
        $totalJobListings = $stmt->fetchColumn();
        
        // Use $this->resultsPerPage to get the property value
        $numberOfPages = ceil($totalJobListings / $this->resultsPerPage);
    
        return $numberOfPages;
    }
    
    public function calculateOffset() {
        if (!isset($_GET['page'])) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
    
        // Use $this->resultsPerPage to get the property value
        $pageFirstResult = ($page - 1) * $this->resultsPerPage;
    
        return $pageFirstResult;
    }
    
    
}
