<?php

namespace Src\Controllers;

use Src\Models\InvitationModel;
use Src\Helpers\TokenGenerator;

/**
 * Class InvitationController
 * Gère l'envoi et la validation des invitations.
 */
class InvitationController
{
    private InvitationModel $invitationModel;

    /**
     * Initialise le modèle des invitations.
     */
    public function __construct()
    {
        $this->invitationModel = new InvitationModel();
    }

    /**
     * Envoie une invitation à un employé.
     *
     * @param string $email Email du futur employé.
     * @return void
     */
    public function sendInvitation(string $email): void
    {
        // Vérification de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email invalide.";
            return;
        }

        // Vérification si une invitation existe déjà
        if ($this->invitationModel->invitationExists($email)) {
            echo "Une invitation pour cet email existe déjà.";
            return;
        }

        // Génération du token et ajout de l'invitation
        $token = TokenGenerator::generate();
        if ($this->invitationModel->addInvitation($email, "employed", $token)) {
            $this->sendInvitationEmail($email, $token);
            echo "Invitation envoyée avec succès !";
        } else {
            echo "Erreur lors de l'envoi de l'invitation.";
        }
    }

    /**
     * Envoie un email avec le lien d'invitation.
     *
     * @param string $email Email du futur employé.
     * @param string $token Token d'invitation.
     */
    private function sendInvitationEmail(string $email, string $token): void
    {
        $activationLink = "https://my_ecoride.kifyudevland.bzh/accept_invitation.php?token=" . $token;
        $subject = "Invitation à rejoindre EcoRide";
        $message = "Bonjour,\n\nVous avez été invité à rejoindre EcoRide en tant qu'employé.\nVeuillez cliquer sur le lien suivant pour accepter l'invitation :\n$activationLink\n\nMerci !";
        $headers = "From: no-reply@my_ecoride.kifyudevland.bzh";

        mail($email, $subject, $message, $headers);
    }
}
