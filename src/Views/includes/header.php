<link rel="stylesheet" href="assets/css/header.css">

<div class="header-content">

    <!-- Logo Ecoride -->
    <img src="assets/images/header/logoEcoride.webp" alt="Logo EcoRide" class="logo">

    <!-- Bouton Connexion/Déconnexion en haut à droite -->
    <div class="auth-button">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        <?php else: ?>
            <a href="login.php"><i class="fas fa-sign-in-alt"></i></a>
        <?php endif; ?>
    </div>

    <!-- barNav -->
    <nav class="nav-icons">
        <ul>
            <li><a href="home"><i class="fas fa-home"></i></a></li>
            <li><a href="covoiturages.php"><i class="fas fa-car"></i></a></li>
            <li><a href="contact"><i class="fas fa-envelope"></i></a></li>
            <li><a href="about"><i class="fas fa-info-circle"></i></a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="reservations.php"><i class="fas fa-calendar-check"></i></a></li>
                <li><a href="profil.php"><i class="fas fa-user"></i></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>