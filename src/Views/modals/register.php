<!-- Formulaire Inscription -->
<form action="auth/register.php" method="POST">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Confirmer le mot de passe :</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <div class="checkbox-container">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">
            J'ai lu et accepte les <a href="terms.php">mentions légal</a> et la
            <a href="privacy.php">politique de confidentialité</a>.
        </label>
    </div>

    <button type="submit" class="btn btn-primary">S'inscrire</button>

    <p>Déjà un compte ? <a href="#" data-open-modal="login">Se connecter</a></p>
</form>