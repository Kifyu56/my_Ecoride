<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload de Composer

use Src\Models\ModerationModel;

$moderationModel = new ModerationModel();

// Test : récupérer les signalements en attente
$pendingReports = $moderationModel->getPendingReports();
echo "Signalements en attente : " . json_encode($pendingReports) . "\n";

// Test : mettre à jour un signalement
$updateStatus = $moderationModel->updateReportStatus(2, 'resolved');
echo $updateStatus ? "Signalement 1 mis à jour en 'resolved'." : "Erreur de mise à jour.";
