<form action="data-processing.php" method="post">

	<label for="Id">Saisir votre identifiant:</label>
	<input type="text" id="Id" name="Id" required size="10"><br><br>

	<label>Sélectionner votre civilité:</label>
	<input type="radio" id="SxM" name="Sx" value="M"><label for="SxM">M</label>
	<input type="radio" id="SxF" name="Sx" value="F"><label for="SxF">F</label>
	<input type="radio" id="SxNR" name="Sx" value="NR"><label for="SxNR">NR</label><br><br>

	<label for="EMail">Saisir votre e-mail:</label>
	<input type="email" id="EMail" name="EMail" size="10"><br><br>

	<label for="Psd">Saisir votre mot de passe:</label>
	<input type="password" id="Psd" name="Psd" size="10"><br><br>

	<label for="PsdC">Confirmer votre mot de passe:</label>
	<input type="password" id="PsdC" name="PsdC" size="10"><br><br>

	<label for="Tel">Saisir votre téléphone:</label>
	<input type="text" id="Tel" name="Tel" size="10"><br><br>

	<label for="Pays">Saisir votre pays:</label>
	<select id="Pays" name="Pays">
		<option value="">--Veuillez choisir une option--</option>
		<option value="France">France</option>
		<option value="Espagne">Espagne</option>
		<option value="Italie">Italie</option>
		<option value="Allemagne">Allemagne</option>
	</select><br><br>

	<label for="CDG">J'accepte les Conditions générales :</label>
	<input type="checkbox" id="CDG" name="CDG" value="1"><br><br>

	<input type="submit" id="action" name="action" value="mailer">
</form>

<?php Vue::montrer('standard/pied'); ?>
</body>
</html>