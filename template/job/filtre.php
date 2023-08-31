<div class="col-md-12 col-lg-4">
    <div class="filtre-box">								

    <form method="GET" >
    <div class="box-content">
        <div class="card-header d-flex justify-content-between mb-5">
            <h5>Filtre</h5>
            <div >
                <a href="index.php" class="btn btn-secondary btn-sm "><i class="fa-solid fa-arrow-rotate-left"></i> Effacer</a>
                <button type="submit"  class="btn btn-sm ">Filtre</button>
            </div>
        </div>

        <div class="box-header">
            <h4>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse01" aria-expanded="true" aria-controls="collapse01">Villes</a>
            </h4>
        </div>

        <div id="collapse01" class="collapse show">
        <?php 
        $checked = isset($_GET['ville']) ? $_GET['ville'] : [];  // Vérifie si des villes ont été sélectionnées dans la requête GET
        foreach ($villes as $villeList)  :

        $isChecked = in_array($villeList->ville_nom, $checked); ?>
            
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value='<?= $villeList->ville_nom ?>' id="<?= $villeList->ville_id ?>" name="ville[]" 
            <?= $isChecked ? 'checked' : '' ;?> />
            <label class="form-check-label" for="location"><?= $villeList->ville_nom ?> (<?= $villeList->total?>) </label>
        </div>

        <?php 

    endforeach; ?>
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
        $checked = isset($_GET['metier']) ? $_GET['metier'] : []; // Vérifie si des metier ont été sélectionnées dans la requête GET
        foreach ($metiers as $metierList)  :
        $isChecked = in_array($metierList->metier_nom, $checked); ?>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value='<?= $metierList->metier_nom ?>' id="<?= $metierList->metier_id ?>" name="metier[]" 
            <?= $isChecked ? 'checked' : '' ;?>>
            <label class="form-check-label" for="location"><?= $metierList->metier_nom ?>  (<?= $metierList->total?>)</label>
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
        $checked = isset($_GET['contrat']) ? $_GET['contrat'] : []; // Vérifie si des contrat ont été sélectionnées dans la requête GET
        foreach ($contrats as $contratList)  :
        $isChecked = in_array($contratList->contrat_nom, $checked); ?>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value='<?= $contratList->contrat_nom ?>' id="<?= $contratList->contrat_id ?>" name="contrat[]" 
            <?= $isChecked ? 'checked' : '' ;?>>
            <label class="form-check-label" for="location"><?= $contratList->contrat_nom ?> (<?= $contratList->total ?>)</label>
        </div>

        <?php endforeach; ?>
        </div> 

    </div>
    </form>
    </div>

</div>