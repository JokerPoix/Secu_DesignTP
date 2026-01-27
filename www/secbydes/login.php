<?php
session_start();

$mysqli = new mysqli("db", "root", "root", "secbydes");
if ($mysqli->connect_error) {
    die("Erreur connexion MySQL : " . $mysqli->connect_error);
}

if (isset($_GET['login']) && isset($_GET['password'])) {
    $password_hash = '*' . strtoupper(sha1(hex2bin(sha1($_GET['password']))));

    $stmt = $mysqli->prepare('SELECT * FROM users WHERE login = ? AND password = ?');
    $stmt->bind_param("ss", $_GET['login'], $password_hash);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $_SESSION['login'] = $_GET['login'];
        header("Location: board.php");
        exit;
    } else {
        $error = "Authentification échouée";
    }
    $stmt->close();
}

$mysqli->close();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
</head>
<body>
<h1>Connexion</h1>

<?php
if (isset($error)) {
    echo $error . "<br><br>";
}
?>

<form method="get" action="login.php">
    <label>Identifiant :</label>
    <input type="text" name="login" required>
    <br><br>

    <label>Mot de passe :</label>
    <input type="password" name="password" required>
    <br><br>

    <button type="submit">Se connecter</button>
</form>

</body>
</html>