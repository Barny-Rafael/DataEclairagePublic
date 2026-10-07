<?php
    namespace App\Controller;

    final class AccountController
    {
        public function account(): void
        {
            $utilisateur = $_SESSION['utilisateur'] ?? null;
            $titre = 'Mon compte';
            $description = 'Gérez ici vos informations personnelles et les paramètres de votre compte sur Data Éclairage Public.';
            render('account', [
                'titre' => $titre,
                'utilisateur' => $utilisateur,
                'description' => $description,
            ]);
        }
    }