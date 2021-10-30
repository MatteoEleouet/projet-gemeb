<?php

$bdd = new PDO('mysql:host=localhost;dbname=test2;charset=utf8','root','willy9105');

$sqlRegistre = "SELECT registre FROM registers ORDER BY idClient DESC LIMIT 1";
$resultsRegistre = $bdd->query($sqlRegistre); // 8
$registreMax = $resultsRegistre->fetch(PDO::FETCH_ASSOC);
$comptePasDispo = $registreMax['registre'];

if ($comptePasDispo == 0) {
    echo "compte dispo";
}
else{
    echo "compte pas dispo";
}


?>