<?php

namespace App\Controller;

final class LegalController
{
    public function legal(): void
    {
        $titre = 'Mentions légales';
        $description = 'Consultez les mentions légales de Data Éclairage Public.';

        render('legal', [
            'titre' => $titre,
            'description' => $description,

        ]);
    }
}