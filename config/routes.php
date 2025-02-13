<?php

use Src\Core\Router;

// Création d'une instance du routeur
$router = new Router();

/**
 * Définition des routes de l'application
 *
 * Chaque route est associée à un contrôleur et une méthode.
 */
$router->add('home', 'HomeController');  // Route pour la page d'accueil
$router->add('about', 'AboutController');  // Route pour la page "À propos"

return $router;
