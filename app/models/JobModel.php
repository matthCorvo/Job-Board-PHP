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
    protected ?\PDO $database = null;

    /**
     * initialise une instance de la classe Database pour les interactions avec la base de données.
     */
    public function __construct(){
        $this->database = Database::connect();
    }

    /**
     * Récupère toutes les offres d'emploi disponibles dans la base de données.
     *
     * @return  
     */
    public function getAllJobs() {

        // Requête SQL à exécuter pour récupérer toutes les offres d'emploi
        $SQL = $this->database->prepare(
            'SELECT offres_emploi.*,
                villes.nom AS ville_nom,
                metiers.nom AS metier_nom,
                contrats.nom AS contrat_nom
             FROM offres_emploi 
             INNER JOIN villes ON offres_emploi.ville_id = villes.id
             INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
             INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id');

        // Exécution de la requête SQL
        $SQL->execute();

        // Récupération des données 
        $offresEmploi = $SQL->fetchAll(\PDO::FETCH_OBJ);

        // DEBUG
        //d($offresEmploi);

        // Renvoie les données récupérées
        return $offresEmploi;
    }

    /**
     * Récupère toutes les données pour le filtre.
     *
     * @return 
     */
    public function getFilteringCheckbox() {

    // Perform a database query to retrieve city names
    $sqlVille = $this->database->prepare('SELECT * FROM villes');
    $sqlVille->execute();

    // Fetch all city names and add them to the $villes array
    $villes = $sqlVille->fetchAll(\PDO::FETCH_OBJ);

    // You can now use the $villes array to display city names in your view.
    return $villes;
    
     
         

        //  $SQL_metiers = $this->database->prepare("SELECT distinct `metiers` FROM `offres_emploi` GROUP BY `metiers`");
        //  $SQL_metiers->execute();
        //  $metiers = $SQL_metiers->fetchAll(\PDO::FETCH_OBJ);

        //  $SQL_contrats = $this->database->prepare("SELECT distinct `contrats` FROM `offres_emploi` GROUP BY `contrats`");
        //  $SQL_contrats->execute();
        //  $contrats = $SQL_contrats->fetchAll(\PDO::FETCH_OBJ);

            // 'villes'     => $villes,
            // 'metiers' =>  $metiers,
            // 'contrats' =>  $contrats
       
         // Renvoie les données récupérées
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
