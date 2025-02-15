<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload de Composer

use Src\Models\InvitationModel;

$invitationModel = new InvitationModel();

// Test : récupérer toutes les invitations
$allInvitations = $invitationModel->getAllInvitations();
echo "Toutes les invitations : " . json_encode($allInvitations);

// Test : ajouter une nouvelle invitation
$token = bin2hex(random_bytes(16)); // Générer un token aléatoire
$addInvitation = $invitationModel->addInvitation("invite@example.com", "user", $token);
echo $addInvitation ? "Invitation ajoutée avec succès." : "Erreur lors de l'ajout de l'invitation.";

// Test : récupérer une invitation par token
$invitation = $invitationModel->getInvitationByToken($token);
echo $invitation ? "Invitation trouvée : " . json_encode($invitation) . "" : "Aucune invitation trouvée.";

// Test : supprimer une invitation
$deleteInvitation = $invitationModel->deleteInvitation($token);
echo $deleteInvitation ? "Invitation supprimée avec succès." : "Erreur lors de la suppression de l'invitation.";
