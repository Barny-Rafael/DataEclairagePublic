<?php
// Page d'accueil "classique" : la logique PHP et le HTML sont mélangés dans le même fichier.

// ... traitement ...
$titre = 'Accueil';
$utilisateur = $_SESSION['utilisateur'] ?? null;

render('home', [
    'titre' => $titre,
    'utilisateur' => $utilisateur
]);