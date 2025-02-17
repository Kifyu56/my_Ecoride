<?php
session_start();

// Aller chercher l'autoload de Composer et la configuration
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

// Charger les routes
$router = require_once __DIR__ . '/../config/routes.php';

// Récupérer l'URL demandée et l'envoyer au routeur
$uri = $_GET['page'] ?? 'home';

// Dispatcher vers le bon contrôleur
$router->dispatch($uri);
