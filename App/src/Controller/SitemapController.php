<?php

namespace App\Controller;

final class SitemapController
{
    public function sitemap(): void
    {
        $titre = 'Plan du site';
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        $description = 'Découvrez le plan du site Data Éclairage Public et accédez directement aux pages disponibles.';

        $liens = [['/', 'Accueil']];
        if (!isset($utilisateur)) {
            $liens[] = ['/login', 'Connexion'];
            $liens[] = ['/register', 'Inscription'];
        } else {
            $liens[] = ['/account', 'Mon compte'];
            $liens[] = ['/lampadaires', 'Notre base de données'];
        }
        $liens[] = ['/legal', 'Mentions légales'];
        $liens[] = ['/terms', 'Conditions générales d\'utilisation'];

        $pagination = paginer(count($liens), 5);
        $liens = array_slice($liens, $pagination['offset'], $pagination['parPage']);

        render('sitemap', [
            'titre' => $titre,
            'utilisateur' => $utilisateur,
            'description' => $description,
            'liens' => $liens,
            'pagination' => $pagination
        ]);
    }
}