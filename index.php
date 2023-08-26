<?php

use App\Controller\PaginationController;
use App\Lib\Utility;
use App\Models\Api;
use App\Models\FiltreModel;
use App\Models\JobModel;

require_once 'vendor/autoload.php';
require_once 'app/lib/debug.php';


////////////////////////////////////////////////////////
// valeurs de filtre sélectionnées depuis les paramètres de la requête
$filtre = new FiltreModel();
$metiers = $filtre->getFiltreMetiers();
$villes = $filtre->getFiltreVilles();
$contrats = $filtre->getFiltreContrats();


// ////////////////////////////////////////////////////////////////////////////
// // instance du modèle JobModel pour gérer les offres d'emploi
$offresEmplois = new JobModel();

$offres = $offresEmplois->getSelectionEmploi();

$totalOffres = $offresEmplois->getTotalOffres();

// Define the current page and items per page
$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$OffresParPage = 10; // Number of items per page
// Calculate the total number of pages
$totalPages = ceil($totalOffres / $OffresParPage);

///////////////////////////////////////////////////////////////
// Formatter la date
$Utility = new Utility();

// récupérée l'url de l'image depuis l'API 
$Api = new Api();
$ApiUrl = $Api->getImageUrlFromAPI();




include_once 'template/index.php';
