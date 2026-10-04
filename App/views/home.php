<?php

require '../views/partials/header.php'; ?>

    <h1>Bienvenue</h1>

<?php if ($estConnecte ?? false): ?>
    <p>Vous êtes connecté.</p>
<?php else: ?>
    <p>Vous n'êtes pas connecté. <a href="/login">Connectez-vous</a> ou <a href="/register">créez un compte</a>.</p>
<?php endif; ?>

<?php require '../views/partials/footer.php'; ?>