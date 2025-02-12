<?php

/**
 * Outil interactif pour générer une liste de mots de passe hachés avec password_hash()
 * Interface web permettant de saisir plusieurs mots de passe et voir leurs hash.
 * Possibilité de télécharger un fichier contenant les hash générés.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["passwords"])) {
    $passwords = explode("\n", trim($_POST["passwords"]));
    $hashes = [];

    foreach ($passwords as $password) {
        $password = trim($password);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $hashes[] = "Mot de passe : $password";
        $hashes[] = "Hash : $hashedPassword";
        $hashes[] = ""; // Ligne vide pour séparer
    }

    if (isset($_POST["download"])) {
        $filename = "passwords_hashed.txt";
        header("Content-Type: text/plain");
        header("Content-Disposition: attachment; filename=$filename");
        echo implode("\n", $hashes);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de mots de passe hachés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: auto;
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        textarea {
            margin: 10px 0;
            padding: 8px;
            font-size: 16px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:first-of-type {
            background: #007bff;
            color: white;
        }

        button:last-of-type {
            background: #28a745;
            color: white;
        }

        pre {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            text-align: left;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Générateur de mots de passe hachés</h2>
        <form method="POST">
            <textarea name="passwords" rows="5" placeholder="Entrez un mot de passe par ligne" required></textarea>
            <button type="submit">Générer</button>
            <button type="submit" name="download">Télécharger</button>
        </form>

        <?php if (!empty($hashes)): ?>
            <h3>Résultats :</h3>
            <pre><?php echo implode("\n", $hashes); ?></pre>
        <?php endif; ?>
    </div>
</body>

</html>