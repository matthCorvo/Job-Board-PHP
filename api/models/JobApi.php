<?php

class JobApi {

private $table = "offres_emploi";
private ?\PDO $database = null;
public $id;
public $date_publication;
public $date_mise_a_jour;
public $reference;
public $nom; 
public $description; 
public $entreprise; 
public $ville_id; 
public $contrat_id; 
public $metier_id;

public function __construct()
{
    $this->database = Database::getConnexion();
}
// Lecture des étudiants

public function readAll()
{
    // On ecrit la requete
    $sql = "SELECT * FROM $this->table";

    // On éxecute la requête
    $req = $this->database->query($sql);

    // On retourne le resultat
    return $req;
}


// Méthode pour ajouter une nouvelle offre d'emploi dans la base de données.
public function ajouter()
{
    // Génère une référence unique pour l'offre d'emploi.
    $this->reference = 'REF_' . strtoupper(substr(uniqid(), -5));

    // Construction de la requête SQL pour l'ajout d'une offre d'emploi.
    $sql = "INSERT INTO $this->table(reference, nom, description,
    entreprise, ville_id, contrat_id, metier_id, date_publication) 
    VALUES(:reference, :nom, :description, :entreprise, :ville_id, 
    :contrat_id, :metier_id, :date_publication)";

    // Préparation de la requête SQL.
    $resultSql = $this->database->prepare($sql);

    // Exécution de la requête SQL avec les valeurs spécifiées.
    $result = $resultSql->execute([
        ":reference"        => $this->reference,
        ":nom"              => $this->nom,
        ":description"      => $this->description,
        ":entreprise"       => $this->entreprise,
        ":ville_id"         => $this->ville_id,
        ":contrat_id"       => $this->contrat_id,
        ":metier_id"        => $this->metier_id,
        ":date_publication" => $this->date_publication
    ]);
    
    // Si l'ajout a réussi, retourne true, sinon false.
    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Méthode pour modifier une offre d'emploi existante dans la base de données.
public function modifier()
{
    // Construction de la requête SQL pour la modification d'une offre d'emploi.
    $sql = "UPDATE $this->table SET 
    nom=:nom, 
    description=:description, 
    entreprise=:entreprise, 
    ville_id=:ville_id, 
    contrat_id=:contrat_id, 
    metier_id=:metier_id, 
    date_mise_a_jour=NOW() WHERE id=:id";

    // Préparation de la réqête SQL
    $resultSql = $this->database->prepare($sql);

    // éxecution de la reqête
    $result = $resultSql->execute([
        ":nom"              => $this->nom,
        ":description"      => $this->description,
        ":entreprise"      => $this->entreprise,
        ":ville_id"         => $this->ville_id,
        ":contrat_id"       => $this->contrat_id,
        ":metier_id"        => $this->metier_id,
        ":id"               => $this->id

    ]);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Méthode pour supprimer une offre d'emploi de la base de données.
public function supprimer()
{
    // Construction de la requête SQL pour la suppression d'une offre d'emploi.
    $sql = "DELETE FROM $this->table WHERE id = :id";
    $resultSql = $this->database->prepare($sql);

    $result = $resultSql->execute(array(":id" => $this->id));

    if ($result) {
        return true;
    } else {
        return false;
    }
}
}