<?php

require_once '../../../vendor/autoload.php';

use Src\Models\UserModel;
use Src\Models\Database;

// Connexion à la base de données
$pdo = Database::getConnection();

$userModel = new UserModel($pdo);

// Données de test
$username = "usernameTest2";
$email = "usernameTest2@example.com";
$password = password_hash("12345678910", PASSWORD_DEFAULT);

// Exécution du test
$userId = $userModel->createUser($username, $email, $password);

if ($userId) {
    echo "Utilisateur créé avec succès ! ID : $userId";
} else {
    echo "Erreur lors de la création de l'utilisateur.";
}
