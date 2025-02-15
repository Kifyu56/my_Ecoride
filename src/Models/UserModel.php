<?php

namespace Src\Models;

use PDO;
use Src\Models\Database;

/**
 * Class UserModel
 * Gère les interactions avec la table `users` en base de données.
 */
class UserModel
{
    private PDO $db;

    /**
     * initialise la connexion à la base de données.
     *
     * @param PDO $db Instance de la connexion PDO.
     */
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère un utilisateur par son ID
     */
    public function getUserById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Vérifie si un email ou un pseudo est déjà utilisé.
     *
     * @param string $email L'email à vérifier.
     * @param string $username Le pseudo à vérifier.
     * @return bool True si l'email ou le pseudo existe déjà.
     */
    public function emailOrUsernameExists(string $email, string $username): bool
    {
        $query = "SELECT COUNT(*) FROM authentication WHERE email = :email OR username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Récupère un utilisateur par son pseudo (username).
     *
     * @param string $username Le pseudo de l'utilisateur.
     * @return array|null Les données de l'utilisateur ou null si inexistant.
     */
    public function getUserByUsername(string $username): ?array
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    /**
     * Crée un utilisateur et enregistre ses identifiants.
     *
     * @param string $username Le pseudo.
     * @param string $email L'adresse email.
     * @param string $password Le mot de passe haché.
     * @param string|null $ip_address L'adresse IP de l'utilisateur (optionnel).
     * @param string|null $user_agent L'agent utilisateur du navigateur (optionnel).
     * @return int|null L'ID du nouvel utilisateur ou null en cas d'échec.
     */
    public function createUser(string $username, string $email, string $password, ?string $ip_address = null, ?string $user_agent = null): ?int
    {
        try {
            $this->db->beginTransaction();

            // Étape 1 : Insérer un nouvel utilisateur (ne contient que les infos générales)
            $queryUser = "INSERT INTO users (registration_date) VALUES (NOW())";
            $stmtUser = $this->db->prepare($queryUser);
            $stmtUser->execute();
            $userId = (int) $this->db->lastInsertId();

            // Étape 2 : Insérer les identifiants dans la table authentication
            $queryAuth = "INSERT INTO authentication (user_id, email, username, password_hash, ip_address, user_agent) 
                          VALUES (:user_id, :email, :username, :password, :ip_address, :user_agent)";
            $stmtAuth = $this->db->prepare($queryAuth);
            $stmtAuth->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmtAuth->bindParam(':email', $email, PDO::PARAM_STR);
            $stmtAuth->bindParam(':username', $username, PDO::PARAM_STR);
            $stmtAuth->bindParam(':password', $password, PDO::PARAM_STR);
            $stmtAuth->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
            $stmtAuth->bindParam(':user_agent', $user_agent, PDO::PARAM_STR);
            $stmtAuth->execute();

            $this->db->commit();
            return $userId;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return null;
        }
    }

    /**
     * Récupère les informations de connexion d'un utilisateur via son username.
     *
     * @param string $username Le pseudo.
     * @return array|null Les informations d'authentification ou null.
     */
    public function getAuthenticationByUsername(string $username): ?array
    {
        $query = "SELECT * FROM authentication WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Met à jour la date de dernière connexion d'un utilisateur.
     *
     * @param int $userId L'ID de l'utilisateur.
     * @return void
     */
    public function updateLastLogin(int $userId): void
    {
        $query = "UPDATE authentication SET last_login = NOW() WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }


}
