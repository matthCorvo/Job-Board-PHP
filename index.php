<?php

use App\Models\ImgApi;
use App\Controller\JobController;
use App\Lib\Utility;
use App\Models\FiltreModel;


require_once 'vendor/autoload.php';
require_once 'app/lib/debug.php';


/**
 * Filtre CheckBox
 * 
 * Récupération des filtres tels que les métiers, les villes et les contrats
 * disponibles depuis la base de données.
 */
$filtre = new FiltreModel();

$metiers = $filtre->getFiltreMetiers();
$villes = $filtre->getFiltreVilles();
$contrats = $filtre->getFiltreContrats();





/**
 * 
 * Affichage des offres d'emploi avec gestion de la pagination.
 */
$JobController = new JobController();

// Récupération des offres d'emploi avec gestion de la pagination
$JobBoard = $JobController->getOffresAvecPagination();
// Récupération des données nécessaires
$offres = $JobBoard['offres'];              // Les offres d'emploi de la page actuelle
 $totalPages = $JobBoard['totalPages'];      // Le nombre total de pages de pagination
 $pageActuelle = $JobBoard['pageActuelle'];  // La page actuelle
$OffresParPage = $JobBoard['OffresParPage'];// Le nombre d'offres affichées par page
$totalOffresSelection = $JobBoard['totalOffresSelection'];// Le nombre d'offres affichées par page



/**
 * Détails des offres
 * 
 * Formatage de la date en français
 * Récupération des logos d'entreprise depuis une API externe.
 */
$Utility = new Utility(); // Initialisation de l'utilitaire de formatage de date en français
$Api = new ImgApi(); // Initialisation de la récupération des logos d'entreprise depuis une API externe


include_once 'template/index.php';
