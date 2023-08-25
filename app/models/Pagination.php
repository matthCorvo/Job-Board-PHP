<?php

namespace App\Models;

use App\config\Database;

/**
 * Modèle de données pour la gestion de la pagination des offres d'emploi.
 *
 * Cette classe gère les opérations liées à la pagination des offres d'emploi en se connectant à la base de données.
 */
class Pagination {

   // Déclaration de la propriété $database pour stocker l'instance de PDO.
   protected ?\PDO $database = null;
   public $OffresParPage;

   /**
    * Initialise une instance de la classe Database pour les interactions avec la base de données.
    */
   public function __construct(){
       $this->database = Database::connect();
       $this->OffresParPage = 10; 
   }

    /**
     * Calcule le nombre total de pages nécessaires pour paginer les offres d'emploi.
     *
     * @return int Le nombre total de pages.
     */
    public function calculTotalPages() : int {

        // Prépare une requête pour compter le nombre total d'offres d'emploi
        $query = 'SELECT COUNT(*) AS total FROM offres_emploi';
        $stmt = $this->database->prepare($query);
        $stmt->execute();
        
        // Récupère le nombre total d'offres d'emploi
        $totalSelectionEmploi = $stmt->fetchColumn();
        
        $numberOfPages = ceil($totalSelectionEmploi / $this->OffresParPage);
    
        return $numberOfPages;
    }
    
    /**
     * Calcule l'offset nécessaire pour paginer les offres d'emploi.
     *
     * @return int L'offset pour la requête SQL.
     */
    public function calculateOffset() : int {
        if (!isset($_GET['page'])) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
    
        $pageFirstResult = ($page - 1) * $this->OffresParPage;
    
        return $pageFirstResult;
    }
}

    
    

