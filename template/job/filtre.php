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
            $checked = isset($_GET['ville']) ? $_GET['ville'] : [];
            
            foreach ($villes as $villeList)  :
                $isChecked = in_array($villeList->nom, $checked);
                    ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value='<?= $villeList->nom ?>' id="<?= $villeList->id ?>" name="ville[]" 
                    <?= $isChecked ? 'checked' : '' ;?>>
                    <label class="form-check-label" for="location"><?= $villeList->nom ?> </label>
               </div>
            <?php endforeach; ?>
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
            $checked = isset($_GET['metier']) ? $_GET['metier'] : [];
            foreach ($metiers as $metierList)  :
                $isChecked = in_array($metierList->nom, $checked);
               
                    ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value='<?= $metierList->nom ?>' id="<?= $metierList->id ?>" name="metier[]" 
                    <?= $isChecked ? 'checked' : '' ;?>>
                    <label class="form-check-label" for="location"><?= $metierList->nom ?> </label>
               </div>
            <?php endforeach; ?>
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
            $checked = isset($_GET['contrat']) ? $_GET['contrat'] : [];
            foreach ($contrats as $contratList)  :
                $isChecked = in_array($contratList->nom, $checked);
               
                    ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value='<?= $contratList->nom ?>' id="<?= $contratList->id ?>" name="contrat[]" 
                    <?= $isChecked ? 'checked' : '' ;?>>
                    <label class="form-check-label" for="location"><?= $contratList->nom ?> </label>
               </div>
            <?php endforeach; ?>
           </div> 

          </form>
       </div>
    </div>

</div>