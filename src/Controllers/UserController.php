<?php

namespace Src\Controllers;

use Src\Models\UserModel;


/**
 * Class UserController
 * Gère l'inscription, la connexion et la déconnexion des utilisateurs.
 */
class UserController
{
    private UserModel $userModel;

    /**
     * Initialise le modèle utilisateur.
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Inscription d'un nouvel utilisateur.
     *
     * @return void
     */
    public function register(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"] ?? null;
            $email = $_POST["email"] ?? null;
            $password = $_POST["password"] ?? null;

            if (!$username || !$email || !$password) {
                echo "Tous les champs sont requis.";
                return;
            }

            // Vérifier si l'utilisateur existe déjà (par email ou username)
            if ($this->userModel->emailOrUsernameExists($email, $username)) {
                echo "Un compte avec cet email ou pseudo existe déjà.";
                return;
            }

            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Récupérer l'adresse IP et l'agent utilisateur
            $ip_address = $_SERVER['REMOTE_ADDR'] ?? null;
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;

            // Enregistrement de l'utilisateur
            $userId = $this->userModel->createUser($username, $email, $hashedPassword, $ip_address, $user_agent);

            if ($userId) {
                echo "Inscription réussie !";
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }

    /**
     * Connexion d'un utilisateur.
     *
     * @return void
     */
    public function login(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"] ?? null;
            $password = $_POST["password"] ?? null;

            if (!$username || !$password) {
                echo "Pseudo et mot de passe requis.";
                return;
            }

            // Récupérer les informations d'authentification
            $authData = $this->userModel->getAuthenticationByUsername($username);

            if (!$authData || !password_verify($password, $authData["password_hash"])) {
                echo "Identifiants incorrects.";
                return;
            }

            // Mettre à jour la dernière connexion
            $this->userModel->updateLastLogin($authData["user_id"]);

            // Démarrer une session et stocker l'utilisateur connecté
            session_start();
            $_SESSION["user_id"] = $authData["user_id"];
            $_SESSION["username"] = $authData["username"];

            echo "Connexion réussie !";
        }
    }

    /**
     * Déconnexion de l'utilisateur.
     *
     * @return void
     */
    public function logout(): void
    {
        session_start();
        session_destroy();
        echo "Déconnexion réussie.";
    }
}
