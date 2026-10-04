<?php
function render(string $vue, array $donnees = []): void
{
    $donnees += ['utilisateurConnecte' => $_SESSION['utilisateur'] ?? null];
    extract($donnees, EXTR_SKIP);

    $basePath = dirname(__DIR__);

    //haut de page
    require $basePath . '/../views/partials/header.php';

    //vue
    require $basePath . '/../views/' . $vue . '.php';

    //bas de page
    require $basePath . '/../views/partials/footer.php';
}