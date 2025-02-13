<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

use Src\Core\Router;

// Récupération du routeur
$router = require_once __DIR__ . '/../config/routes.php';

// Récupérer l'URL proprement
$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Exécution du routeur
$router->dispatch($url);
