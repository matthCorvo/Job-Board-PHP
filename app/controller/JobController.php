<?php

namespace App\Controller;

use App\Models\JobModel;

class JobController {
    protected $offresEmplois;
    
    public function __construct() {
        $this->offresEmplois = new JobModel();
    }

    /**
     * Récupère les offres d'emploi avec pagination.
     *
     * Cette méthode récupère les offres d'emploi avec pagination en fonction de la page actuelle et du nombre d'éléments par page.
     *
     * @return array Un tableau contenant les offres d'emploi, le nombre total de pages, la page actuelle et le nombre d'éléments par page.
     */
    public function getOffresAvecPagination() : array {
        $OffresParPage = 10; // Nombre d'éléments par page
        
        // Définit la page actuelle
        $pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Calcule le nombre total de pages
        $totalOffres = $this->offresEmplois->getTotalOffres();

        // Calcule la page de la pagination en fonction de la page actuelle et du nombre d'éléments par page
        $pageDePagination  = ($pageActuelle - 1) * $OffresParPage;

        // Récupère les données pour la page actuelle
        $offres = $this->offresEmplois->getSelectionEmploi($pageDePagination , $OffresParPage);

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