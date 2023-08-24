<div class="col-md-12 col-lg-4">
    <div class="filtre-box">								

       <div class="box-content">
    <form method="GET" action="index.php">
        <div class="card-header">
            <h5>Filter 
                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
            </h5>
        </div>
        <div class="box-header">
            <h4>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse02" aria-expanded="true" aria-controls="collapse02">Villes</a>
            </h4>
        </div>
        <div id="collapse02" class="collapse show">
            <?php foreach ($villes as $ville) : ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value='<?= $ville->nom ?>' id="<?= $ville->id ?>" name="ville[]">
                    <label class="form-check-label" for="location"><?= $ville->nom ?> </label>

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
               <!-- <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="location">
                    <label class="form-check-label" for="location">New York, NY <span class="pbmit-badge">(143)</span></label>
               </div>
               <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="location-1">
                    <label class="form-check-label" for="location-1">Jersey City, NJ <span class="pbmit-badge">(14)</span></label>
               </div>
               <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="location-2">
                    <label class="form-check-label" for="location-2">Brooklyn, NY <span class="pbmit-badge">(5)</span></label>
               </div>
               <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="location-3">
                    <label class="form-check-label" for="location-3">Bronx, NY <span class="pbmit-badge">(2)</span></label>
               </div> -->
           </div>
       </div>

      <div class="box-content">
          <div class="box-header">
            <h4>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse02" aria-expanded="true" aria-controls="collapse02">Contrat</a>
            </h4>
          </div>
          <div id="collapse02" class="collapse show">
               <!-- <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="location">
                    <label class="form-check-label" for="location">New York, NY <span class="pbmit-badge">(143)</span></label>
               </div>
               <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="location-1">
                    <label class="form-check-label" for="location-1">Jersey City, NJ <span class="pbmit-badge">(14)</span></label>
               </div>
               <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="location-2">
                    <label class="form-check-label" for="location-2">Brooklyn, NY <span class="pbmit-badge">(5)</span></label>
               </div>
               <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="location-3">
                    <label class="form-check-label" for="location-3">Bronx, NY <span class="pbmit-badge">(2)</span></label>
               </div> -->
           </div> 

          </form>
       </div>
    </div>

</div>