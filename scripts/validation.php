<?php

    // Connexion à la base de données
    $host = 'localhost';
    $username = 'root';
    $dbname = 'test2';
    $password = 'willy9105';
    $host2 = 'mysql:host=localhost;dbname=test2';
    $conn = mysqli_connect($host, $username, $password, $dbname);
    $PDO = new PDO($host2, $username, $password);

    // On vérifie qu'il y a au moins une machine disponible
    $sqlRegistre = "SELECT registre FROM registers ORDER BY idClient DESC LIMIT 1";
    $resultsRegistre = $PDO->query($sqlRegistre); // 8
    $registreMax = $resultsRegistre->fetch(PDO::FETCH_ASSOC);
    $comptePasDispo = $registreMax['registre'];

    if (isset($_GET["idClient"]) && $comptePasDispo == 0)
    {
        $ids=$_GET["idClient"];

        // On capture toutes les informations du client qui va être valider
        $sqlUser = "SELECT * FROM FutureClient WHERE idClient = '$ids'"; 
        $results = $PDO->query($sqlUser);
        $data = $results->fetch(PDO::FETCH_ASSOC);
            $nom = $data ['Nom'];
            $prenom = $data['Prenom'];
            $telephone = $data ['Telephone'];
            $adresse = $data ['Adresse'];
            $email = $data ['Email'];
            $motDePasse = $data['MotDePasse'];

        // Selection la machine ayant l'id le plus faible
        $sql1 = 'SELECT idClient FROM registers WHERE idClient = (SELECT MIN(idClient) WHERE registre=0)';
        $results = $PDO->query($sql1);
        $dataMin = $results->fetch(PDO::FETCH_ASSOC);
        $machineMini = $dataMin['idClient'];

        // inscrit le client dans les tables des client 
        $query = "UPDATE registers SET Adresse = '$adresse', Nom = '$nom', Prenom = '$prenom',
            MotDePasse='$motDePasse', Email='$email', Telephone='$telephone', registre=1, date=CURDATE(),
            datefact=date + INTERVAL 1 MONTH WHERE idClient = '$machineMini'";
        $query2 = "UPDATE Prestation SET EtatMachine = 1 WHERE Client = '$machineMini'";
        
        // Supression du compte dans la table future client
        $sqlDelete = "DELETE FROM FutureClient WHERE idClient = '$ids'";
        // ====================================================
        mysqli_query($conn, $query);
        mysqli_query($conn, $query2);
        mysqli_query($conn, $sqlDelete);
        header("Location:../tableau-futureclient.php");
        exit();
    
    }
    else
    {
	echo "Pas connecté";
    }

?>