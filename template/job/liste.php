<!-- LISTE TEMPLATE -->

<div class="col-md-12 col-lg-8"> 
  <div class="row align-items-end mb-4"><!--  Header -->



    <div class="col-auto"> <!--  Tri -->
        <select class="form-select" aria-label="Default select">
          <option value="1">Nouvelles offres</option>
          <option value="2">Anciennes offres</option>
          <option value="3">Alphabétique (ascendant)</option>
          <option value="4">Alphabétique (descendant)</option>
          </select>
    </div>

  </div> <!--  !Header -->
  
  <div class="job-listing"> <!--  job-listing -->
  
    <?php 
      $selectionVilles = isset($_GET['ville']) ? $_GET['ville'] : [];
      $selectionMetiers = isset($_GET['metier']) ? $_GET['metier'] : [];
      $selectionContrats = isset($_GET['contrat']) ? $_GET['contrat'] : [];
      $MsgAucuneOffre = true; // Variable to track if no results message should be shown

      foreach ($offres as $row): 
        if (
          (empty($selectionVilles) || in_array($row->ville_nom, $selectionVilles)) &&
          (empty($selectionMetiers) || in_array($row->metier_nom, $selectionMetiers)) &&
          (empty($selectionContrats) || in_array($row->contrat_nom, $selectionContrats)) 
          ) :
          $MsgAucuneOffre = false; // If there's a matching result, set this to false
  ?>
      
    <div class="job-listing-block">
      <div class="d-flex">

          <div class="block-logo"><!--  Logo -->
            <img src="" alt="">
          </div>
          
        <div class="block-inner d-flex justify-content-between"><!--  Text -->
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

          <div class="block-job-ref">
            <p> <?= $row->contrat_nom ?></p> 
          </div>
        </div>
       </div>
    </div>
    
    <?php endif;
        endforeach;

        // Check if there are no selected filters or if all selected filters are empty
        if ($MsgAucuneOffre) :
        ?>
            <div class="job-listing-block">
                <div class="block-inner d-flex justify-content-center"><!--  Text -->
                    <p>Nous n'avons trouvé aucune offre d'emploi correspondant à votre recherche.</p>
                </div>
            </div>
        <?php endif; ?>
  </div><!--  !job-listing -->

  <?php require_once 'pagination.php'; ?>


</div> 