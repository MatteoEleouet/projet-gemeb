<?php
$connection = mysqli_connect("localhost", "root", "willy9105");
$db = mysqli_select_db($connection, 'test2');
echo "test"; echo "<br />";

    $Email = $_POST['Email']; 
    $MotDePasse = $_POST['MotDePasse'];
    $MotDePasse = password_hash($MotDePasse, PASSWORD_BCRYPT);
    $adresse = $_POST['Adresse'];
    $telephone = $_POST['Telephone'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $idClient = $_POST['idClient'];


    $SELECT = "SELECT Email FROM registers WHERE Email = ? LIMIT 2";
    $stmt = $connection->prepare($SELECT);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->bind_result($Email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if ($rnum == 0 || $rnum == 1) 
    {
        $sqlUpdate = "UPDATE registers SET Email = '$Email', Adresse = '$adresse', MotDePasse = '$MotDePasse', Telephone = '$telephone', Nom = '$nom', 
            Prenom = '$prenom' WHERE idClient = '$idClient'";
        $query_run = mysqli_query($connection, $sqlUpdate);
        $stmt->close();
        if ($query_run) {
            header("location: ../tableau-user.php");
            exit();
        }
        else {
            echo 'Erreur';
        }
    }    
    else
    {
        echo 'Cette email est déjà utilisé';
    }
?>