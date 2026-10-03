<?php
function render(string $vue, array $donnees = []): void
{
    $donnees += ['utilisateurConnecte' => $_SESSION['utilisateur'] ?? null];
    extract($donnees, EXTR_SKIP);
    require '../views/' . $vue . '.php';
}