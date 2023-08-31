<form method="GET">

    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle tri" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Trier par :
    </button>

    <ul class="dropdown-menu">
        <?php
        // Capture les paramètres de requête GET
        $getParams = $_GET;

        // Defint les options de tri et leurs nom
        $selectionTris = [
            'date_asc' => 'Date',
            'name_asc'  => 'Titre de l\'offre',
        ];

        foreach ($selectionTris as $key => $label) :
            // Détermine l'ordre de tri
            // Si le paramètre 'order' est défini et égal à 'desc', l'ordre est défini sur 'asc', sinon sur 'desc'.
            $order = isset($getParams['order']) && $getParams['order'] === 'asc' ? 'desc' : 'asc';

            // Si le paramètre 'tri' est défini dans la requête GET et qu'il correspond à la clé actuelle dans $selectionTris, alors le lien est désactivé.
            $isActive = isset($getParams['tri']) && $getParams['tri'] === $key;?>

            <li>
                <a class="dropdown-item <?= $isActive ? 'bg-danger text-white ' : '' ?>" href="<?= '?' . http_build_query(array_merge($getParams, ['tri' => $key, 'order' => $order])); ?>">
                    <?= $label ?>
                </a>
            </li>

        <?php endforeach; ?>

        </ul>
    </div>
</form>
