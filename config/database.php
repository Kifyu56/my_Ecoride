<?php

/**
 * Fichier de configuration de la base de données
 * - Charge le bon fichier .env en fonction de l'environnement (local ou prod)
 * - Retourne les paramètres de connexion sous forme de tableau
 */

require_once __DIR__ . '/../vendor/autoload.php'; // Charge l'autoload de Composer

// Détecter l'environnement et charger le bon fichier .env
$envFile = file_exists(__DIR__ . '/../.env_local') ? '.env_local' : '.env_prod';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', $envFile);
$dotenv->load();

/**
 * Retourne les paramètres de connexion à la base de données
 */
function getDatabaseConfig(): array
{
    return [
        'dsn' => "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4",
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
        'app_env' => $_ENV['APP_ENV'] ?? 'unknown'
    ];
}
