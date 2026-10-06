<?php require '../views/partials/header.php'; ?>
<main>
	<h1><?= htmlspecialchars($titre) ?></h1>

<?php if (!empty($erreur)): ?>
	<p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<?php if (!empty($message)): ?>
	<p class="succes"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

	<form method="post" action="/forgot">
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
		</p>
		<button type="submit">Envoyer le lien</button>
	</form>
</main>
<?php require '../views/partials/footer.php'; ?>