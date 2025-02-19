<?php
session_start();

// Chargement de l'autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Connexion à la base de données
require_once __DIR__ . '/../config/database.php';

// Chargement des routes
$router = require_once __DIR__ . '/../config/routes.php';

// Récupération de la page demandée
$uri = $_GET['page'] ?? 'home';

// Dispatcher vers le bon contrôleur
$content = $router->dispatch($uri);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once __DIR__ . "/../src/Views/includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

    <header class="header">
        <?php require_once __DIR__ . "/../src/Views/includes/header.php"; ?>
    </header>

    <main class="main">
        <?= $content ?>
    </main>

    <footer class="footer">
        <?php require_once __DIR__ . "/../src/Views/includes/footer.php"; ?>
    </footer>

    <?php include_once "../src/Views/modals/modals.php"; ?>
    <script src="assets/js/index.js"></script>

</body>

</html>