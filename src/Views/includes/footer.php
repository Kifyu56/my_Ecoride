<link rel="stylesheet" href="assets/css/footer.css">

<div class="footer-container">
    <!-- Section Contact + Réseaux Sociaux -->
    <div class="footer-top">
        <div class="contact-row">
            <a href="contact" class="contact-btn">Contact</a>
        </div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>

    <!-- Navigation Footer -->
    <div class="footer-nav">
        <ul class="footer-links">
            <li><a href="home"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="covoiturages.php"><i class="fas fa-car"></i> Éco-voiturage</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> À propos</a></li>
            <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
        </ul>

        <ul class="footer-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="reservations.php"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Mentions Légales -->
    <div class="footer-bottom">
        <a href="mentions-legales.php">Mentions légales</a> |
        <a href="confidentialite.php">Politiques de confidentialité</a>
    </div>
</div>
<p>&copy; 2025 EcoRide - Tous droits réservés.</p>