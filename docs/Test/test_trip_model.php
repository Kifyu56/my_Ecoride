<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Src\Models\TripModel;

$tripModel = new TripModel();
$trip = $tripModel->getTripById(1);

if ($trip) {
    echo "Trajet trouvé : " . json_encode($trip);
} else {
    echo "Aucun trajet trouvé avec cet ID.";
}
