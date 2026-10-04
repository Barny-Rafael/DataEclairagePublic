<?php

namespace App\Controller;

final class HomeController
{
    public function index(): void
    {
        $titre = 'Accueil';
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        render('home', [
            'titre' => $titre,
            'utilisateur' => $utilisateur
        ]);
    }
}