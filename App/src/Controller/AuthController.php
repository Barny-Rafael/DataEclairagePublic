<?php

namespace App\Controller;

use App\Model\UserRepository;

final class AuthController
{
    public function __construct(private readonly UserRepository $repository) {}

    public function loginForm(string $erreur = null, string $email = ''): void
    {
        $titre = 'Connexion';
        $description = 'Connectez-vous à votre compte utilisateur Data Éclairage Public.';

        render('login', [
            'titre' => $titre,
            'erreur' => $erreur,
            'email' => $email,
            'description' => $description
        ]);
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $utilisateur = $this->repository->findByEmail($email);

        if ($utilisateur && $utilisateur->verifyPassword($password)) {
            $_SESSION['utilisateur'] = [
                'id' => $utilisateur->id,
                'email' => $utilisateur->email
            ];
            header('Location: /');
            exit;
        }

        $erreur = 'Email ou mot de passe incorrect.';

        $this->loginForm($erreur, $email);
    }

    public function registerForm(array $erreurs = [], bool $succes = false, string $email = ''): void
    {
        $titre = 'Inscription';
        $description = 'Créez un compte pour accéder aux services de Data Éclairage Public.';

        render('register', [
            'titre' => $titre,
            'erreurs' => $erreurs,
            'succes' => $succes,
            'email' => $email,
            'description' => $description
        ]);
    }

    public function register(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmation = $_POST['confirmation'] ?? '';
        $succes = false;
        $erreurs = [];

        // Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = 'L\'adresse email est invalide.';
        }
        if (strlen($password) < 8) {
            $erreurs[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }
        if ($password !== $confirmation) {
            $erreurs[] = 'Les deux mots de passe ne correspondent pas.';
        }

        // Vérifie que l'email n'est pas déjà utilisé
        if (empty($erreurs)) {
            if ($this->repository->emailExists($email)) {
                $erreurs[] = 'Un compte existe déjà avec cet email.';
            }
        }

        // Insertion
        if (empty($erreurs)) {
            $this->repository->create($email, $password);
            $succes = true;
        }

        $this->registerForm($erreurs, $succes, $email);
    }



    public function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}