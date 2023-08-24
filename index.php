<?php

use App\Lib\Utility;
use App\Models\Api;
use App\Models\JobModel; 

require_once 'vendor/autoload.php';
require_once 'app/lib/debug.php';

// LISTE //
// Appelez la méthode getAllJobs() pour récupérer les emplois
$offresEmplois = new JobModel();
$offres = $offresEmplois->getAllJobs();
$villes = $offresEmplois->getFilteringCheckbox();
d($villes);

// format date 
$Utility = new Utility();

// récupérée l'url de l'image depuis l'API 
$Api = new Api();
$ApiUrl = $Api->getImageUrlFromAPI();


// // FILTRE //
// $filtre = $offresEmplois->getFilteringCheckbox();
// $villes = $filtre['villes'];

// d($all_city);

include_once 'template/index.php';
