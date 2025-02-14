<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

class ReportModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Récupère tous les signalements faits par un utilisateur donné
     */
    public function getReportsByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM reports WHERE reporter_id = :userId");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Récupère tous les signalements concernant un trajet donné
     */
    public function getReportsByTripId(int $tripId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM reports WHERE trip_id = :tripId");
        $stmt->execute(['tripId' => $tripId]);
        return $stmt->fetchAll();
    }
}
