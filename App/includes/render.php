<?php

use App\Core\Response;
function render(string $vue, array $donnees = [], int $statut = 200): Response
{
	$donnees += ['utilisateurConnecte' => $_SESSION['utilisateur'] ?? null];
	extract($donnees, EXTR_SKIP);

	ob_start();                                          // à partir d'ici, rien ne part vers le navigateur
	require dirname(__DIR__) . '/views/' . $vue . '.php';
	$html = ob_get_clean();                              // récupère ce qui a été affiché, vide le tampon

	return new Response($statut, $html);
}