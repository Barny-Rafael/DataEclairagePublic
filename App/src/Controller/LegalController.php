<?php

namespace App\Controller;

final class LegalController
{
    public function legal(): void
    {
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        render('legal', [
            'titre' => 'Mentions légales',
            'utilisateur' => $utilisateur,
        ]);
    }
}