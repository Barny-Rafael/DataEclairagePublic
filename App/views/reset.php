<?php require '../views/partials/header.php'; ?>
<main>
	<h1><?= htmlspecialchars($titre) ?></h1>

<?php if (!empty($erreur)): ?>
	<p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<?php if (!empty($token)): ?>
	<form method="post" action="/reset">
		<input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
		<p>
			<label for="password">Nouveau mot de passe</label><br>
			<input type="password" id="password" name="password" minlength="8" required>
		</p>
		<p>
			<label for="password_confirmation">Confirmation</label><br>
			<input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required>
		</p>
		<button type="submit">Changer le mot de passe</button>
	</form>
<?php endif; ?>
</main>
<?php require '../views/partials/footer.php'; ?>