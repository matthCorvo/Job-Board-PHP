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
     * Récupère les offres d'emploi filtrées en fonction des filtres de tri et de la pagination.
     *
     * @param int $pageDePagination  La position de départ des résultats à récupérer.
     * @param int $OffresParPage Le nombre d'articles par page.
     * @param string $selectionTri Le nom de la colonne utilisée pour le tri.
     * @param string $triDirection La direction du tri (ASC pour croissant, DESC pour décroissant).
     * @return array Les offres d'emploi filtrées.
     */
    public function getSelectionEmploi($pageDePagination, $OffresParPage, $selectionTri, $triDirection) : array {
        $sql = 'SELECT offres_emploi.*, 
                         villes.nom AS ville_nom, 
                         metiers.nom AS metier_nom, 
                         contrats.nom AS contrat_nom
                  FROM offres_emploi 
                  JOIN villes ON offres_emploi.ville_id = villes.id
                  JOIN metiers ON offres_emploi.metier_id = metiers.id
                  JOIN contrats ON offres_emploi.contrat_id = contrats.id';

                  // Ajoute clause ORDER BY si un tri est spécifiée
                  if (!empty($selectionTri)) {
                    $sql .= ' ORDER BY ' . $selectionTri . ' ' . $triDirection;
                  }

                 // Ajoute clause LIMIT pour la pagination
                 $sql .= ' LIMIT :pageDePagination, :OffresParPage';

    
        // Prepare the SQL query
        $OffreEmplois = $this->database->prepare($sql);
    
        // Bind parameters
        $OffreEmplois->bindParam(':pageDePagination', $pageDePagination, \PDO::PARAM_INT);
        $OffreEmplois->bindParam(':OffresParPage', $OffresParPage, \PDO::PARAM_INT);
    
        // Execute the SQL query
        $OffreEmplois->execute();
    
        // Fetch filtered and paginated job listings
        $selectionEmploi = $OffreEmplois->fetchAll(\PDO::FETCH_OBJ);
    
        // Return the filtered job listings based on search criteria and pagination.
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


    public function getTotalOffresSelection($selectedMetier ,$selectedContrat,$selectedVille)
    {
        $sql = 'SELECT COUNT(*) as total FROM offres_emploi
        JOIN metiers ON metiers.id = offres_emploi.metier_id
        JOIN contrats ON contrats.id = offres_emploi.contrat_id
        JOIN villes ON villes.id = offres_emploi.ville_id';

        // Tableau pour stocker les conditions de filtre
        $whereClause = [];

        // Condition de filtre pour les types de contrat sélectionnés
        if (!empty($selectedMetier)) {
            $whereClause[] = 'metiers.nom IN (' . implode(',', array_fill(0, count($selectedMetier), '?')) . ')';
        }

        if (!empty($selectedContrat)) {
            $whereClause[] = 'contrats.nom IN (' . implode(',', array_fill(0, count($selectedContrat), '?')) . ')';
        }

        if (!empty($selectedVille)) {
            $whereClause[] = 'villes.nom IN (' . implode(',', array_fill(0, count($selectedVille), '?')) . ')';
        }

        // Si des conditions de filtre existent, les ajouter à la requête SQL
        if (!empty($whereClause)) {
            $sql .= ' WHERE ' . implode(' AND ', $whereClause);
        }
        
        $stmt = $this->database->prepare($sql);
        
        // Préparation des valeurs à lier aux placeholders dans la requête SQL
        $paramCounter = 1;

        // Si des filtres ont été appliqués pour les métiers sélectionnés
        if (!empty($selectedMetier)) {
            // Boucle à travers chaque métier sélectionné
            foreach ($selectedMetier as $metier) {
                // Lie la valeur du métier actuel au paramètre correspondant dans la requête SQL
                $stmt->bindValue($paramCounter++, $metier);
            }
        }

        if (!empty($selectedContrat)) {
            foreach ($selectedContrat as $contrat) {
                $stmt->bindValue($paramCounter++, $contrat);
            }
        }

        if (!empty($selectedVille)) {
            foreach ($selectedVille as $ville) {
                $stmt->bindValue($paramCounter++, $ville);
            }
        }
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result->total;
        }
  
}

?>

