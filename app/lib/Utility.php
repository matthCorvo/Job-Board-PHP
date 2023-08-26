<?php

namespace App\Lib;

/**
 *
 * fonction pour le formatage de la dates.
 */
class Utility {

    /**
     * Formatage d'une date en format "jour mois année".
     *
     * @param string $date La date à formater au format YYYY-MM-DD.
     * @return string La date formatée en français.
     */
    function  formatDate($date) {
        
        $timestamp = strtotime($date);

        // Créer un format de date en français
        $formatFr = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
        $Date = $formatFr->format($timestamp);

        return $Date;
    }
}

?>
