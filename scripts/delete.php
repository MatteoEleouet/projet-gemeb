<?php
    // Connexion à la base de données
    $host = 'localhost';
    $username = 'root';
    $dbname = 'test2';
    $password = 'willy9105';
    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (isset($_GET["idClient"]))
    {
        $ids = $_GET['idClient'];
        // Supression du compte dans la table future client
        $sqlDelete = "DELETE FROM FutureClient WHERE idClient = '$ids'";
        mysqli_query($conn, $sqlDelete);
        header("Location:../tableau-futureclient.php");
        exit();
    }