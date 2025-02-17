<?php

namespace Src\Controllers;

class Error404Controller
{
    public function notFound()
    {
        http_response_code(404); // ✅ Définit bien le code HTTP 404
        ob_start();
        require_once __DIR__ . '/../Views/pages/404.php';
        return ob_get_clean();
    }
}
