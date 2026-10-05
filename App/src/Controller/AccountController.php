<?php
    namespace App\Controller;

    final class AccountController
    {
        public function account(): void
        {
            $utilisateur = $_SESSION['utilisateur'] ?? null;
            render('account', [
                'titre' => 'Mon compte',
                'utilisateur' => $utilisateur
            ]);
        }
    }