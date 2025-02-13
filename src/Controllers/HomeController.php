<?php

namespace Src\Controllers;

/**
 * Contrôleur de la page d'accueil.
 */
class HomeController
{
    /**
     * Méthode appelée lorsqu'on visite "/"
     */
    public function index()
    {
        $title = "Accueil"; // Titre de la page
        $page = "home"; // Nom de la page à charger
        require_once __DIR__ . "/../Views/includes/layout.php";
    }
}
