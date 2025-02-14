<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

class UserModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Récupère un utilisateur par son ID
     */
    public function getUserById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
