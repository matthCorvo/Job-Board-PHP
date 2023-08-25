<?php

use App\Lib\Utility;
use App\Models\Api;
use App\Models\JobModel;
use App\Models\Pagination;

require_once 'vendor/autoload.php';
require_once 'app/lib/debug.php';

$offresEmplois = new JobModel();
// Get selected filter values from the query parameters
$selectionVilles = isset($_GET['ville']) ? $_GET['ville'] : [];
$selectionMetiers = isset($_GET['metier']) ? $_GET['metier'] : [];
$selectionContrats = isset($_GET['contrat']) ? $_GET['contrat'] : [];

// Define the number of items per page
$OffresParPage = 10;

// Get the current page from the query parameters
$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Call the getSelectionEmploi method with the current page and items per page
$offres = $offresEmplois->getSelectionEmploi($selectionVilles, $selectionMetiers, $selectionContrats, $pageActuelle, $OffresParPage);

// Calculate the total number of pages based on the total number of filtered job listings
$totalSelectionEmploi = count($offres);

// Create an instance of the Pagination class
$pagination = new Pagination($totalSelectionEmploi, $OffresParPage);

// Calculate the total pages by calling the calculTotalPages method
$totalPages = $pagination->calculTotalPages();


// format date 
$Utility = new Utility();

// récupérée l'url de l'image depuis l'API 
$Api = new Api();
$ApiUrl = $Api->getImageUrlFromAPI();




include_once 'template/index.php';
