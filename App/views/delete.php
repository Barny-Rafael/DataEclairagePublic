<?php require '../views/partials/header.php'; ?>
<main>
	<h1><?= htmlspecialchars($titre) ?></h1>
<?php if ($succes): ?>
        <p>Votre compte a été supprimé. <a href="/register">Créez un compte</a>.</p>
<?php else: ?>
    <?php if ($erreur !== null): ?>
        <p><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <?php if (!empty($token)): ?>
        <form method="post" action="/delete">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <button type="submit">Supprimer mon compte</button>
        </form>
    <?php endif; ?>
<?php endif; ?>
</main>
<?php require '../views/partials/footer.php'; ?>