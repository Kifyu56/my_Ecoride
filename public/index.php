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
</head>

<body>

    <header>
        <?php require_once __DIR__ . "/../src/Views/includes/header.php"; ?>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <?php require_once __DIR__ . "/../src/Views/includes/footer.php"; ?>
    </footer>

</body>

</html>