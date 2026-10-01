<section class="authentification">
	<h2>Connexion</h2>

	<form action="index.php?url=authentification" method="post">
		<label for="identifiant">Identifiant</label>
		<input type="text" id="identifiant" name="identifiant" required>

		<label for="mdp">Mot de passe</label>
		<input type="password" id="mdp" name="mdp" required>

		<button type="submit">Se connecter</button>
	</form>

	<p>
		<a href="index.php?url=mdpOublie">Mot de passe oublié ?</a><br>
		<a href="index.php?url=inscription">Pas encore de compte ? Inscrivez-vous</a>
	</p>
</section>