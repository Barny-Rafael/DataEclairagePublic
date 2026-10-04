<?php
namespace App\Controller;

final class HomeController
{
	public function index(): void
	{
		// On vérifie si la session contient l'ID utilisateur
		$estConnecte = isset($_SESSION['user_id']);

		render('home', [
			'titre' => 'Accueil',
			'estConnecte' => $estConnecte
		]);
	}
}