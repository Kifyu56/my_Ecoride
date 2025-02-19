<link rel="stylesheet" href="assets/css/home.css">

<!-- Bannière principale -->
<section class="section-card">
    <div class="banner">
        <h1 class="title-banner">Accueil</h1>
        <p class="content-banner">Voyageons ensemble pour un futur plus vert</p>
    </div>
</section>

<!-- 🔍 Recherche de trajet -->
<section class="section-card">
    <div class="search-trips">
        <h2 class="title-search">Rechercher un trajet</h2>
        <form action="ecoCarpooling" method="GET">
            <input type="text" name="departure" placeholder="Départ" required>
            <input type="text" name="arrival" placeholder="Arrivée" required>
            <input type="date" name="date">
            <button type="submit">Rechercher</button>
        </form>
    </div>
</section>

<!-- Section À propos -->
<section class="section-card">
    <div class="about-section">
        <h2 class="title-about">Pourquoi choisir EcoRide ?</h2>
        <p class="content-about">EcoRide est une plateforme dédiée à la mobilité durable, alliant économie et respect de l'environnement. Nous connectons les voyageurs pour réduire leur empreinte carbone.</p>
        <img src=" assets/images/home/illustration_about.webp" alt="Écologie et covoiturage">
    </div>
</section>

<!-- Section Avantages -->
<section class="section-card">
    <div class="advantages-section">
        <div class="advantage-card">
            <i class="fas fa-leaf"></i>
            <p>Partageons nos trajets pour diminuer notre empreinte carbone.</p>
        </div>
        <div class="advantage-card">
            <i class="fas fa-coins"></i>
            <p>Réduisons nos frais de transport en partageant les coûts.</p>
        </div>
        <div class="advantage-card">
            <i class="fas fa-users"></i>
            <p>Faisons des rencontres et voyageons dans une ambiance chaleureuse.</p>
        </div>
    </div>
</section>