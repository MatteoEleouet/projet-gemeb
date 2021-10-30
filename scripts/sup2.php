<?php

    // Connexion à la base de données
    $host = 'localhost';
    $username = 'root';
    $dbname = 'test2';
    $password = 'willy9105';
    $host2 = 'mysql:host=localhost;dbname=test2';


    $conn = mysqli_connect($host, $username, $password, $dbname);
    $PDO = new PDO($host2, $username, $password);


    if (isset($_GET["idClient"]))
    {
        $ids=$_GET["idClient"];
        $sqlUser = "SELECT * FROM registers WHERE idClient = '$ids'"; 
        $results = $PDO->query($sqlUser);
        while($data = $results->fetch(PDO::FETCH_ASSOC))
        {
            $nomUser = $data ['Nom'];
            $prenomUser = $data['Prenom'];
            $telephoneUser = $data ['Telephone'];
            $dateUser = $data ['date'];
            $adresseUser = $data ['Adresse'];
            $email = $data ['Email'];
        }
        $sqlUser2 = "SELECT NbFlash, NomMachine FROM Prestation WHERE Client = '$ids'";
        $results2 = $PDO->query($sqlUser2);
        while($data1 = $results2->fetch(PDO::FETCH_ASSOC))
        {
            $nbFlash = $data1 ['NbFlash'];
            $nomMachine = $data1['NomMachine'];
        }


        
        $sqlUpdate="UPDATE registers INNER JOIN Prestation SET
            registers.Nom = 'Le nom', registers.Prenom = 'Le prenom',
                registers.Adresse = 'Adresse', Prestation.NbFlash = 0 , registers.Telephone = 667 , registers.MotDePasse = 'LeMDP', 
                registers.Email = 'adresse@ma.il',
                registers.registre = 0 , Prestation.EtatMachine = 0
            WHERE registers.idClient = '$ids' AND Prestation.Client = '$ids'";

        // On ajoute les informations dans les anciens clients
        $sqlOldClient = "INSERT INTO OldClient (Nom, Prenom, Telephone, Adresse, Email, Date, NbFlash) 
                         VALUES ( '$nomUser', '$prenomUser', '$telephoneUser', '$adresseUser', '$email', '$dateUser', '$nbFlash' )";

        // == MAJ MOIS TABLE DATE1
        $sqlUpdateMois = "UPDATE date1 SET Janvier = 0, Fevrier = 0, Mars = 0, Avril = 0, Mai = 0, Juin = 0, Juillet = 0,
        Aout = 0, Octobre = 0, Novembre = 0, Decembre = 0, Septembre = 0 WHERE Client = '$ids'"; 
        // =======================
        mysqli_query($conn, $sqlUpdate);
        mysqli_query($conn, $sqlOldClient);
        mysqli_query($conn, $sqlUpdateMois);
        header("Location:../tableau-user.php");
        exit();
    
    }
    else
    {
	echo "Pas connecté";
    }

?>
