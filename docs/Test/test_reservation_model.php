<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload de Composer

use Src\Models\ReservationModel;

$reservationModel = new ReservationModel();

// Test des réservations pour un passager donné
$passengerReservations = $reservationModel->getReservationsByPassengerId(1);
echo "Réservations du passager 1 : " . json_encode($passengerReservations) . "\n";

// Test des réservations pour un trajet donné
$tripReservations = $reservationModel->getReservationsByTripId(1);
echo "Réservations du trajet 1 : " . json_encode($tripReservations) . "\n";
