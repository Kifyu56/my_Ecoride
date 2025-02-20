<!-- Formulaire Connexion -->
<form id="login" action="auth/login.php" method="POST">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <button type="submit" class="btn btn-primary">Se connecter</button>

    <p>Pas encore de compte ? <a href="#" data-open-modal="register">S'inscrire</a></p>
</form>