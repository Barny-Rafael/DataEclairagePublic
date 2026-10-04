<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $titre ?? 'Data Éclairage Public' ?></title>
</head>
<body>

<?php
// On recupere la page actuelle
$pageActuelle = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// On cree la liste des liens du menu
$menu = [
        '/' => 'Accueil'
];

if (isset($_SESSION['user'])) {
    $menu['/logout'] = 'Déconnexion';
} else {
    $menu['/register'] = 'Inscription';
    $menu['/login']    = 'Connexion';
}
?>

<header>
    <nav>
        <details>
            <summary>Menu</summary>
            <ul>
                <?php foreach ($menu as $url => $nom): ?>
                    <?php if ($url !== $pageActuelle): ?>
                        <li><a href="<?= $url ?>"><?= $nom ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </details>
    </nav>
</header>