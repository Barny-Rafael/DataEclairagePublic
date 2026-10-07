<?php

namespace App\Controller;

final class LegalController
{
    public function legal(): void
    {
        $titre = 'Mentions légales';
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        $description = 'Consultez les mentions légales de Data Éclairage Public.';

        render('legal', [
            'titre' => $titre,
            'utilisateur' => $utilisateur,
            'description' => $description
        ]);
    }
}