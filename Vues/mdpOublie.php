<h1>Inscription</h1>
<form action="/inscription" method="post">
    <p>
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required>
    </p>
    <p>
        <label for="email">Adresse e-mail</label>
        <input type="email" id="email" name="email" required>
    </p>
    <p>
        <label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="mdp" required minlength="8">
    </p>
    <p>
        <label for="mdp2">Confirmer le mot de passe</label>
        <input type="password" id="mdp2" name="mdp2" required>
    </p>
    <p><button type="submit">S'inscrire</button></p>
</form>