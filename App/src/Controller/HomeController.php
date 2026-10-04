<?php


namespace App\Controller;

use App\Core\Request;
use App\Core\Response;

final class HomeController
{
	public function index(Request $request): Response
	{
		$titre = 'Accueil';
		$utilisateur = $request->session('utilisateur');

		return render('home', [
			'titre' => $titre,
			'utilisateur' => $utilisateur
		]);
	}
}