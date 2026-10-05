
<main>
    <h1>Erreur interne du serveur (500)</h1>
    <p>Un problème est survenu sur le serveur. Veuillez réessayer plus tard.</p>
    <?php if (!empty($erreur)): ?>
        <p><small style="color: gray;">Détail : <?= htmlspecialchars($erreur) ?></small></p>
    <?php endif; ?>
    <p><a href="/">Retourner à l'accueil</a></p>
</main>