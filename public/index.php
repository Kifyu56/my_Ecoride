<?php

// Chargement automatique des classes avec Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Récupération du routeur depuis le fichier de configuration
$router = require_once __DIR__ . '/../config/routes.php';

// Dispatcher les routes : analyse l'URL et redirige vers le bon contrôleur
$router->dispatch($_SERVER['REQUEST_URI']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>