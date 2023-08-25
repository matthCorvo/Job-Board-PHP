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
     * Initialise une instance de la classe Database.
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
    public function getSelectionEmploi($selectionVilles = [], $selectionMetiers = [], $selectionContrats = [], $pageActuelle = 1, $OffresParPage = 10) {
    
        // Construire la requête SQL
        $sql = 'SELECT offres_emploi.*, 
                         villes.nom AS ville_nom, 
                         metiers.nom AS metier_nom, 
                         contrats.nom AS contrat_nom
                  FROM offres_emploi 
                  INNER JOIN villes ON offres_emploi.ville_id = villes.id
                  INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
                  INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id';

        // Création de la commande WHERE en fonction des filtres sélectionnés
        $sqlWhere = [];
        $params = [];

        // Si des villes ont été sélectionnées dans le filtre
        if (!empty($selectionVilles)) {
            // Créer des espaces réservés pour les valeurs des villes sélectionnées
            $placeholders = implode(', ', array_fill(0, count($selectionVilles), '?'));

            // Ajouter une condition WHERE pour filtrer par nom de ville
            $sqlWhere[] = 'villes.nom IN (' . $placeholders . ')';
            
            // Fusionner les valeurs des villes sélectionnées avec le tableau des paramètres
            $params = array_merge($params, $selectionVilles);
        }

        if (!empty($selectionMetiers)) { // Si des metiers ont été sélectionnées dans le filtre
            $placeholders = implode(', ', array_fill(0, count($selectionMetiers), '?')); // Créer des espaces réservés pour les valeurs des metiers sélectionnées
            $sqlWhere[] = 'metiers.nom IN (' . $placeholders . ')'; // Ajouter une condition WHERE pour filtrer par nom de metiers
            $params = array_merge($params, $selectionMetiers); // Fusionner les valeurs des metiers sélectionnées avec le tableau des paramètres
        }

        if (!empty($selectionContrats)) { // Si des contrats ont été sélectionnées dans le filtre
            $placeholders = implode(', ', array_fill(0, count($selectionContrats), '?')); // Créer des espaces réservés pour les valeurs des contrats sélectionnées
            $sqlWhere[] = 'contrats.nom IN (' . $placeholders . ')'; // Ajouter une condition WHERE pour filtrer par nom de contrats
            $params = array_merge($params, $selectionContrats); // Fusionner les valeurs des contrats sélectionnées avec le tableau des paramètres
        }

        // Si des conditions WHERE existent, les ajouter à la requête SQL en les reliant avec des opérateurs AND
        if (!empty($sqlWhere)) {
            $sql .= ' WHERE ' . implode(' AND ', $sqlWhere);
        }

        // Construire une requête SQL pour compter le nombre total d'offres d'emploi filtrées en utilisant une sous-requête
        $sqlCount = $this->database->prepare('SELECT COUNT(*) AS total FROM (' . $sql . ') AS selection_emploi');
        // Exécuter la requête en utilisant les paramètres de filtrage
        $sqlCount->execute($params);
        $totalSelectionEmploi = (int) $sqlCount->fetchColumn(); // Convertir le résultat en entier

        // Créer une instance de la classe Pagination pour gérer la pagination des résultats.
        $pagination = new Pagination($totalSelectionEmploi, $OffresParPage, $pageActuelle);

        // Calculer le nombre total de pages et le décalage
        $offset = $pagination->calculateOffset();
       
        // Ajouter LIMIT et OFFSET à la requête pour la pagination
        $sql .= " LIMIT $OffresParPage OFFSET $offset";

        // Préparer et exécuter la requête
        $sqlCount = $this->database->prepare($sql);
        $sqlCount->execute($params);

        // Récupérer les offres d'emploi filtrées
        $selectionEmploi = $sqlCount->fetchAll(\PDO::FETCH_OBJ);
        
        // Renvoie les offres d'emploi filtrées en fonction des critères de recherche.
        return $selectionEmploi;
    }
}

?>
