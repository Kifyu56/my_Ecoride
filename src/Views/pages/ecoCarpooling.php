<link rel="stylesheet" href="assets/css/ecoCarpooling.css">

<!-- Bannière principale -->
<section class="section-card">
    <div class="banner">
        <h1 class="title-banner">Éco-voiturage</h1>
        <p class="content-banner">Trouvez ou proposez un trajet pour voyager autrement.</p>
    </div>
</section>

<!-- Formulaire de recherche de trajets -->
<section class="section-card">
    <div class="search-trips">
        <h2 class="title-search">Rechercher un trajet</h2>
        <form action="ecoCarpooling" method="GET">
            <input type="text" name="departure" placeholder="Départ" value="<?= htmlspecialchars($_GET['departure'] ?? '') ?>" required>
            <input type="text" name="arrival" placeholder="Arrivée" value="<?= htmlspecialchars($_GET['arrival'] ?? '') ?>" required>
            <input type="date" name="date" value="<?= htmlspecialchars($_GET['date'] ?? '') ?>">
            <button type="submit">Rechercher</button>
        </form>
    </div>
</section>

<!-- Affichage des trajets disponibles -->
<section class="section-card">
    <div class="available-trips">
        <h2 class="title-trips">Trajets disponibles : </h2>
        <div class="trip-list">

            <!-- Données dynamiques des trajets via la BDD -->
            <?php if (!empty($trips)): ?>
                <?php foreach ($trips as $trip): ?>
                    <div class="trip-card">
                        <p><strong>Départ :</strong> <?= htmlspecialchars($trip['departure_city']) ?></p>
                        <p><strong>Arrivée :</strong> <?= htmlspecialchars($trip['arrival_city']) ?></p>
                        <p><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($trip['departure_date']))) ?></p>
                        <p><strong>Prix :</strong> <?= htmlspecialchars($trip['price']) ?>€</p>
                        <button class="btn-reserve">Réserver</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun trajet trouvé.
                    <br>Essayez de modifier vos critères de recherche (date ou lieu) pour trouver un trajet.
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Proposer un trajet -->

<section class="section-card">
    <div class="propose-trip">
        <h2 class="title-propose">Vous êtes conducteur ?</h2>
        <p>Proposez votre trajet ici :</p>
        <a href="proposer-trajet.php" class="btn btn-primary">Ajouter un trajet</a>
    </div>
</section>