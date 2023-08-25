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

        // Renvoie les données récupérées
        return $offresEmploi;
    }

    public function getFilteredJobs($selectedCities = [], $selectedMetiers = [], $selectedContrats = [], $currentPage = 1, $itemsPerPage = 10) {
        $filteredJobs = [];
    
        
        // Build the SQL query
        $query = 'SELECT offres_emploi.*, villes.nom AS ville_nom, metiers.nom AS metier_nom, contrats.nom AS contrat_nom
                FROM offres_emploi 
                INNER JOIN villes ON offres_emploi.ville_id = villes.id
                INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
                INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id';

        // Build the WHERE clause based on selected filters
        $whereClause = [];
        $params = [];



        if (!empty($selectedCities)) {
            $placeholders = implode(', ', array_fill(0, count($selectedCities), '?'));
            $whereClause[] = 'villes.nom IN (' . $placeholders . ')';
            $params = array_merge($params, $selectedCities);
        }
  

        if (!empty($selectedMetiers)) {
            $placeholders = implode(', ', array_fill(0, count($selectedMetiers), '?'));
            $whereClause[] = 'metiers.nom IN (' . $placeholders . ')';
            $params = array_merge($params, $selectedMetiers);
        }
    
        if (!empty($selectedContrats)) {
            $placeholders = implode(', ', array_fill(0, count($selectedContrats), '?'));
            $whereClause[] = 'contrats.nom IN (' . $placeholders . ')';
            $params = array_merge($params, $selectedContrats);
        }
        // If there are filters, add the WHERE clause to the query
        if (!empty($whereClause)) {
            $query .= ' WHERE ' . implode(' AND ', $whereClause);
        }

      // Create a Pagination instance with the actual total count of filtered jobs
      $countQuery = 'SELECT COUNT(*) AS total FROM (' . $query . ') AS filtered_jobs';
      $stmt = $this->database->prepare($countQuery);
      $stmt->execute($params);
      $totalJobListings = (int) $stmt->fetchColumn(); // Convert the result to an integer
  
      $pagination = new Pagination($totalJobListings, $itemsPerPage, $currentPage);
  
      // Calculate total pages and offset
      $offset = $pagination->calculateOffset();
  
      // Add LIMIT and OFFSET to the query for pagination
      $query .= " LIMIT $itemsPerPage OFFSET $offset";
    // Prepare and execute the query
    $stmt = $this->database->prepare($query);
    $stmt->execute($params);

    // Fetch the filtered job listings
    $filteredJobs = $stmt->fetchAll(\PDO::FETCH_OBJ);

    return $filteredJobs;

    }

   


}