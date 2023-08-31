<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../config/Database.php';
require_once '../models/JobApi.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") { // si la méthode de la demande est POST.
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    $job = new JobApi();

    // Récupère les données JSON de la demande et les décode en un objet PHP.
    $data = json_decode(file_get_contents("php://input"));
    
    // Vérifie si les données JSON sont valides et si $data est un tableau (array).
    if ($data !== null && is_array($data) ) {
        foreach ($data as $jobData) {
            // On hydrate l'objet job avec les données de la demande
            $job->reference        = htmlspecialchars($jobData->reference);
            $job->nom              = htmlspecialchars($jobData->nom);
            $job->description      = htmlspecialchars($jobData->description);
            $job->entreprise       = htmlspecialchars($jobData->entreprise);
            $job->ville_id         = htmlspecialchars($jobData->ville_id);
            $job->contrat_id       = htmlspecialchars($jobData->contrat_id);
            $job->metier_id        = htmlspecialchars($jobData->metier_id);
            $job->date_publication = htmlspecialchars($jobData->date_publication);

            $result = $job->ajouter();
        }
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => "Vos offres d'emploi ont été ajoutées"]);
        } else {
            http_response_code(503);
            echo json_encode(['message' => "L'ajout de l'offre d'emploi a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont pas complètes"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
