<?php
// Page d'accueil "classique" : la logique PHP et le HTML sont mélangés dans le même fichier.
session_start();
require '../src/Core/render.php';
require '../config/db.php';     // $pdo est maintenant disponible
// ... traitement ...
$titre = 'Accueil';
$utilisateur = $_SESSION['utilisateur'] ?? null;

// Déconnexion : on gère l'action directement ici, dans la page.
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.php');
    exit;
}

render('home', [
    'titre' => $titre,
    'utilisateur' => $utilisateur
]);