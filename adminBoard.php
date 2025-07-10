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
    <!-- <form>
        <value>nom</value>
        <input type="text" name="insertNom" value="">
        <br>
        <value>prenom</value>
        <input type="text" name="insertPrenom" value="">
        <br>
        <value>age</value>
        <input type="text" name="insertAge" value="">
        <br>
        <value>adresse mail</value>
        <input type="text" name="insertAdresseMail" value="">
    </form> -->
    <hr>
</body>
</html>

<?php 
foreach ($resultsAll as $key => $value) {
    $idModifier = $value['idUser'];
    foreach ($value as $key => $value2) {
        echo $key . " : " . $value2;
        echo "<br>";
    }
    echo '<a href="?id=' . $idModifier . '">Modifier</a>';
echo "<br>";
echo "<br>";
}





?>