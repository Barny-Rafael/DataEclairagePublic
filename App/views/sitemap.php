<?php
// ... HTML propre à la page ...
require '../views/partials/header.php';
?>
<main>
    <h1>Plan du site</h1>
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <?php if (!isset($utilisateur)): ?>
            <li><a href="/login">Connexion</a></li>
            <li><a href="/register">Inscription</a></li>
            <?php else: ?>
            <li><a href="/account">Mon compte</a></li>
            <?php endif; ?>
            <li><a href="/legal">Mentions légales</a></li>
            <li><a href="/terms">Conditions générales d'utilisation</a></li>
        </ul>
    </nav>
</main>
<?php require '../views/partials/footer.php'; ?>