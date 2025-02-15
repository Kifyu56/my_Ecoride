<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

class MessageModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère tous les messages
     */
    public function getAllMessages(): array
    {
        $stmt = $this->db->query("SELECT * FROM messages ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Récupère un message par son ID
     */
    public function getMessageById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Ajoute un nouveau message
     */
    public function addMessage(?string $email, string $subject, string $message): bool
    {
        $stmt = $this->db->prepare("INSERT INTO messages (email, subject, message, created_at) VALUES (:email, :subject, :message, NOW())");
        return $stmt->execute([
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]);
    }
}
