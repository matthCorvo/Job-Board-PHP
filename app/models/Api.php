<?php

namespace App\Models;

class Api{

    function getImageUrlFromAPI() {
        // Effectuer une requête à l'API
        $apiUrl = file_get_contents('https://some-random-api.com/img/bird');
      
        // Analyser la réponse JSON
        $data = json_decode($apiUrl);
        
        // Récupérer l'URL de l'image
        return $data->link;
      }
      
}