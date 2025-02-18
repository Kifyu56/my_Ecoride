<?php

namespace Src\Controllers;

use Src\Models\TripModel;

class TripController
{
    private TripModel $tripModel;

    public function __construct()
    {
        $this->tripModel = new TripModel();
    }

    /**
     * Affiche tous les trajets ou effectue une recherche si des filtres sont appliqués
     */
    public function index()
    {
        $departure = $_GET['departure'] ?? null;
        $arrival = $_GET['arrival'] ?? null;
        $date = $_GET['date'] ?? null;

        if ($departure || $arrival || $date) {
            $trips = $this->tripModel->searchTrips($departure, $arrival, $date);
        } else {
            $trips = $this->tripModel->getAllTrips();
        }
        ob_start();
        require_once __DIR__ . '/../Views/pages/ecoCarpooling.php';
        return ob_get_clean();
    }
}
