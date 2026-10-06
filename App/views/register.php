<?php
// ... HTML propre à la page ...
require '../views/partials/header.php';
?>    
<main> 
    <h1>Inscription</h1>

    <?php if ($succes): ?>
        <p>Votre compte a été créé. <a href="/login">Connectez-vous</a>.</p>
    <?php else: ?>
        <?php if (!empty($erreurs)): ?>
            <ul>
                <?php foreach ($erreurs as $erreur): ?>
                    <li><?= htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post" action="/register">
            <p>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </p>
            <p>
                <label for="password">Mot de passe</label><br>
                <input type="password" id="password" name="password" required>
            </p>
            <p>
                <label for="confirmation">Confirmation du mot de passe</label><br>
                <input type="password" id="confirmation" name="confirmation" required>
            </p>
            <p>
                <p>
                <label for="terms">J'accepte les <a href="/terms">conditions générales d'utilisation</a></label><br>
                <input type="checkbox" id="terms" name="terms" required>
            </p>
            </p>
            <button type="submit">S'inscrire</button>
        </form>
    <?php endif; ?>
</main>
<?php require '../views/partials/footer.php'; ?>