<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload de Composer

use Src\Models\ReportModel;

$reportModel = new ReportModel();

// Test des signalements faits par un utilisateur donné existant
$userReports = $reportModel->getReportsByUserId(1);
echo "Signalements de l'utilisateur 1 : " . json_encode($userReports) . "\n";

// Test des signalements faits par un utilisateur donné pas existant
$userReports = $reportModel->getReportsByUserId(2);
echo "Signalements de l'utilisateur 2 : " . json_encode($userReports) . "\n";

// Test des signalements concernant un trajet donné existant
$tripReports = $reportModel->getReportsByTripId(3);
echo "Signalements du trajet 3 : " . json_encode($tripReports) . "\n";

// Test des signalements concernant un trajet donné pas existant
$tripReports = $reportModel->getReportsByTripId(2);
echo "Signalements du trajet 2 : " . json_encode($tripReports) . "\n";

