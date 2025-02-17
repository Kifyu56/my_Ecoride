<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;
use Src\Helpers\TokenGenerator;

/**
 * Class InvitationModel
 * Gère les invitations des utilisateurs avant leur activation.
 */
class InvitationModel
{
    private PDO $db;

    /**
     * Initialise la connexion à la base de données.
     */
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Vérifie si une invitation existe déjà pour cet email.
     * 
     * @param string $email L'email à vérifier.
     * @return bool True si une invitation existe déjà pour cet email.
     */
    public function invitationExists(string $email): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM invitations WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Ajoute une nouvelle invitation pour un employé.
     * 
     * @param string $email L'email de l'employé.
     * @param string $role Le rôle de l'employé.
     * @param string $token Le token d'invitation.
     * @return bool True si l'invitation a été ajoutée avec succès.
     */
    public function addInvitation(string $email, string $role, string $token): bool
    {
        $stmt = $this->db->prepare("INSERT INTO invitations (email, role, token, created_at) VALUES (:email, :role, :token, NOW())");
        return $stmt->execute([
            'email' => $email,
            'role' => $role,
            'token' => $token
        ]);
    }

    /**
     * Génère une invitation pour un nouvel utilisateur.
     *
     * @param int $userId L'ID de l'utilisateur.
     * @return string|null Le token généré ou null en cas d'erreur.
     */
    public function createInvitation(int $userId): ?string
    {
        $token = TokenGenerator::generate();

        $query = "INSERT INTO invitations (user_id, token, created_at) VALUES (:user_id, :token, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $token;
        }
        return null;
    }

    /**
     * Récupère toutes les invitations
     */
    public function getAllInvitations(): array
    {
        $stmt = $this->db->query("SELECT * FROM invitations ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Vérifie et récupère une invitation par son token.
     *
     * @param string $token Le token d'invitation.
     * @return array|null Les données de l'invitation ou null si inexistante.
     */
    public function getInvitationByToken(string $token): ?array
    {
        $query = "SELECT * FROM invitations WHERE token = :token";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Supprime une invitation après utilisation
     */
    public function deleteInvitation(string $token): bool
    {
        $stmt = $this->db->prepare("DELETE FROM invitations WHERE token = :token");
        return $stmt->execute(['token' => $token]);
    }
}
