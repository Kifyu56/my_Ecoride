<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Src\Models\MessageModel;

$messageModel = new MessageModel();

// Test : récupérer tous les messages
$allMessages = $messageModel->getAllMessages();
echo "Tous les messages : " . json_encode($allMessages) . "\n";

// Test : récupérer un message précis (changer l'ID si nécessaire)
$message = $messageModel->getMessageById(1);
echo $message ? "Message ID 1 : " . json_encode($message) : "Aucun message trouvé avec cet ID.";

// Test : ajouter un nouveau message
$addMessage = $messageModel->addMessage("test@example.com", "Problème sur un trajet", "J'ai eu un souci avec un conducteur.");
echo $addMessage ? "Message ajouté avec succès." : "Erreur lors de l'ajout du message.";
