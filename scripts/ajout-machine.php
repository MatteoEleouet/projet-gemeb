<?php 

$host = 'mysql:host=localhost;dbname=test2';
$dbUser = 'root';
$dbMdp = 'willy9105';

$PDO = new PDO($host, $dbUser, $dbMdp);

echo "test";

echo "<br /><br /><br /><br /><br />";


$sql = 'SELECT Client FROM Prestation ORDER BY Client DESC LIMIT 1';
$results = $PDO->query($sql); // 8
$dataMAX = $results->fetch(PDO::FETCH_ASSOC);
$clientMAX = $dataMAX['Client'];
$numClient = $clientMAX + 1;
$nomMachine = "ENS$numClient";

$sqlRegister = "INSERT INTO registers (Nom) VALUES ('DISPO')";
$sqlPrestation = "INSERT INTO Prestation (NomMachine, Client) 
    VALUES ('$nomMachine', '$numClient')";
$sqlDate1 = "INSERT INTO date1 (idClient, Client)
VALUES ('$numClient', '$numClient')";

$PDO->query($sqlRegister);
$PDO->query($sqlPrestation);
$PDO->query($sqlDate1);
header("location: ../tableau-user.php");


?>