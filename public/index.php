<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php'; // Charge toutes les classes
require_once __DIR__ . '/../config/database.php'; // Connexion BDD
$router = require_once __DIR__ . '/../config/routes.php'; // Récupère le routeur avec ses routes

// Récupérer l'URL demandée et l'envoyer au routeur
$uri = $_GET['page'] ?? '';
$router->dispatch($uri);
