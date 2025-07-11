<?php

$sqlAll = "SELECT idUser,nomUser,prenomUser,ageUser,adresseMailUser FROM `users`";
$stmtAll = $pdo->prepare($sqlAll);
$stmtAll->execute();
$resultsAll = $stmtAll->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <hr>

    <?php
    foreach ($resultsAll as $key => $value) {
        $idModifier = $value['idUser'];
        foreach ($value as $key => $value2) {
            echo htmlspecialchars($key) . " : " . htmlspecialchars($value2);
            echo "<br>";
        }
        echo '<a href="?id=' . $idModifier . '">Modifier</a>';
        echo "<br>";
        echo "<br>";
    }
    ?>

    <hr>

    <?php

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sqlId = "SELECT * FROM `users` WHERE `idUser` = '$id'";
        $stmtId = $pdo->prepare($sqlId);
        $stmtId->execute();
        $resultsId = $stmtId->fetchAll(PDO::FETCH_ASSOC);

        echo ' <form method="POST">
        <input type="hidden" name="idUpdate" value="' . htmlspecialchars($resultsId[0]['idUser']) . '">
        <br>
        <label>nom</label>
        <input type="text" name="updateNom" value="' . htmlspecialchars($resultsId[0]['nomUser']) . '">
        <br>
        <label>prenom</label>
        <input type="text" name="updatePrenom" value="' . htmlspecialchars($resultsId[0]['prenomUser']) . '">
        <br>
        <label>age</label>
        <input type="text" name="updateAge" value="' . htmlspecialchars($resultsId[0]['ageUser']) . '">
        <br>
        <label>adresse mail</label>
        <input type="text" name="updateAdresseMail" value="' . htmlspecialchars($resultsId[0]['adresseMailUser']) . '">
        <br>
        <label>mot de passe</label>
        <input type="text" name="updatePassword" value="' . htmlspecialchars($resultsId[0]['passwordUser']) . '">
        <br>
        <input type="submit" name="submitUpdate" value="Mettre à jour les données">
    </form>';
    }

    if (isset($_POST['submitUpdate'])) {

        $idUpdate = $_POST['idUpdate'];
        $nom = $_POST['updateNom'];
        $prenom = $_POST['updatePrenom'];
        $age = $_POST['updateAge'];
        $adresseMail = $_POST['updateAdresseMail'];
        $password = $_POST['updatePassword'];

        $hashPassword = password_hash('$password', PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE `users` SET `nomUser`='$nom',`prenomUser`='$prenom',`ageUser`='$age',`adresseMailUser`='$adresseMail',`passwordUser`='$hashPassword' WHERE idUser='$idUpdate'";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute();

        header("Location: logUser.php");
    }
    ?>
</body>
</html>