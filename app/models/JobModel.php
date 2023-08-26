<?php

namespace App\Models;

use App\config\Database;
use App\Controller\PaginationController;

/**
 * Modèle de données pour la gestion des offres d'emploi.
 *
 * Cette classe gère les opérations liées aux offres d'emploi en se connectant à la base de données.
 */
class JobModel {
    protected ?\PDO $database = null;
    
    /**
     * Initialise les variables.
     */
    public function __construct(){
        $this->database = Database::connect();
       
    }


    /**
     * Récupère les offres d'emploi filtrées en fonction du filtre.
     *
     * @param array $selectionVilles Tableau des villes sélectionnées pour le filtre.
     * @param array $selectionMetiers Tableau des métiers sélectionnés pour le filtre.
     * @param array $selectionContrats Tableau des contrats sélectionnés pour le filtre.
     * @param int $pageActuelle Le numéro de la page actuelle.
     * @param int $OffresParPage Le nombre d'articles par page.
     * @return array Les offres d'emploi filtrées.
     */
    public function getSelectionEmploi($offset, $OffresParPage) {
        // Construire la requête SQL
        $sql = $this->database->prepare('SELECT offres_emploi.*, 
                         villes.nom AS ville_nom, 
                         metiers.nom AS metier_nom, 
                         contrats.nom AS contrat_nom
                  FROM offres_emploi 
                  INNER JOIN villes ON offres_emploi.ville_id = villes.id
                  INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
                  INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id
                  LIMIT :offset, :limit
                  ');
    
    // Bind the parameters
    $sql->bindParam(':offset', $offset, \PDO::PARAM_INT);
    $sql->bindParam(':limit', $OffresParPage, \PDO::PARAM_INT);

    $sql->execute();

    // Récupérer les offres d'emploi filtrées
    $selectionEmploi = $sql->fetchAll(\PDO::FETCH_OBJ);
    
    // Renvoie les offres d'emploi filtrées en fonction des critères de recherche.
    return $selectionEmploi;
}

public function getTotalOffres() {
    // Construct the SQL query to count the total number of job offers
    $sql = $this->database->query('SELECT COUNT(*) as total FROM offres_emploi');
    $result = $sql->fetch(\PDO::FETCH_OBJ);
    // Return the total count
    
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
