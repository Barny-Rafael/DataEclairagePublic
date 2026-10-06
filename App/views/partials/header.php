<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="/CSS/CSS_Basic_All_Pages.css">
</head>
<body>
    <header>
        <a href="/">Accueil</a>
        <?php if (!isset($utilisateur)): ?>
            | <a href="/login">Connexion</a>
            | <a href="/register">Inscription</a>
        <?php else: ?>
            | <a href="/logout">Déconnexion</a>
        <?php endif; ?>
    </header>