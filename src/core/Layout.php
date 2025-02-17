<?php

namespace Src\Core;

/**
 * Classe Layout pour gérer l'affichage du contenu dans la structure HTML principale.
 */
class Layout
{
    public static function render(string $content): void
    {
        require_once __DIR__ . '/../Views/includes/layout.php';
    }
}
