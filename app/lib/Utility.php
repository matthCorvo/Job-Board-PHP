<?php

namespace App\Lib;

/**
 * Classe Utility
 *
 */
class Utility {

    /**
     * Formatage d'une date en format "jour semaine, jour mois année".
     *
     * @param string $date La date à formater au format YYYY-MM-DD.
     * @return string La date formatée en français.
     */
    function formatDate($date) {
        
        $timestamp = strtotime($date);

        // Créer un formateur de date en français
        $formatFr = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
        $Date = $formatFr->format($timestamp);

        return $Date;
    }
}

?>
