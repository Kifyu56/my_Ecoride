<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Src\Models\UserModel;

// Initialisation du modèle utilisateur
$userModel = new UserModel();

// Test : récupérer un utilisateur avec ID 1
$user = $userModel->getUserById(1);

if ($user) {
    echo "Utilisateur trouvé : " . json_encode($user);
} else {
    echo "Aucun utilisateur trouvé avec cet ID.";
}
