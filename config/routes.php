<?php

use Src\Core\Router;

// Création d'une instance du routeur
$router = new Router();

/**
 * Définition des routes de l'application
 *
 * Chaque route est associée à un contrôleur et une méthode.
 */

// Définition des routes
$router->add('', 'HomeController');
$router->add('home', 'HomeController');
$router->add('about', 'AboutController');

return $router;
