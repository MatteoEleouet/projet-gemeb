<?php

    // Connexion à la base de données
    $host = 'localhost';
    $username = 'root';
    $dbname = 'test2';
    $password = 'willy9105';

    $conn = mysqli_connect($host, $username, $password, $dbname);
    echo "test";



    if (isset($_GET["idClient"]))
    {
        $idm=$_GET["idClient"];
        $sql="SELECT * FROM register WHERE idClient = $idm";
        $result = mysqli_query($conn, $sql);

        $row=mysqli_fetch_assoc($result);

        $idClient=$row["idClient"];
        $Nom=$row["Nom"];
        $Telephone=$row["Telephone"];
        $Email=$row["Email"];
        $MotDePasse=$row["MotDePasse"];
    }


    if (isset($_POST['Email']))
    {
       // $idClient=$_POST["idClient"];
        $Nom=$_POST["Nom"];
        $Telephone=$_POST["Telephone"];
        $Email=$_POST["Email"];
        $MotDePasse=$_POST["MotDePasse"];
        
        $sql="UPDATE registers SET Nom = '{$Nom}', MotDePasse = '{$MotDePasse}', Email = '{$Email}', Telephone = '{$Telephone}', WHERE idClient = $idm";
        mysqli_query($conn, $sql);
        header("../page_admin3.php");
        
    }


?>