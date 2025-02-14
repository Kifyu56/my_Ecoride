<?php

require_once __DIR__ . '/../../src/Models/Database.php';

use Src\Models\Database;

// Test de connexion
$db = Database::connect();
echo "Connexion réussie !";
