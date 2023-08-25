<?php


    /**
     * Récupère toutes les offres d'emploi disponibles dans la base de données.
     *
     * @return  
     */
    // public function getAllJobs() {

        // Requête SQL à exécuter pour récupérer toutes les offres d'emploi
        // $SQL = $this->database->prepare(
        //     'SELECT offres_emploi.*,
        //         villes.nom AS ville_nom,
        //         metiers.nom AS metier_nom,
        //         contrats.nom AS contrat_nom
        //      FROM offres_emploi 
        //      INNER JOIN villes ON offres_emploi.ville_id = villes.id
        //      INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
        //      INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id');

        // Exécution de la requête SQL
        // $SQL->execute();

        // Récupération des données 
        // $offresEmploi = $SQL->fetchAll(\PDO::FETCH_OBJ);

        // DEBUG
        //d($offresEmploi);
            
        // Renvoie les données récupérées
        // return $offresEmploi;
    // }

    /**
     * Récupère toutes les données pour le filtre.
     *
     * @return 
     */
    // public function getFilteringCheckbox() {

    // Perform a database query to retrieve city names
    // $sqlVille = $this->database->prepare('SELECT * FROM villes');
    // $sqlVille->execute();

    // Fetch all city names and add them to the $villes array
    // $villes = $sqlVille->fetchAll(\PDO::FETCH_OBJ);

    // You can now use the $villes array to display city names in your view.
    // return $villes;
    
     
         

        //  $SQL_metiers = $this->database->prepare("SELECT distinct `metiers` FROM `offres_emploi` GROUP BY `metiers`");
        //  $SQL_metiers->execute();
        //  $metiers = $SQL_metiers->fetchAll(\PDO::FETCH_OBJ);

        //  $SQL_contrats = $this->database->prepare("SELECT distinct `contrats` FROM `offres_emploi` GROUP BY `contrats`");
        //  $SQL_contrats->execute();
        //  $contrats = $SQL_contrats->fetchAll(\PDO::FETCH_OBJ);

            // 'villes'     => $villes,
            // 'metiers' =>  $metiers,
            // 'contrats' =>  $contrats
       
         // Renvoie les données récupérées
    // }

 

// tri
// if(isset($_GET['sort_price']) && $_GET['sort_price']!="") :
//     if($_GET['sort_price']=='price-asc-rank') :
//         $sql.=" ORDER BY price ASC";
//     elseif($_GET['sort_price']=='price-desc-rank') :
//         $sql.=" ORDER BY price DESC";
//     endif;
// endif;
// public function getFilteredJobsByCities($selectedCities) {
    
    // $filteredJobs = [];

    // Check if any cities are selected
    // if (!empty($selectedCities)) {
    //     // Prepare a query to select job listings for selected cities
    //     $placeholders = implode(', ', array_map(function ($index) {
    //         return ':ville_id_' . $index;
    //     }, array_keys($selectedCities)));
    // d($placeholders);

        // $query = $this->database->prepare("SELECT offres_emploi.*, villes.nom AS ville_nom, metiers.nom AS metier_nom, contrats.nom AS contrat_nom
        //     FROM offres_emploi 
        //     INNER JOIN villes ON offres_emploi.ville_id = villes.id
        //     INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
        //     INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id
        //     WHERE ville_id IN ($placeholders)");
        
        // // Bind parameters for each selected city
        // foreach ($selectedCities as $index => $cityId) {
        //     $query->bindParam(':ville_id_' . $index, $cityId);
        // }

        // $query->execute();

        // Fetch the filtered job listings
//         $filteredJobs = $query->fetchAll(\PDO::FETCH_OBJ);
//     }

//     return $filteredJobs;

// }
// public function pagination($selectedCities, $currentPage) {
    
//    // Step 1: Define the number of records per page
// $recordsPerPage = 10;

// // Step 2: Get the total number of records from the database
// $totalRecords = $this->getFilteringCheckbox(); // You'll need to implement this function

// // Step 3: Calculate the number of pages
// $totalPages = ceil($totalRecords / $recordsPerPage);

// // Step 4: Determine the current page (e.g., from query parameters)
// if (isset($_GET['page'])) {
//     $currentPage = max(1, min($_GET['page'], $totalPages));
// } else {
//     $currentPage = 1;
// }

// // Step 5: Retrieve records for the current page
// $offset = ($currentPage - 1) * $recordsPerPage;
// $records = $this->getFilteringCheckbox($offset, $recordsPerPage); // You'll need to implement this function



// return [
//     'totalPages' => $totalPages,
//     'records' => $records,
// ];}

// }

// ---- index 

// LISTE //
// Appelez la méthode getAllJobs() pour récupérer les emplois
// $offresEmplois = new JobModel();
// $offres = $offresEmplois->getAllJobs();
// $villes = $offresEmplois->getFilteringCheckbox();


// if (isset($_GET['ville'])) {
//     $selectedCities = $_GET['ville'];
//     $filteredJobs = $offresEmplois->getFilteredJobsByCities($selectedCities);
// } else {
//     // If no cities are selected, return all job listings
//     $filteredJobs = $offresEmplois->getAllJobs();
// }

// $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// $paginationData = $offresEmplois->pagination($selectedCities, $currentPage);

// format date 
// $Utility = new Utility();

// récupérée l'url de l'image depuis l'API 
// $Api = new Api();
// $ApiUrl = $Api->getImageUrlFromAPI();


// // FILTRE //
// $filtre = $offresEmplois->getFilteringCheckbox();
// $villes = $filtre['villes'];

// d($all_city);

