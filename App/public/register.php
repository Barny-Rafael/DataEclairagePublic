<?php
// Page d'inscription "classique" : connexion à la base, validation, insertion et HTML au même endroit.
session_start();
require '../src/Core/render.php';
require '../config/db.php';     // $pdo est maintenant disponible
require '../src/Model/User.php';
require '../src/Model/UserRepository.php';
// ... traitement ...
$titre = 'Inscription';
$erreurs = [];
$succes = false;
$email = '';
$repository = new UserRepository($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

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
        if ($repository->emailExists($email)) {
            $erreurs[] = 'Un compte existe déjà avec cet email.';
        }
    }

    // Insertion
    if (empty($erreurs)) {
        $userRepository->create($email, $password);
        $succes = true;
    }
}

render('register', [
    'titre'   => $titre,
    'erreurs' => $erreurs,
    'succes'  => $succes,
    'email'   => $email
]);