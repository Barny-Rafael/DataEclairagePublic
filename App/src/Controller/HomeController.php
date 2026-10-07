<?php

namespace App\Controller;

final class HomeController
{
    public function index(): void
    {
        $titre = 'Accueil';
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        $description = 'Bienvenue sur Data Éclairage Public, plateforme de consultation des données sur les éclairages publiques.';
        render('home', [
            'titre' => $titre,
            'utilisateur' => $utilisateur,
            'description' => $description,
        ]);
    }
}