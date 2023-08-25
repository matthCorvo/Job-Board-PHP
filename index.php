<?php

use App\Lib\Utility;
use App\Models\Api;
use App\Models\JobModel;
use App\Models\Pagination;

require_once 'vendor/autoload.php';
require_once 'app/lib/debug.php';

$offresEmplois = new JobModel();
// Get selected filter values from the query parameters
$selectedCities = isset($_GET['ville']) ? $_GET['ville'] : [];
$selectedMetiers = isset($_GET['metier']) ? $_GET['metier'] : [];
$selectedContrats = isset($_GET['contrat']) ? $_GET['contrat'] : [];

// Define the number of items per page
$itemsPerPage = 10;

// Get the current page from the query parameters
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Call the getFilteredJobs method with the current page and items per page
$offres = $offresEmplois->getFilteredJobs($selectedCities, $selectedMetiers, $selectedContrats, $currentPage, $itemsPerPage);

// Calculate the total number of pages based on the total number of filtered job listings
$totalJobListings = count($offres);

// Create an instance of the Pagination class
$pagination = new Pagination($totalJobListings, $itemsPerPage);

// Calculate the total pages by calling the calculateTotalPages method
$totalPages = $pagination->calculateTotalPages();


// format date 
$Utility = new Utility();

// récupérée l'url de l'image depuis l'API 
$Api = new Api();
$ApiUrl = $Api->getImageUrlFromAPI();




include_once 'template/index.php';
