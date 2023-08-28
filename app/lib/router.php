<?php

/**
 * Fonction de routage pour gérer les différentes URL.
 *
 * @param string $url L'URL à router.
 */
function router($url) {
    // ...

    // Gestion de la pagination
    if (preg_match('/^\/page(\d+)$/', $url, $matches)) {
        // Obtenez le numéro de page à partir de l'URL
        $pageNumber = intval($matches[1]);

        // Incluez le fichier correspondant à la page de pagination
        include_once './template/job/pagination.php';

        // Vous pouvez passer $pageNumber à pagination.php pour charger les données de la page spécifique
        // pagination.php pourrait également inclure le modèle de pagination pour obtenir les données
    }
}
// ...
?>
