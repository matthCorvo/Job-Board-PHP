<?php

namespace App\Controller;

use App\Models\FiltreModel;
use App\Models\JobModel;

class JobController {
    protected $offresEmplois;
    protected $filtre;

    public function __construct() {
        $this->offresEmplois = new JobModel();
        $this->filtre = new FiltreModel();
    }


    /**
     * Récupère les offres d'emploi avec pagination et tri.
     *
     * Cette fonction récupère les offres d'emploi avec pagination en fonction de la page actuelle,
     * du nombre d'éléments par page, du tri et de la direction de tri.
     *
     * @return array  tableau contenant les offres d'emploi, le nombre total de pages, la page actuelle et le nombre d'éléments par page.
     */ 
    public function getOffresAvecPagination(): array {

        // TRI --------------------------------------------------------------------
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
            // mise à jour de l'option de tri à utiliser.
            $selectionTri = $selectionTris[$_GET['tri']];
    
            // si le paramètre 'order' est défini dans la requête GET et s'il est défini sur tri ascendant.
            if (isset($_GET['order']) && $_GET['order'] === 'asc') {
                // mise à jour de la direction de tri pour qu'elle soit (ascendante).
                $triDirection = 'ASC';
            }
        }
    
        // FILTRE ---------------------------------------------------------

          // Check if a 'metier' filter is present in the URL
          $selectedMetier = isset($_GET['metier']) ? $_GET['metier'] : [];
          // Check if a 'contrat' filter is present in the URL
          $selectedContrat = isset($_GET['contrat']) ? $_GET['contrat'] : [];
          // Check if a 'contrat' filter is present in the URL
          $selectedVille = isset($_GET['ville']) ? $_GET['ville'] : [];
  
        // PAGINATION ---------------------------------------------------------

        // Calcul du nombre total d'offres d'emploi sélectionnées
        $totalOffresSelection = $this->offresEmplois->getTotalOffresSelection($selectedMetier ,$selectedContrat,$selectedVille); // Get the total count of job offers
        
        // Récupération du nombre total d'offres d'emploi
        $totalOffresCount = $this->offresEmplois->getTotalOffres(); 
        
        // Nombre d'offres par page par défaut
        $OffresParPage = 10;

        // Si des filtres sont appliqués, ajuste le nombre d'offres par page en conséquence
        if (!empty($selectedMetier) || !empty($selectedContrat) || !empty($selectedVille)) {
            $OffresParPage = ($totalOffresCount - $totalOffresSelection );
        } 

        // Détermine la page actuelle
        // Si 'page' est défini et n'est pas vide, alors il contient le numéro de la page souhaitée.
        if (isset($_GET["page"])) { $pageActuelle = $_GET["page"]; 
        } else { $pageActuelle = 1; }
        
        // Calcule l'index de la première offre à afficher pour la page actuelle
        $pageDePagination = ($pageActuelle - 1) * $OffresParPage;

        // Récupère les données des offres d'emploi pour la page actuelle
        $offres = $this->offresEmplois->getSelectionEmploi(
            $pageDePagination,
            $OffresParPage,
            $selectionTri,
            $triDirection,
            $totalOffresSelection );

        // Calcule le nombre total de pages nécessaires pour afficher toutes les offres
        $totalPages = ceil($totalOffresCount / $OffresParPage);

        
        // Retourne les résultats sous forme de tableau
        return [
            'offres' => $offres,
            'totalPages' => $totalPages,
            'pageActuelle' => $pageActuelle,
            'OffresParPage' => $OffresParPage,
            'totalOffresSelection' => $totalOffresSelection
            ,
        ];
    }
}