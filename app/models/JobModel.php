<?php

namespace App\Models;

use App\config\Database;

/**
 * Modèle de données pour la gestion des offres d'emploi.
 *
 * Cette classe gère les opérations liées aux offres d'emploi en se connectant à la base de données.
 */
class JobModel {
    protected ?\PDO $database = null;
    
    /**
     * Initialise la base de donnée.
     */
    public function __construct(){
        $this->database = Database::connect();
       
    }


    /**
     * Récupère les offres d'emploi filtrées en fonction du filtre et de la pagination.
     *
     * @param int $pageDePagination  La position de départ des résultats à récupérer.
     * @param int $OffresParPage Le nombre d'articles par page.
     * @return array Les offres d'emploi filtrées.
     */
    public function getSelectionEmploi($pageDePagination, $OffresParPage) :array {
        // Construire la requête SQL pour récupérer les offres d'emploi filtrées et paginées
        $sql = $this->database->prepare('SELECT offres_emploi.*, 
                         villes.nom AS ville_nom, 
                         metiers.nom AS metier_nom, 
                         contrats.nom AS contrat_nom
                  FROM offres_emploi 
                  INNER JOIN villes ON offres_emploi.ville_id = villes.id
                  INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
                  INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id
                  LIMIT :pageDePagination, :offresParPage
                  ');
    
        // Securiser les paramètres
        $sql->bindParam(':pageDePagination', $pageDePagination, \PDO::PARAM_INT);
        $sql->bindParam(':offresParPage', $OffresParPage, \PDO::PARAM_INT);

        $sql->execute();

        // Récupérer les offres d'emploi filtrées et paginées
        $selectionEmploi = $sql->fetchAll(\PDO::FETCH_OBJ);
    
        // Renvoie les offres d'emploi filtrées en fonction des critères de recherche et de la pagination.
        return $selectionEmploi;
    }

    /**
     * Récupère le nombre total d'offres d'emploi dans la base de données.
     *
     * @return int Le nombre total d'offres d'emploi.
     */
    public function getTotalOffres() : int{
        // Construire la requête SQL pour compter le nombre total d'offres d'emploi
        $sql = $this->database->query('SELECT COUNT(*) as total FROM offres_emploi');
        $result = $sql->fetch(\PDO::FETCH_OBJ);
        
        // Retourner le nombre total d'offres d'emploi
        return (int)$result->total;
    }


// tri
// if(isset($_GET['sort_price']) && $_GET['sort_price']!="") :
//     if($_GET['sort_price']=='price-asc-rank') :
//         $sql.=" ORDER BY price ASC";
//     elseif($_GET['sort_price']=='price-desc-rank') :
//         $sql.=" ORDER BY price DESC";
//     endif;
// endif;
    
}

?>
