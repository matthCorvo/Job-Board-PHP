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
<nav aria-label="Page navigation" class="mt-4 pt-3">
    <ul class="pagination justify-content-center"> 
        <?php
     
        // Define your query parameters as an associative array
        $params = [
            'page' => $pageActuelle,
            
        ];

        // Use http_build_query to create the query string
        $queryString = http_build_query($params);
        
        // Define the URL pattern for the pagination links
        $urlPattern = 'index.php?' . $queryString;
var_dump($urlPattern);
        // Generate the "Previous" link
        if ($pageActuelle > 1) :  ?>
            <li class="page-item">
                <a class="page-link" href="<?= sprintf($urlPattern, $pageActuelle - 1); ?>">&lt;</a>
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
                    <a class="page-link" href="<?= sprintf($urlPattern, $i); ?>"><?= $i; ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php // Generate the "Next" link
        if ($pageActuelle < $totalPages) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= sprintf($urlPattern, $pageActuelle + 1); ?>">&gt;</a>
            </li>
        <?php else : ?>
            <li class="page-item d-none">
                <span class="page-link">&gt;</span>
            </li>
        <?php endif; ?>

    </ul>
</nav>

