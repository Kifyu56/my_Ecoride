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
        ob_start();
        require_once __DIR__ . '/../Views/pages/about.php';
        return ob_get_clean();
    }
}
