<link rel="stylesheet" href="assets/css/ecoCarpooling.css">

<!-- Bannière principale -->
<section class="section-card">
    <div class="banner">
        <h1 class="title-banner">Éco-voiturage</h1>
        <p class="content-banner">Trouvez ou proposez un trajet pour voyager autrement.</p>
    </div>
</section>

<!-- 🔍 Formulaire de recherche de trajets -->
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

<!-- 🛣️ Affichage des trajets disponibles -->
<section class="section-card">
    <div class="available-trips">
        <h2 class="title-trips">Trajets disponibles</h2>
        <div class="trip-list">
            <?php
            // Simulation des trajets (à remplacer par des données dynamiques via la BDD)
            $trips = [
                ["Départ" => "Paris", "Arrivée" => "Lyon", "Date" => "2025-03-01", "Prix" => "20€"],
                ["Départ" => "Marseille", "Arrivée" => "Toulouse", "Date" => "2025-03-02", "Prix" => "15€"],
                ["Départ" => "Lille", "Arrivée" => "Bordeaux", "Date" => "2025-03-03", "Prix" => "25€"]
            ];

            foreach ($trips as $trip) {
                echo "<div class='trip-card'>
                        <p><strong>Départ :</strong> {$trip['Départ']}</p>
                        <p><strong>Arrivée :</strong> {$trip['Arrivée']}</p>
                        <p><strong>Date :</strong> {$trip['Date']}</p>
                        <p><strong>Prix :</strong> {$trip['Prix']}</p>
                        <button class='btn-reserve'>Réserver</button>
                      </div>";
            }
            ?>
        </div>
    </div>
</section>

<!-- 🚗 Proposer un trajet (visible si connecté) -->
<?php if (isset($_SESSION['user_id'])): ?>
    <section class="section-card">
        <div class="propose-trip">
            <h2 class="title-propose">Proposer un trajet</h2>
            <p>Partagez votre trajet et trouvez des passagers.</p>
            <a href="proposer-trajet.php" class="btn btn-primary">Ajouter un trajet</a>
        </div>
    </section>
<?php endif; ?>