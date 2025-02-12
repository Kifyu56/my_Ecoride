<?php

/**
 * Fichier de connexion à la base de données
 * - Charge le bon fichier .env en fonction de l'environnement (local ou prod)
 * - Établit une connexion sécurisée avec PDO
 * - Affiche un message en cas de succès ou d'erreur
 */

require_once __DIR__ . '/../vendor/autoload.php'; // Charge l'autoload de Composer

// Détecter l'environnement et charger le bon fichier .env
$envFile = file_exists(__DIR__ . '/../.env_local') ? '.env_local' : '.env_prod';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', $envFile);
$dotenv->load();

try {
    // Création de la connexion PDO avec les variables d'environnement
    $pdo = new PDO(
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4",
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active le mode exception pour afficher les erreurs SQL
    echo "Connexion réussie à la base de données ({$_ENV['APP_ENV']}).";
} catch (PDOException $e) {
    // En cas d'échec, affiche un message d'erreur
    die("Erreur de connexion ({$_ENV['APP_ENV']}) : " . $e->getMessage());
}
