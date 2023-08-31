
# JOB BOARD


Création d'un Job Board, permettant la consultation d'offres d'emploi avec des fonctionnalités de filtrage et de pagination créé avec MySQL et PHP. 

# Table des matières

1. [Installation](#installation)
2. [Base de Données](#Base-de-Données)
4. [Fonctionnalités](#fonctionnalités)
   - [Affichage des Offres d'Emploi](#Affichage-et-tri-des-Offres-d'Emploi)
   - [Pagination](#Pagination)
   - [Filtres](#Filtres)
   - [API](#API)


## Prérequis

- PHP >= 8.1
- MySQL
- Composer 

## Installation

Cloné le projet avec la commande

```
https://github.com/matthCorvo/Job-Board-PHP.git
```
Ensuite, dans l'ordre taper les commandes dans votre terminal :

```
  composer install
  composer update
```
## Base de Données

Le projet utilise une base de données MySQL avec les tables suivantes :

```

TABLE `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)

TABLE `metiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
)

TABLE `contrats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
)

TABLE `offres_emploi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_publication` date NOT NULL,
  `date_mise_a_jour` date DEFAULT NULL,
  `reference` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `entreprise` varchar(100) NOT NULL,
  `ville_id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `metier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference` (`reference`),
  KEY `fk_ville_id` (`ville_id`),
  KEY `fk_contrat_id` (`contrat_id`),
  KEY `fk_metier_id` (`metier_id`)
  )

  ```


## Fonctionnalités

### Affichage des Offres d'Emploi 
L'application affiche les offres d'emploi avec les détails suivants :
- Date.
- Référence unique.
- Intitulé de l'offre.
- Ville.
- Type de contrat.
- Type de métier.
- Nom de l'entreprise qui poste l'annonce.
- Description de l'offre.
- tri des intitulé de l'offre et date pare ordre ascendant / descendant


*app/models/JobModel.php* 
 
```
    public function getSelectionEmploi($pageDePagination, $OffresParPage, $selectionTri, $triDirection) : array {
        $sql = 'SELECT offres_emploi.*, 
                         villes.nom AS ville_nom, 
                         metiers.nom AS metier_nom, 
                         contrats.nom AS contrat_nom
                  FROM offres_emploi 
                  INNER JOIN villes ON offres_emploi.ville_id = villes.id
                  INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
                  INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id';

                  if (!empty($selectionTri)) {
                    $sql .= ' ORDER BY ' . $selectionTri . ' ' . $triDirection; }

                 $sql .= ' LIMIT :pageDePagination, :offresParPage';

        // Préparation de la requête SQL
        $OffreEmplois = $this->database->prepare($sql);

         // Sécurise et lie les paramètres
        $OffreEmplois = $this->database->prepare($sql);
        $OffreEmplois->bindParam(':pageDePagination', $pageDePagination, \PDO::PARAM_INT);
        $OffreEmplois->bindParam(':offresParPage', $OffresParPage, \PDO::PARAM_INT);
        
        // ....
    }
```


### Pagination
La liste des offres d'emploi est paginée, avec 10 offres par page. Le nombre de pages varie en fonction du nombre d'offres en base de données.



*app/controllers/JobController.php* 

```
    // Calcul du nombre total d'offres d'emploi sélectionnées
        $totalOffresSelection = $this->offresEmplois->getTotalJobCountChecked($selectedMetier ,$selectedContrat,$selectedVille); // Get the total count of job offers
        
        // Récupération du nombre total d'offres d'emploi
        $totalOffresCount = $this->offresEmplois->getTotalOffres(); 
        
        // Nombre d'offres par page par défaut
        $OffresParPage = 10;

        // Si des filtres sont appliqués, ajuste le nombre d'offres par page en conséquence
        if (!empty($selectedMetier) || !empty($selectedContrat) || !empty($selectedVille)) {
            $OffresParPage = ($totalOffresCount - $totalOffresSelection );
        } 

        // Détermine la page actuelle
        // Si 'page' est défini et n'est pas vide, alors il contient le numéro de la page souhaitée.
        if (isset($_GET["page"])) { $pageActuelle = $_GET["page"]; 
        } else { $pageActuelle = 1; }
        
        // Calcule l'index de la première offre à afficher pour la page actuelle
        $pageDePagination = ($pageActuelle - 1) * $OffresParPage;

        // Récupère les données des offres d'emploi pour la page actuelle
        $offres = $this->offresEmplois->getSelectionEmploi(
            $pageDePagination,
            $OffresParPage,
            $selectionTri,
            $triDirection,
            $totalOffresSelection );
            
        // Calcule le nombre total de pages nécessaires pour afficher toutes les offres
        $totalPages = ceil($totalOffresCount / $OffresParPage);

```


### Filtres
Les utilisateurs peuvent filtrer les offres d'emploi par les critères suivants :
- Ville.
- Métier.
- Type de contrat.

Les filtres sont cumulables, et leur sélection est conservée lors du changement de page.

Exemple  : 
*app/models/FiltreModel.php* 
```  
 public function getFiltreVilles() {
        // Exécute une requête pour récupérer les villes distinctes
        $sql = $this->database->query(
        'SELECT villes.id AS ville_id, villes.nom AS ville_nom, 
        COUNT(offres_emploi.id) AS total
        FROM villes
        LEFT JOIN offres_emploi ON villes.id = offres_emploi.ville_id
        GROUP BY villes.id, villes.nom
        ORDER BY villes.nom ASC');

        $sql->execute();
        // Récupère les résultats sous forme d'objets
        $villes = $sql->fetchAll(\PDO::FETCH_OBJ);
        
        return $villes;

```
Exemple  : 
*app/models/JobModel.php* 
```  
 $sql = 'SELECT COUNT(*) as total FROM offres_emploi
        JOIN metiers ON metiers.id = offres_emploi.metier_id
        JOIN contrats ON contrats.id = offres_emploi.contrat_id
        JOIN villes ON villes.id = offres_emploi.ville_id';

        // Tableau pour stocker les conditions de filtre
        $whereClause = [];

        // Condition de filtre pour les types de contrat sélectionnés
        if (!empty($selectedMetier)) {
            $whereClause[] = 'metiers.nom IN (' . implode(',', array_fill(0, count($selectedMetier), '?')) . ')';
        }

        // ......

        // Si des conditions de filtre existent, les ajouter à la requête SQL
        if (!empty($whereClause)) {
            $sql .= ' WHERE ' . implode(' AND ', $whereClause);
        }
        
        $stmt = $this->database->prepare($sql);
        
        // Préparation des valeurs à lier aux placeholders dans la requête SQL
        $paramCounter = 1;

        // Si des filtres ont été appliqués pour les métiers sélectionnés
        if (!empty($selectedMetier)) {
            // Boucle à travers chaque métier sélectionné
            foreach ($selectedMetier as $metier) {
                // Lie la valeur du métier actuel au paramètre correspondant dans la requête SQL
                $stmt->bindValue($paramCounter++, $metier);
            }
        }

       // ......
```


### API 
### image<br>
Les logos des entreprises sont obtenus depuis une API externe (https://some-random-api.ml/meme) au format JSON.

*app/models/ImgAPi.php*
```
    public function getImageUrlFromAPI() : string {
      
        // Envoie une requête à l'API
        $apiUrl = file_get_contents('https://some-random-api.com/img/bird');
      
        // Analyse la réponse JSON
        $data = json_decode($apiUrl);
        
        // Récupére l'URL de l'image
        return $data->link;
    }
```
## RESTful APIs
Création d'une API avec 3 routes permettant de modifier, ajouter et supprimer une offres d'emploi.

Pour utiliser cette API, vous pouvez envoyer des requêtes HTTP aux contrôleurs :

- Pour ajouter un nouvel emploi : `(POST) /api/controllers/ajouter.php`
<br>
*test*
```
[
  {
    "nom": "Test",
    "description": "Test",
    "entreprise": "Test",
    "ville_id": 1,
    "contrat_id": 2,
    "metier_id": 1,
    "date_publication": "2023-07-30",
    "reference": "R" <!--La suite de la référence sera générée automatiquement.  -->
  }
]
```
- Pour modifier un emploi existant : `(PUT) /api/controllers/modifier.php`
<br>
*test*
```
[
   {
        "id":5,
        "nom": "Test",
        "description": "Test",
        "entreprise": "Test ",
        "ville_id": 1,
        "contrat_id": 1,
        "metier_id": 5
        <!-- insertion automatique de la Date : mise a jour.  -->
  }
]
```
- Pour supprimer un emploi : `(DELETE) /api/controllers/supprimer.php`
<br>
*test*
```
[
  {
        "id":5,
  }
]
```

<hr>
*api/models/JobApi.php*

```
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

```

*api/controllers/ajouter.php*

```
if ($_SERVER['REQUEST_METHOD'] === "POST") { // si la méthode de la demande est POST.
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    $job = new JobApi();

    // Récupère les données JSON de la demande et les décode en un objet PHP.
    $data = json_decode(file_get_contents("php://input"));
    
    // Vérifie si toutes les données requises sont présentes dans la demande.
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
```

<hr>


*api/models/JobApi.php*

```
// Méthode pour modifier une offre d'emploi existante dans la base de données.
public function modifier()
{
    // Construction de la requête SQL pour la modification d'une offre d'emploi.
    $sql = "UPDATE $this->table SET 
    reference=:reference, 
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
        ":reference"        => $this->reference,
        ":nom"              => $this->nom,
        ":description"      => $this->description,
        ":entreprise"      => $this->entreprise,
        ":ville_id"         => $this->ville_id,
        ":contrat_id"       => $this->contrat_id,
        ":metier_id"        => $this->metier_id,
        ":id"               => $this->id

```

*api/controllers/modifier.php*

```
    // Récupère les données JSON de la demande et les décode en un objet PHP.
    $data = json_decode(file_get_contents("php://input"));

    if ($data !== null && is_array($data)) {
        foreach ($data as $jobData) {
            // Vérifie si toutes les données requises sont présentes dans la demande.
            if (!empty($jobData->id) && !empty($jobData->nom)
                && !empty($jobData->description) && !empty($jobData->entreprise)
                && !empty($jobData->ville_id) && !empty($jobData->contrat_id)
                && !empty($jobData->metier_id)) {

                // On hydrate l'objet job avec les données de la demande
                $job->id               = intval($jobData->id);
                $job->nom              = htmlspecialchars($jobData->nom);
                $job->description      = htmlspecialchars($jobData->description);
                $job->entreprise       = htmlspecialchars($jobData->entreprise);
                $job->ville_id         = htmlspecialchars($jobData->ville_id);
                $job->contrat_id       = htmlspecialchars($jobData->contrat_id);
                $job->metier_id        = htmlspecialchars($jobData->metier_id);

                $result = $job->modifier();

```
<hr>



*api/models/JobApi.php*

```

public function supprimer()
{
    // Construction de la requête SQL pour la suppression d'une offre d'emploi.
    $sql = "DELETE FROM $this->table WHERE id = :id";
    $resultSql = $this->database->prepare($sql);

    $result = $resultSql->execute(array(":id" => $this->id));

```

*api/controllers/supprimer.php*

```
if ($_SERVER['REQUEST_METHOD'] === "DELETE") { // si la méthode de la demande est DELETE.
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    $job = new Job();

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id)) { // Vérifie si l'ID de l'offre d'emploi est présent dans les données de la demande.
        $job->id = $data->id; // Assigne l'ID de l'offre d'emploi .

```
