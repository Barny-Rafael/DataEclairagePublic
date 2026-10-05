<?php

namespace App\Controller;

final class SitemapController
{
    public function sitemap(): void
    {
        $titre = 'Plan du site';
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        $description = 'Découvrez le plan du site Data Éclairage Public et accédez directement aux pages disponibles.';

        render('sitemap', [
            'titre' => $titre,
            'utilisateur' => $utilisateur,
            'description' => $description
        ]);
    }
}