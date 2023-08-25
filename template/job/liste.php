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
  <?php if (count($offres) == 0) : ?>
    <div class="job-listing-block">

        <div class="block-inner d-flex justify-content-center"><!--  Text -->
        <p>Aucune offre d'emploi ne correspond à vos filtres. </p>
       </div>
    </div>
    <?php else: ?>
    <?php foreach ($offres as $row): ?>
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
    <?php endforeach; ?>
    <?php endif; ?>

  </div><!--  !job-listing -->

  <?php require_once 'pagination.php'; ?>


</div> 