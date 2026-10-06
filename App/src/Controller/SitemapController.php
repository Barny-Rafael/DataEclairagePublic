<?php

namespace App\Controller;

final class SitemapController
{
    public function sitemap(): void
    {
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        render('sitemap', [
            'titre' => 'Plan du site',
            'utilisateur' => $utilisateur
        ]);
    }
}