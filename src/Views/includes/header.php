<link rel="stylesheet" href="assets/css/header.css">

<div class="header-content">

    <!-- Logo Ecoride -->
    <img src="assets/images/header/logoEcoride.webp" alt="Logo EcoRide" class="logo">

    <!-- Bouton Connexion/Déconnexion -->
    <div class="auth-button" id="auth-button">
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Si connecté, afficher le bouton de déconnexion -->
            <a href="#" data-open-modal="logout">
                <i class="fas fa-sign-out-alt"></i> Se déconnecter
            </a>
        <?php else: ?>
            <!-- Si non connecté, afficher le bouton de connexion -->
            <a href="#" data-open-modal="login">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </a>
        <?php endif; ?>
    </div>

    <!-- barNav -->
    <nav class="nav-icons">
        <ul>
            <li><a href="home"><i class="fas fa-home"></i></a></li>
            <li><a href="ecoCarpooling"><i class="fas fa-car"></i></a></li>
            <li><a href="contact"><i class="fas fa-envelope"></i></a></li>
            <li><a href="about"><i class="fas fa-info-circle"></i></a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="reservations.php"><i class="fas fa-calendar-check"></i></a></li>
                <li><a href="profil.php"><i class="fas fa-user"></i></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>