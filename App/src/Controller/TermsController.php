<?php
namespace App\Controller;

final class TermsController
{
    public function terms(): void
    {
        $titre = 'Conditions générales d\'utilisation';
        $description = 'Consultez les conditions générales d’utilisation de Data Éclairage Public.';

        render('terms', [
            'titre' => $titre,
            'description' => $description
        ]);
    }
}