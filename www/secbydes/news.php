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

if (!isset($_GET['id'])) {
    die("ID manquant");
}

$sql = 'SELECT title, content FROM news WHERE id=' . $_GET['id'];
$result = $mysqli->query($sql);
if (!$result) {
    die("Erreur SQL: " . $mysqli->error);
}

$row = $result->fetch_assoc();
if (!$row) {
    die("News introuvable");
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($row['title']); ?></title>
</head>
<body>

<a href="board.php">Back to board</a>

<fieldset style="width: 450px; margin-top: 10px;">
    <legend><?php echo htmlspecialchars($row['title']); ?></legend>
    <div>
        <?php echo nl2br(htmlspecialchars($row['content'])); ?>
    </div>
</fieldset>

</body>
</html>
<?php
$mysqli->close();
?>
