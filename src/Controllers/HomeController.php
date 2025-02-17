<?php

namespace Src\Controllers;

/**
 * Contrôleur de la page "Accueil".
 */

class HomeController
{
    /**
     * Méthode appelée lorsqu'on visite "/" ou "/home"
     */
    public function index()
    {
        ob_start();
        require_once __DIR__ . '/../Views/pages/home.php';
        return ob_get_clean();
    }
}
