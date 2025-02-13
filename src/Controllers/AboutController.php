<?php

namespace Src\Controllers;

/**
 * Contrôleur de la page "À propos".
 */

class AboutController
{
    /**
     * Méthode appelée lorsqu'on visite "/about"
     */
    public function index()
    {
        $title = "À propos"; // Titre de la page
        $page = "about"; // Nom de la page à charger
        require_once __DIR__ . "/../Views/includes/layout.php";
    }
}
