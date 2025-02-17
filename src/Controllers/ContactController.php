<?php

namespace Src\Controllers;

class ContactController
{
    public function index()
    {
        ob_start();
        require_once __DIR__ . '/../Views/pages/contact.php';
        return ob_get_clean();
    }
}
