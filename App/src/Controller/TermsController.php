<?php
namespace App\Controller;

final class TermsController
{
    public function terms(): void
    {
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        render('terms', [
            'titre' => 'Conditions générales d\'utilisation',
            'utilisateur' => $utilisateur
        ]);
    }
}