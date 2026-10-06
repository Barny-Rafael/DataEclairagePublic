<?php
// ... HTML propre à la page ...
require '../views/partials/header.php';
?>
    <h1><?= htmlspecialchars($titre) ?></h1>

    <?php if ($erreur !== null): ?>
        <p><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="post" action="/verification">
        <p>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
        </p>
        <button type="submit">Supprimer son compte</button>
    </form>

<?php require '../views/partials/footer.php'; ?>