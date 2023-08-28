
# JOB BOARD
# IMG JOBBOARD


Création d'une page de Job Board, permettant la consultation d'offres d'emploi avec des fonctionnalités de filtrage et de pagination avec la base de données MySQL et le langage de programmation PHP. 

# Table des matières

1. [Installation](#installation)
2. [Base de Données](#Base-de-Données)
4. [Fonctionnalités](#fonctionnalités)
   - [Affichage des Offres d'Emploi](#affichage-des-offres-demploi)
   - [Filtres](#filtres)
   - [Pagination](#pagination)
   - [Tri](#tri)
   - [API pour les Images](#api-pour-les-images)


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
  KEY `fk_ville_id` (`ville_id`),
  KEY `fk_contrat_id` (`contrat_id`),
  KEY `fk_metier_id` (`metier_id`)
  )

  ```


## Fonctionnalités

### Affichage et tri des Offres d'Emploi 
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
- tri des intitulé de l'offre et date pare ordre ascendant / descendant


- Exemple d'extrait de code : function getSelectionEmploi
```
/**
     * Récupère les offres d'emploi filtrées en fonction des filtres de tri et de la pagination.
     *
     * @param int $pageDePagination  La position de départ des résultats à récupérer.
     * @param int $OffresParPage Le nombre d'articles par page.
     * @param string $selectionTri Le nom de la colonne utilisée pour le tri.
     * @param string $triDirection La direction du tri (ASC pour croissant, DESC pour décroissant).
     * @return array Les offres d'emploi filtrées.
     */
    public function getSelectionEmploi($pageDePagination, $OffresParPage, $selectionTri, $triDirection) : array {
        // Construire la requête SQL pour récupérer les offres d'emploi filtrées et paginées
        $sql = 'SELECT offres_emploi.*, 
                         villes.nom AS ville_nom, 
                         metiers.nom AS metier_nom, 
                         contrats.nom AS contrat_nom
                  FROM offres_emploi 
                  INNER JOIN villes ON offres_emploi.ville_id = villes.id
                  INNER JOIN metiers ON offres_emploi.metier_id = metiers.id
                  INNER JOIN contrats ON offres_emploi.contrat_id = contrats.id';

                  // Ajouter la clause ORDER BY si un tri est spécifiée
                  if (!empty($selectionTri)) {
                    $sql .= ' ORDER BY ' . $selectionTri . ' ' . $triDirection;
                  }

                 // Ajouter la clause LIMIT pour la pagination
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

- Exemple d'extrait de code : Template Tri
```
        <?php
            // Capture les paramètres de requête GET
            $getParams = $_GET;
            $baseUrl = '';

            // Defint les options de tri et leurs nom
            $selectionTris = [
              'date_desc' => 'Date (récentes)',
              'date_asc'  => 'Date (anciennes)',
              'name_asc'  => 'Nom (A à Z)',
              'name_desc' => 'Nom (Z à A)',
            ];

            foreach ($selectionTris as $key => $label) :
                // Détermine l'ordre de tri
                // Si le paramètre 'order' est défini et égal à 'desc', l'ordre est défini sur 'asc', sinon sur 'desc'.
                $order = isset($getParams['order']) && $getParams['order'] === 'desc' ? 'asc' : 'desc';
    
                // Si le paramètre 'tri' est défini dans la requête GET et qu'il correspond à la clé actuelle dans $selectionTris, alors le lien est désactivé.
                $isActive = isset($getParams['tri']) && $getParams['tri'] === $key;

            ?>

                <li>
                    <a class="dropdown-item <?= $isActive ? 'bg-danger text-white disabled ' : '' ?>" href="<?= $baseUrl . '?' . http_build_query(array_merge($getParams, ['tri' => $key, 'order' => $order])); ?>">
                        <?= $label ?>
                    </a>
                </li>

            <?php endforeach; ?>
           
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
     * Récupère les offres d'emploi avec pagination et tri.
     *
     * Cette function récupère les offres d'emploi avec pagination en fonction de la page actuelle,
     * du nombre d'éléments par page, du tri et de la direction de tri.
     *
     * @return array  tableau contenant les offres d'emploi, le nombre total de pages, la page actuelle et le nombre d'éléments par page.
     *             
     */
    public function getOffresAvecPagination() : array {
        $OffresParPage = 10; // Nombre d'éléments par page
        
        // Définit la page actuelle
        $pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;

       
        $selectionTri = 'date_publication'; // Colonne de tri par défaut
        $triDirection = 'DESC'; // Direction de tri par défaut

        // Définir les colonnes de tri et leurs correspondances avec les champs de la base de données
        $selectionTris = [
            'date_desc' => 'date_publication',
            'date_asc' => 'date_publication',
            'name_asc' => 'nom',
            'name_desc' => 'nom',
        ];

        // si le paramètre 'tri' est défini dans la requête GET et s'il correspond à une option de tri valide.
        if (isset($_GET['tri']) && isset($selectionTris[$_GET['tri']])) {
            // mise à jour de l'option de tri utiliser.
            $selectionTri = $selectionTris[$_GET['tri']];

            // si le paramètre 'order' est défini dans la requête GET et s'il est défini sur tri ascendant.
            if (isset($_GET['order']) && $_GET['order'] === 'asc') {
                // mise à jour de la direction de tri pour qu'elle soit (ascendant).
                $triDirection = 'ASC';
            }
          
        }

        // Calcule le nombre total de pages
        $totalOffres = $this->offresEmplois->getTotalOffres();

        // Calcule la page de la pagination en fonction de la page actuelle et du nombre d'éléments par page
        $pageDePagination  = ($pageActuelle - 1) * $OffresParPage;

        // Récupère les données pour la page actuelle
        $offres = $this->offresEmplois->getSelectionEmploi($pageDePagination, $OffresParPage, $selectionTri, $triDirection);

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

### Router




### API pour les Images
Les logos des entreprises sont obtenus depuis une API externe (https://some-random-api.ml/meme) au format JSON.



