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

  <nav aria-label="Page navigation" class="mt-4 pt-3 <?= $totalPages <= 1 ? 'd-none' : '';  ?>">
    <?php 
    $filtres = [];
    
   //  if (!empty($_GET['ville'])) {
   //      $filtres['ville'] = $_GET['ville'];
   //  }
     
   //  if (!empty($_GET['metier'])) {
   //      $filtres['metier'] = $_GET['metier'];
   //  }
     
   //  if (!empty($_GET['contrat'])) {
   //      $filtres['contrat'] = $_GET['contrat'];
   //  }

    $queryString = http_build_query($filtres);

    if ($totalPages > 1): ?> <!-- Check if there are more than one page -->
        <ul class="pagination justify-content-center">
            <!-- Previous Page Link -->
            <li class="page-item <?= $pageActuelle == 1 ? 'd-none' : ''; ?>">
                <a class="page-link" href="index.php?page=<?= ($pageActuelle - 1); ?>&<?= $queryString; ?>">&lt;</a>
            </li>
            
            <!-- Page Links -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $pageActuelle ? 'active' : ''; ?>">
                    <a class="page-link" href="index.php?page=<?= $i; ?>&<?= $queryString; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>
            
            <!-- Next Page Link -->
            <li class="page-item <?= $pageActuelle == $totalPages ? 'd-none' : ''; ?>">
                <a class="page-link" href="index.php?page=<?= ($pageActuelle + 1); ?>&<?= $queryString; ?>">&gt;</a>
            </li>
        </ul>
    <?php endif; ?>
</nav>
