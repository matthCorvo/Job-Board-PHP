<?php

namespace App\Controller;

use App\Models\JobModel;

class JobController {
    protected $offresEmplois;
    
    public function __construct() {
        $this->offresEmplois = new JobModel();
    }

     /**
     * Récupère les offres d'emploi avec pagination et tri.
     *
     * Cette function récupère les offres d'emploi avec pagination en fonction de la page actuelle,
     * du nombre d'éléments par page, du tri et de la direction de tri.
     *
     * @return array  tableau contenant les offres d'emploi, le nombre total de pages, la page actuelle et le nombre d'éléments par page.
     *             
     */
    public function getOffresAvecPagination() : array {
        $OffresParPage = 10; // Nombre d'éléments par page
        
        // Définit la page actuelle
        $pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;

       
        $selectionTri = 'date_publication'; // Colonne de tri par défaut
        $triDirection = 'DESC'; // Direction de tri par défaut

        // Définir les colonnes de tri et leurs correspondances avec les champs de la base de données
        $selectionTris = [
            'date_desc' => 'date_publication',
            'date_asc' => 'date_publication',
            'name_asc' => 'nom',
            'name_desc' => 'nom',
        ];

        // si le paramètre 'tri' est défini dans la requête GET et s'il correspond à une option de tri valide.
        if (isset($_GET['tri']) && isset($selectionTris[$_GET['tri']])) {
            // mise à jour de l'option de tri utiliser.
            $selectionTri = $selectionTris[$_GET['tri']];

            // si le paramètre 'order' est défini dans la requête GET et s'il est défini sur tri ascendant.
            if (isset($_GET['order']) && $_GET['order'] === 'asc') {
                // mise à jour de la direction de tri pour qu'elle soit (ascendant).
                $triDirection = 'ASC';
            }
          
        }

        // Calcule le nombre total de pages
        $totalOffres = $this->offresEmplois->getTotalOffres();

        // Calcule la page de la pagination en fonction de la page actuelle et du nombre d'éléments par page
        $pageDePagination  = ($pageActuelle - 1) * $OffresParPage;

        // Récupère les données pour la page actuelle
        $offres = $this->offresEmplois->getSelectionEmploi($pageDePagination, $OffresParPage, $selectionTri, $triDirection);

        // Calcule le nombre total de pages
        $totalPages = ceil($totalOffres / $OffresParPage);

        // Retourne les résultats sous forme de tableau
        return [
            'offres' => $offres,
            'totalPages' => $totalPages,
            'pageActuelle' => $pageActuelle,
            'OffresParPage' => $OffresParPage,
        ];
    }
}