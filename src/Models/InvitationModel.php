<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

class InvitationModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
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
     * Récupère une invitation par son token
     */
    public function getInvitationByToken(string $token): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM invitations WHERE token = :token");
        $stmt->execute(['token' => $token]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Ajoute une nouvelle invitation
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
     * Supprime une invitation après utilisation
     */
    public function deleteInvitation(string $token): bool
    {
        $stmt = $this->db->prepare("DELETE FROM invitations WHERE token = :token");
        return $stmt->execute(['token' => $token]);
    }
}
