<?php
// ... HTML propre à la page ...
require '../views/partials/header.php';
?>
<main>
    <h1>Mon compte</h1>

    <p>Bonjour <strong><?= htmlspecialchars($utilisateur['email']) ?></strong>.</p>
    <p><a href="/logout">Se déconnecter</a></p>
    <p><a href="/forgot">Changer de mot de passe</a></p>
    <p><a href="/verification">Supprimer mon compte</a><p>
</main>
<?php require '../views/partials/footer.php'; ?>