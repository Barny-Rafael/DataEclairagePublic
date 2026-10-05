<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?= htmlspecialchars($description ?? 'Site de consultation et gestion de données éclairage public') ?>">
    <title><?= htmlspecialchars($titre) ?></title>
</head>
<body>
    <nav>
        <a href="/">Accueil</a>
        <?php if (!isset($utilisateur)): ?>
            | <a href="/login">Connexion</a>
            | <a href="/register">Inscription</a>
        <?php else: ?>
            | <a href="/logout">Déconnexion</a>
        <?php endif; ?>
    </nav>