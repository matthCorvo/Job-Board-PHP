
<div class="col-md-12 col-lg-8"> <!-- Colonne principale -->
  <div class="row justify-content-end mb-4"><!--  Header -->

  <div class="col-auto"> <!-- Tri -->
  <?php require_once 'tri.php'; ?>
  </div>

  </div> <!--  !Header -->
  
  <div class="job-listing"> <!-- Bloc de liste d'emplois -->
  
  <?php 

    // Récupération des filtres sélectionnés depuis la requête GET
    $selectedVilles = isset($_GET['ville']) ? $_GET['ville'] : []; 
    $selectedMetiers = isset($_GET['metier']) ? $_GET['metier'] : [];
    $selectedContrats = isset($_GET['contrat']) ? $_GET['contrat'] : [];
    $MsgAucuneOffre = true;  // Affiche "Aucune offre" n'est affiché sie [] vide
    
    foreach ($offres as $row): 
      if (
        // Vérifie si le tableau sélectionnées est vide OU si le nom de de l'offre est présent dans les sélectionnées.
        (empty($selectedVilles) || in_array($row->ville_nom, $selectedVilles)) &&
        (empty($selectedMetiers) || in_array($row->metier_nom, $selectedMetiers)) &&
        (empty($selectedContrats) || in_array($row->contrat_nom, $selectedContrats)) 
        ) :
        $MsgAucuneOffre = false; // $MsgAucuneOffre désactivé, car une offre correspond aux filtres.
  ?>
      
  <div class="job-listing-block">
    <div class="d-flex">

      <div class="block-logo"><!--  Logo -->
        <img src="<?= $Api->getImageUrlFromAPI() ?>" alt="">
      </div>
          
      <div class="block-inner d-flex justify-content-between"><!-- Contenu de l'offre -->
        <div>
        <h4 class="mb-0">
          <a href="#"><?= $row->nom ?></a>
        </h4>

        <div class="block-job-name">
          <span><?= $row->entreprise ?></span> <?= $Utility->formatDate($row->date_publication) ?>
        </div>

        <p><?=  substr($row->description, 0, 30) ?></p>

        <ul class="block-job-info">
          <li><i class="fa-solid fa-location-dot"></i> <?= $row->ville_nom ?></li>
          <li><i class="fa-solid fa-tag"></i> <?= $row->metier_nom ?></li>
          <li><i class="fa-solid fa-hashtag"></i> <?= $row->reference ?></li>
        </ul>
        </div>

        <div class="block-job-contrat">
          <p> <?= $row->contrat_nom ?></p> 
        </div>
      </div>
    </div>
  </div>
    
  <?php endif;
   endforeach;

  // Vérifie si les filtres sélectionnés sont vides
  if ($MsgAucuneOffre) :  ?>

    <div class="job-listing-block">
        <div class="block-inner d-flex justify-content-center">
            <p>Nous n'avons trouvé aucune offre d'emploi correspondant à votre recherche.</p>
        </div>
    </div>

   <?php endif; ?>

  </div><!-- Fin de la colonne principale -->

    <div class="<?= $totalOffresSelection <= 10  ? 'd-none' : ''?>"> <!--Pagination -->
       <?php  require_once 'pagination.php'; ?>
    </div>



