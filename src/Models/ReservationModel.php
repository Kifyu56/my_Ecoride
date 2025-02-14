<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

class ReservationModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Récupère les réservations d'un passager par son ID utilisateur
     */
    public function getReservationsByPassengerId(int $passengerId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM reservations WHERE passenger_id = :passengerId");
        $stmt->execute(['passengerId' => $passengerId]);
        return $stmt->fetchAll();
    }

    /**
     * Récupère les réservations pour un trajet donné
     */
    public function getReservationsByTripId(int $tripId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM reservations WHERE trip_id = :tripId");
        $stmt->execute(['tripId' => $tripId]);
        return $stmt->fetchAll();
    }
}
