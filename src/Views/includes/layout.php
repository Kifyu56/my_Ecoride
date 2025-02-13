<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once __DIR__ . "/head.php"; ?>
</head>

<body>

    <header>
        <?php require_once __DIR__ . "/header.php"; ?>
    </header>

    <main>
        <?php require_once __DIR__ . "/../pages/{$page}.php"; ?>
    </main>

    <footer>
        <?php require_once __DIR__ . "/footer.php"; ?>
    </footer>

</body>

</html>