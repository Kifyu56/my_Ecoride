<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

class TripModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
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

    /**
     * Récupère tous les trajets disponibles
     */
    public function getAllTrips(): array
    {
        $stmt = $this->db->query("SELECT * FROM trips ORDER BY departure_date ASC");
        return $stmt->fetchAll();
    }

    /**
     * Recherche des trajets en fonction du départ, de l'arrivée et de la date
     */
    public function searchTrips(?string $departure, ?string $arrival, ?string $date): array
    {
        $query = "SELECT * FROM trips WHERE 1=1";
        $params = [];

        if (!empty($departure)) {
            $query .= " AND departure_city LIKE :departure";
            $params['departure'] = "%$departure%";
        }

        if (!empty($arrival)) {
            $query .= " AND arrival_city LIKE :arrival";
            $params['arrival'] = "%$arrival%";
        }

        if (!empty($date)) {
            $query .= " AND DATE(departure_date) = :date";
            $params['date'] = $date;
        }

        $query .= " ORDER BY departure_date ASC";

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
