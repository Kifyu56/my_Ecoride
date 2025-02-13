<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

use Src\Core\Router;

// Récupération de l'URL propre depuis .htaccess
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : 'home';

// Récupération du routeur
$router = require_once __DIR__ . '/../config/routes.php';

// Exécution du routeur
$router->dispatch($url);
