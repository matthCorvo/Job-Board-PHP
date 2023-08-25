<?php

use App\Lib\Utility;
use App\Models\Api;
use App\Models\JobModel; 

require_once 'vendor/autoload.php';
require_once 'app/lib/debug.php';

$offresEmplois = new JobModel();
// Get selected filter values from the query parameters
$selectedCities = isset($_GET['ville']) ? $_GET['ville'] : [];
$selectedMetiers = isset($_GET['metier']) ? $_GET['metier'] : [];
$selectedContrats = isset($_GET['contrat']) ? $_GET['contrat'] : [];

    // Use the getFilteredJobs method to retrieve filtered job listings
    $offres = $offresEmplois->getFilteredJobs($selectedCities, $selectedMetiers, $selectedContrats);



// format date 
$Utility = new Utility();

// récupérée l'url de l'image depuis l'API 
$Api = new Api();
$ApiUrl = $Api->getImageUrlFromAPI();




include_once 'template/index.php';
