<!-- LISTE TEMPLATE -->

<div class="col-md-12 col-lg-8"> 
  <div class="row align-items-end mb-4"><!--  Header -->

    <div class="col"><!--  infos -->
        <p class="mb-0 text-info-liste"> <?= count($jobs) ?> offres d'emplois sur ...</p>
    </div>

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
  
    <?php foreach ($jobs as $row): ?>
    <div class="job-listing-block">
      <div class="d-flex">

          <div class="block-logo"><!--  Logo -->
            <img src="<?= $ApiUrl ?>" alt="">
          </div>
          
        <div class="block-inner d-flex justify-content-between"><!--  Text -->
          <div>
              <h4 class="mb-0">
                <a href="#"><?= $row->job_title ?></a>
              </h4>

              <div class="block-job-name">
                <span><?= $row->company_name ?></span> <?= $Utility->formatDate($row->date_posted) ?>
              </div>

              <p><?=  substr($row->description, 0, 30) ?></p>

              <ul class="block-job-info">
                <li><i class="fa-solid fa-location-dot"></i> <?= $row->job_location ?></li>
                <li><i class="fa-solid fa-tag"></i> <?= $row->job_category ?></li>
                <li><i class="fa-solid fa-hashtag"></i> <?= $row->job_reference ?></li>
              </ul>
          </div>

          <div class="block-job-ref">
            <p> <?= $row->job_contract ?></p> 
          </div>
        </div>
       </div>
    </div>
    <?php endforeach; ?>

  </div><!--  !job-listing -->

  <!--  Pagination -->
  <nav aria-label="Page navigation" class="mt-4 pt-3">
    <ul class="pagination justify-content-center"> 
       <li class="page-item active"><a class="page-link" href="#">1</a></li>
       <li class="page-item"><a class="page-link" href="#">2</a></li>
       <li class="page-item"><a class="page-link" href="#">3</a></li>
       <li class="page-item">
          <a class="page-link" href="#">&gt;</a>
       </li>
    </ul>
  </nav>

</div> 