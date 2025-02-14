<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

class TripModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Récupère un trajet par son ID
     */
    public function getTripById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM trips WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
