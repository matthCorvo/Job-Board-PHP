<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: DELETE");

require_once '../config/Database.php';
require_once '../models/JobApi.php';

if ($_SERVER['REQUEST_METHOD'] === "DELETE") { // si la méthode de la demande est DELETE.
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    $job = new JobApi();

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id)) { // Vérifie si l'ID de l'offre d'emploi est présent dans les données de la demande.
        $job->id = $data->id; // Assigne l'ID de l'offre d'emploi .

        if ($job->supprimer()) {
            http_response_code(200);
            echo json_encode(array("message" => "La suppression a été éffectué"));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "La suppression n'a pas été éffectué"));
        }
    } else {
        echo json_encode(['message' => "Vous devez precisé l'identifiant de l'offre d'emploi"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}