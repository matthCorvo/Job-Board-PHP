<div class="col-md-12 col-lg-4">
    <div class="filtre-box">								

       <div class="box-content">
    <form method="GET" >
        <div class="card-header">
            <h5>Filter 
                <button type="submit" class="btn btn-primary btn-sm float-end">Filtrer</button>
            </h5>
        </div>
        <div class="box-header">
            <h4>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse01" aria-expanded="true" aria-controls="collapse01">Villes</a>
            </h4>
        </div>
        <div id="collapse01" class="collapse show">
            <?php 
            $uniqueCities = [];
            $checked = isset($_GET['ville']) ? $_GET['ville'] : [];
            foreach ($offres as $villeList)  {
                $isChecked = in_array($villeList->ville_id, $checked);
                
                // Check if the city name is already in the uniqueCities array
                if (!in_array($villeList->ville_nom, $uniqueCities)) {
                    $uniqueCities[] = $villeList->ville_nom;
                    ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value='<?= $villeList->ville_nom ?>' id="<?= $villeList->ville_id ?>" name="ville[]" 
                    <?= $isChecked ? 'checked' : '' ;?>>
                    <label class="form-check-label" for="location"><?= $villeList->ville_nom ?> </label>
               </div>
            <?php }
            }; ?>

           </div>
       </div>

      <div class="box-content">
          <div class="box-header">
            <h4>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse02" aria-expanded="true" aria-controls="collapse02">Metier</a>
            </h4>
          </div>
          <div id="collapse02" class="collapse show">
          <?php 
            $uniquemetier = [];
            $checked = isset($_GET['metier']) ? $_GET['metier'] : [];
            foreach ($offres as $metierList)  {
                $isChecked = in_array($metierList->metier_id, $checked);
                
                // Check if the city name is already in the uniqueCities array
                if (!in_array($metierList->metier_nom, $uniquemetier)) {
                    $uniquemetier[] = $metierList->metier_nom;
                    ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value='<?= $metierList->metier_nom ?>' id="<?= $metierList->metier_id ?>" name="metier[]" 
                    <?= $isChecked ? 'checked' : '' ;?>>
                    <label class="form-check-label" for="location"><?= $metierList->metier_nom ?> </label>
               </div>
            <?php }
            }; ?>
           </div>
       </div>

      <div class="box-content">
          <div class="box-header">
            <h4>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse03" aria-expanded="true" aria-controls="collapse03">Contrat</a>
            </h4>
          </div>
          <div id="collapse03" class="collapse show">
          <?php 
            $uniqueContrat = [];
            $checked = isset($_GET['contrat']) ? $_GET['contrat'] : [];
            foreach ($offres as $contratList)  {
                $isChecked = in_array($contratList->contrat_id, $checked);
                
                // Check if the city name is already in the uniqueCities array
                if (!in_array($contratList->contrat_nom, $uniqueContrat)) {
                    $uniqueContrat[] = $contratList->contrat_nom;
                    ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value='<?= $contratList->contrat_nom ?>' id="<?= $contratList->contrat_id ?>" name="contrat[]" 
                    <?= $isChecked ? 'checked' : '' ;?>>
                    <label class="form-check-label" for="location"><?= $contratList->contrat_nom ?> </label>
               </div>
            <?php }
            }; ?>
           </div> 

          </form>
       </div>
    </div>

</div>