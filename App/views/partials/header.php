<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="/CSS/CSS_Basic_All_Pages.css">
</head>
<body>
    <header>
        <p class="gauche"><a href="/">Accueil</a></p>
        <p>Data Eclairage Public</p>
        <?php if (!isset($utilisateur)): ?>
            <p class="droite"><a href="/login">Connexion</a> | <a href="/register">Inscription</a></p>
        <?php else: ?>
            <a href="/logout">Déconnexion</a>
        <?php endif; ?>
    </header>