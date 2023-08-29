<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: PUT");

require_once '../config/Database.php';
require_once '../models/JobApi.php';

if ($_SERVER['REQUEST_METHOD'] === "PUT") { // si la méthode de la demande est PUT.

    $database = new Database();
    $db = $database->getConnexion();

    $job = new JobApi();

    // Récupère les données JSON de la demande et les décode en un objet PHP.
    $data = json_decode(file_get_contents("php://input"));

    // Vérifie si toutes les données requises sont présentes dans la demande.
    if ( !empty($data->id) && !empty($data->reference) && !empty($data->nom) 
         && !empty($data->description) && !empty($data->entreprise) 
         && !empty($data->ville_id) && !empty($data->contrat_id) 
         && !empty($data->metier_id) ) {



        // On hydrate l'objet job avec les données de la demande
        $job->id               = intval($data->id);
        $job->reference        = htmlspecialchars($data->reference);
        $job->nom              = htmlspecialchars($data->nom);
        $job->description      = htmlspecialchars($data->description);
        $job->entreprise       = htmlspecialchars($data->entreprise);
        $job->ville_id         = htmlspecialchars($data->ville_id);
        $job->contrat_id       = htmlspecialchars($data->contrat_id);
        $job->metier_id        = htmlspecialchars($data->metier_id);


        $result = $job->modifier();

        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => "Votre offre d'emploi a été modifié "]);
        } else {
            http_response_code(503);
            echo json_encode(['message' => "La modification de l'offre d'emploi a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont pas complet"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}