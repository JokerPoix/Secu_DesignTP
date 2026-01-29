<?php
    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }

    $mysqli = new mysqli("db", "root", "root", "secbydes");
    if ($mysqli->connect_error) {
        die("Erreur connexion MySQL : " . $mysqli->connect_error);
    }

    $result = $mysqli->query("SELECT id, title FROM news");
    if (!$result) {
        die("Erreur SQL: " . $mysqli->error);
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>News board</title>
    </head>
    <body>

    <p>Connecté en tant que : <?php echo $_SESSION['login']; ?></p>

    <fieldset style="width: 450px;">
        <legend>News board</legend>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <a href="news.php?id=<?php echo $row['id']; ?>">
                <?php echo htmlspecialchars($row['title']); ?>
            </a>
            <br>
        <?php endwhile; ?>

    </fieldset>

    </body>
</html>
<?php
$mysqli->close();
?>
