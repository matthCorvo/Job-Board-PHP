
# JOB BOARD
# IMG JOBBOARD


Création d'une page de Job Board, permettant la consultation d'offres d'emploi avec des fonctionnalités de filtrage et de pagination avec la base de données MySQL et le langage de programmation PHP. 


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

## Structure du Projet

```

job-board/
|-- app/
| |-- config/
| | |-- Database.php
| |
| |-- lib/
| | |-- Utility.php
| | |-- debug.php
| |
| |-- Controller/
| | |-- JobController.php
| |
| |-- models/
| | |-- JobModel.php
| | |-- ApiModel.php
| | |-- FiltreModel.php
| |
|-- views/
| |-- include/
| | |-- header.php
| | |-- footer.php
| |
| |-- job/
| | |-- index.php
| | |-- filtre.php
| | |-- liste.php
| | |-- pagination.php
| |
|-- assets/
| |-- css/
| | |-- filtre.css
| | |-- liste.css
| | |-- main.css
| |
| |
|-- index.php
```


## Base de Données

Le projet utilise une base de données MySQL avec les tables suivantes :

### Table des entreprises

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
  KEY `fk_ville_id` (`ville_id`),
  KEY `fk_contrat_id` (`contrat_id`),
  KEY `fk_metier_id` (`metier_id`)
  )

  ```


## Fonctionnalités

### Affichage des Offres d'Emploi
L'application affiche les offres d'emploi avec les détails suivants :
- Date à laquelle l'offre a été publiée.
- Date de mise à jour de l'offre .
- Référence unique de l'offre d'emploi.
- Intitulé de l'offre.
- Ville.
- Type de contrat.
- Type de métier.
- Nom de l'entreprise qui poste l'annonce.
- Description de l'offre (affichage des 30 premiers caractères seulement).

- Exemple d'extrait de code : function getSelectionEmploi
```
/**
     * Récupère les offres d'emploi filtrées en fonction du filtre et de la pagination.
     *
     * @param int $pageDePagination  La position de départ des résultats à récupérer.
     * @param int $OffresParPage Le nombre d'articles par page.
     * @return array Les offres d'emploi filtrées.
     */
    public function getSelectionEmploi($pageDePagination, $OffresParPage) :array {
        // Construire la requête SQL pour récupérer les offres d'emploi filtrées et paginées
        $sql = $this->database->prepare('SELECT offres_emploi.*, 
                         villes.nom AS ville_nom, 
                         metiers.nom AS metier_nom, 
                         contrats.nom AS contrat_nom
                  FROM offres_emploi 
                  INNER JOIN villes ON offres_emploi.ville_id = villes.id
                  INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
                  INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id
                  LIMIT :pageDePagination, :offresParPage
                  ');
    
        // Securiser les paramètres
        $sql->bindParam(':pageDePagination', $pageDePagination, \PDO::PARAM_INT);
        $sql->bindParam(':offresParPage', $OffresParPage, \PDO::PARAM_INT);

        $sql->execute();

        // Récupérer les offres d'emploi filtrées et paginées
        $selectionEmploi = $sql->fetchAll(\PDO::FETCH_OBJ);
    
        // Renvoie les offres d'emploi filtrées en fonction des critères de recherche et de la pagination.
        return $selectionEmploi;
    } 

```

- Exemple d'extrait de code : Template liste
```
  <?php 

    //Récupération des filtres sélectionnés depuis la requête GET 
    $selectionVilles = isset($_GET['ville']) ? $_GET['ville'] : []; 
    // ...

    foreach ($offres as $row): 

      if (
        // Vérifie si le tableau sélectionnées est vide OU si le nom de de l'offre est présent dans les sélectionnées.
        (empty($selectionVilles) || in_array($row->ville_nom, $selectionVilles)) &&
        // ...
        ) : ?>
          <a href="#"><?= $row->nom ?></a>
          <span><?= $row->entreprise ?></span> <?= $Utility->formatDate  ($row->date_publication) ?>
        <p><?=  substr($row->description, 0, 30) ?></p>
          <li><i class="fa-solid fa-location-dot"></i> <?= $row->ville_nom ?></li>
          <li><i class="fa-solid fa-tag"></i> <?= $row->metier_nom ?></li>
          <li><i class="fa-solid fa-hashtag"></i> <?= $row->reference ?></li>
          <p> <?= $row->contrat_nom ?></p> 
           
```


### Pagination
La liste des offres d'emploi est paginée, avec 10 offres par page. Le nombre de pages varie en fonction du nombre d'offres en base de données.

- Exemple d'extrait de code : function getTotalOffres
```
/**
     * Récupère le nombre total d'offres d'emploi dans la base de données.
     *
     * @return int Le nombre total d'offres d'emploi.
     */
    public function getTotalOffres() : int{
        // Construire la requête SQL pour compter le nombre total d'offres d'emploi
        $sql = $this->database->query('SELECT COUNT(*) as total FROM offres_emploi');
        $result = $sql->fetch(\PDO::FETCH_OBJ);
        
        // Retourner le nombre total d'offres d'emploi
        return (int)$result->total;
    }
```

- Exemple d'extrait de code : function getOffresAvecPagination
```
/**
     * Récupère les offres d'emploi avec pagination.
     *
     * Cette méthode récupère les offres d'emploi avec pagination en fonction de la page actuelle et du nombre d'éléments par page.
     *
     * @return array Un tableau contenant les offres d'emploi, le nombre total de pages, la page actuelle et le nombre d'éléments par page.
     */
    public function getOffresAvecPagination() : array {
        $OffresParPage = 10; // Nombre d'éléments par page
        
        // Définit la page actuelle
        $pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Calcule le nombre total de pages
        $totalOffres = $this->offresEmplois->getTotalOffres();

        // Calcule la page de la pagination en fonction de la page actuelle et du nombre d'éléments par page
        $pageDePagination  = ($pageActuelle - 1) * $OffresParPage;

        // Récupère les données pour la page actuelle
        $offres = $this->offresEmplois->getSelectionEmploi($pageDePagination , $OffresParPage);

        // Calcule le nombre total de pages
        $totalPages = ceil($totalOffres / $OffresParPage);

        // Retourne les résultats sous forme de tableau
        return [
            'offres' => $offres,
            'totalPages' => $totalPages,
            'pageActuelle' => $pageActuelle,
            'OffresParPage' => $OffresParPage,
        ];
    }
```

- Exemple d'extrait de code : Template pagination
```
      <?php
      // Capture le paramètres de requête GET
      $getParams = $_GET;
      unset($getParams['page']); // Supprime le paramètre "page" existant s'il existe déja
   
      if ($pageActuelle > 1) : ?>

      <li class="page-item">
            <a class="page-link" href="<?= 'index.php?page=' . ($pageActuelle - 1) . '&' . http_build_query($getParams); ?>">&lt;</a>
      </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++) :
      if ($i === $pageActuelle) : ?>
            <li class="page-item active">
               <span class="page-link"><?= $i; ?></span>
            </li>
      <?php else : ?>
            <li class="page-item">
               <a class="page-link" href="<?= 'index.php?page=' . $i . '&' . http_build_query($getParams); ?>"><?= $i; ?></a>
            </li>
      <?php endif; ?>
      <?php endfor; ?>

      <?php
      if ($pageActuelle < $totalPages) : ?>
         <li class="page-item">
         <a class="page-link" href="<?= 'index.php?page=' . ($pageActuelle + 1) . '&' . http_build_query($getParams); ?>">&gt;</a>
         </li>
      <?php endif; ?>
```


### Filtres
Les utilisateurs peuvent filtrer les offres d'emploi par les critères suivants :
- Ville.
- Métier.
- Type de contrat.

Les filtres sont cumulables, et leur sélection est conservée lors du changement de page.

- Exemple d'extrait de code : function getFiltreVilles, function getFiltreMetier, function getFiltreContrat
```  
  /**
     * Récupère les villes disponibles dans la base de données.
     *
     * @return array Un tableau contenant les villes disponibles.
     */
    public function getFiltreVilles() {
        // Exécute une requête pour récupérer les villes distinctes
        $sql = $this->database->query('SELECT DISTINCT * FROM villes');
        $sql->execute();
        // Récupère les résultats sous forme d'objets
        $villes = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $villes;
    }

```

- Exemple d'extrait de code : Template filtre
``` 
  <?php 
        $checked = isset($_GET['ville']) ? $_GET['ville'] : [];  // Vérifie si des villes ont été sélectionnées dans la requête GET
        foreach ($villes as $villeList)  :
        $isChecked = in_array($villeList->nom, $checked); ?>
            
            <input class="form-check-input" type="checkbox" value='<?= $villeList->nom ?>' id="<?= $villeList->id ?>" name="ville[]" 
            <?= $isChecked ? 'checked' : '' ;?>>
            <label class="form-check-label" for="location"><?= $villeList->nom ?> </label>
        </div>
        <?php endforeach; ?>
```

### Tri
Les utilisateurs peuvent trier la liste par :
- Date de publication (ascendant ou descendant).
- Ordre alphabétique (ascendant ou descendant).


### API pour les Images
Les logos des entreprises sont obtenus depuis une API externe (https://some-random-api.ml/meme) au format JSON.




