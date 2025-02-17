<?php

namespace Src\Helpers;

/**
 * Classe TokenGenerator
 * Gère la génération de tokens sécurisés.
 */
class TokenGenerator
{
    /**
     * Génère un token unique hexadécimal.
     *
     * @param int $length Longueur du token en octets (par défaut 32).
     * @return string Le token sécurisé généré.
     */
    public static function generate(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }
}
