<?php
// Page de connexion "classique" : même structure que register.php, avec le même code dupliqué.

use App\Model\UserRepository;

// ... traitement ...
$titre = 'Connexion';
$repository = new UserRepository($pdo);

// Déjà connecté ? On renvoie vers l'accueil.
if (isset($_SESSION['utilisateur'])) {
    header('Location: index.php');
    exit;
}

$erreur = null;
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $utilisateur = $repository->findByEmail($email);

    if ($utilisateur && $utilisateur->verifyPassword($password)) {
        $_SESSION['utilisateur'] = [
            'id' => $utilisateur->id,
            'email' => $utilisateur->email
        ];
        header('Location: index.php');
        exit;
    }

    $erreur = 'Email ou mot de passe incorrect.';
}

render('login', [
    'titre'   => $titre,
    'erreur' => $erreur,
    'email'   => $email
]);