<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?= htmlspecialchars($description ?? 'Site de consultation et gestion de données éclairage public') ?>">
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
            <p class="droite"><a href="/logout">Déconnexion</a> | <a href="/account">Mon compte</a></p>
        <?php endif; ?>
    </header>