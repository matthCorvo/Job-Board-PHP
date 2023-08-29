<?php

namespace App\Models;

class Api {

    /**
     * Obtient une URL d'image depuis une API externe.
     *
     * Cette fonction envoie une requête à une API externe pour récupérer une URL d'image.
     * Ensuite, elle analyse la réponse JSON pour extraire l'URL de l'image.
     *
     * @return string L'URL de l'image récupérée.
     */
    public function getImageUrlFromAPI() : string {
      
        // Envoie une requête à l'API
        $apiUrl = file_get_contents('https://some-random-api.com/img/bird');
      
        // Analyse la réponse JSON
        $data = json_decode($apiUrl);
        
        // Récupére l'URL de l'image
        return $data->link;
    }
}