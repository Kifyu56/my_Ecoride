<?php

namespace Src\Models;

use PDO;
use PDOException;

require_once __DIR__ . '/../../config/database.php';

/**
 * Classe Database
 * Gère la connexion à la base de données en singleton.
 */
class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            try {
                $dbConfig = getDatabaseConfig();

                self::$pdo = new PDO(
                    $dbConfig['dsn'],
                    $dbConfig['user'],
                    $dbConfig['password'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
