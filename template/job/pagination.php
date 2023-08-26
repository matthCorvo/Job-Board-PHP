
<nav aria-label="Page navigation" class="mt-4 pt-3">
   <ul class="pagination justify-content-center"> 
      <?php
      // Capture le paramètres de requête GET
      $getParams = $_GET;
      unset($getParams['page']); // Supprime le paramètre "page" existant s'il existe déja
   
      if ($pageActuelle > 1) : ?>

      <li class="page-item">
            <a class="page-link" href="<?= 'index.php?page=' . ($pageActuelle - 1) . '&' . http_build_query($getParams); ?>">&lt;</a>
      </li>
      <?php else : ?>
            <li class="page-item d-none">
               <span class="page-link">&lt;</span>
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
      <?php else : ?>
         <li class="page-item d-none">
               <span class="page-link">&gt;</span>
         </li>
      <?php endif; ?>

    </ul>
</nav>

