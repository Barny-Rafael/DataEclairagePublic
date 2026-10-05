<?php
// ... HTML propre à la page ...
?>
    <h1>Bienvenue</h1>

    <?php if (isset($utilisateur)): ?>
        <p>Bonjour <strong><?= htmlspecialchars($utilisateur['email']) ?></strong>, vous êtes connecté.</p>
    <?php else: ?>
        <p>Vous n'êtes pas connecté. <a href="/login">Connectez-vous</a> ou <a href="/register">créez un compte</a>.</p>
    <?php endif; ?>

