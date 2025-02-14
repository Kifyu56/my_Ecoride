<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

class ModerationModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Récupère tous les signalements en attente de modération
     */
    public function getPendingReports(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM reports WHERE status = 'pending'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Met à jour le statut d'un signalement
     */
    public function updateReportStatus(int $reportId, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE reports SET status = :status WHERE id = :reportId");
        return $stmt->execute(['status' => $status, 'reportId' => $reportId]);
    }
}
