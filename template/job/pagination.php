<!-- PAGINATION TEMPLATE -->

  <!--  Pagination -->
  <!-- <nav aria-label="Page navigation" class="mt-4 pt-3">
    <ul class="pagination justify-content-center"> 
       <li class="page-item active"><a class="page-link" href="#">1</a></li>
       <li class="page-item"><a class="page-link" href="#">2</a></li>
       <li class="page-item"><a class="page-link" href="#">3</a></li>
       <li class="page-item">
          <a class="page-link" href="#">&gt;</a>
       </li>
    </ul>
  </nav> -->

  <!-- Pagination -->

<!-- Pagination -->
<?php if ($filteredOffres >= 10)  : ?>

<nav aria-label="Page navigation" class="mt-4 pt-3">
    <ul class="pagination justify-content-center"> 
        <?php
   // Capture the existing query parameters
   $queryParams = $_GET;
   unset($queryParams['page']); // Remove the existing "page" parameter if it exists
   
        // Generate the "Previous" link
        if ($pageActuelle > 1) : ?>
         <li class="page-item">
             <a class="page-link" href="<?= 'index.php?page=' . ($pageActuelle - 1) . '&' . http_build_query($queryParams); ?>">&lt;</a>
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
                   <a class="page-link" href="<?= 'index.php?page=' . $i . '&' . http_build_query($queryParams); ?>"><?= $i; ?></a>
                  </li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php // Generate the "Next" link
        if ($pageActuelle < $totalPages) : ?>
            <li class="page-item">
            <a class="page-link" href="<?= 'index.php?page=' . ($pageActuelle + 1) . '&' . http_build_query($queryParams); ?>">&gt;</a>
            </li>
        <?php else : ?>
            <li class="page-item d-none">
                <span class="page-link">&gt;</span>
            </li>
        <?php endif; ?>

    </ul>
</nav>
<?php endif; ?>

