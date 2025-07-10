<?php
session_start();
$host = 'localhost';
$dbname = 'bddAdminBoard';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Active les erreurs PDO en exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie !";
    // echo "<br>";
    // echo "salut";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    if (!isset($_SESSION['user'])) {
        echo '<form method="POST">
        <label>Identifiant</label>
        <input type="text" name="identifiant">
        <label>Password</label>
        <input type="password" name="password">
        <input type="submit" name="submitConnection" value="Se connecter">

    </form>';
    } else {
        echo '<form method="POST">
    <input type="submit" name="deconnexion" value="Deconnexion">
</form>';

        echo "Bonjour, " . $_SESSION['user']['nomUser'] . " " . $_SESSION['user']['prenomUser'] . ". Vous êtes connecté.";
    }

    ?>


    <?php
    if (isset($_POST['submitConnection']) && !empty($_POST['identifiant']) && !empty($_POST['password'])) {
        $id = $_POST['identifiant'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `users` WHERE adresseMailUser = '$id'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);



        if (isset($results[0]["passwordUser"])) {

            if ($password == $results[0]['passwordUser']) {
                $_SESSION['user'] = [
                    "idUser" => $results[0]['idUser'],
                    "nomUser" => $results[0]['nomUser'],
                    "prenomUser" => $results[0]['prenomUser'],
                    "ageUser" => $results[0]['ageUser'],
                    "adresseMailUser" => $results[0]['adresseMailUser']
                ];
                header("Location: logUser.php");
                include 'adminBoard.php';
            }
        } else {
            echo "mot de passe incorrect";
        }
    }

    if (isset($_POST['deconnexion'])) {
        session_destroy();
        header("Location: logUser.php");
    }
    ?>

</body>

</html>