<!-- Formulaire Connexion -->
<form action="auth/login.php" method="POST">
    <label for="login-username">Nom d'utilisateur</label>
    <input type="text" id="login-username" name="username" required>

    <label for="login-password">Mot de passe :</label>
    <input type="password" id="login-password" name="password" required>

    <button type="submit" class="btn btn-primary">Se connecter</button>

    <p>Pas encore de compte ? <a href="#" data-open-modal="register">S'inscrire</a></p>
</form>