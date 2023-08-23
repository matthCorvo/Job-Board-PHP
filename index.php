<?php

use App\Lib\Utility;
use App\Models\Api;
use App\Models\JobModel; 

require_once 'vendor/autoload.php';
require_once 'app/lib/debug.php';

// Appelez la méthode getAllJobs() pour récupérer les emplois
$offresEmplois = new JobModel();
$jobs = $offresEmplois->getAllJobs();

// format date 
$Utility = new Utility();

// récupérée l'url de l'image depuis l'API 
$Api = new Api();
$ApiUrl = $Api->getImageUrlFromAPI();
d($ApiUrl);


include_once 'template/index.php';
