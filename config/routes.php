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
$router->add('ecoCarpooling', 'TripController', 'index');
$router->add('about', 'AboutController');
$router->add('contact', 'ContactController');
$router->add('404', 'Error404Controller', 'notFound');


return $router;
