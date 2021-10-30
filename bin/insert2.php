<?php

$Nom = $_POST['Nom']; // htmlspecialchars
$MotDePasse = $_POST['MotDePasse'];
$Email = $_POST['Email'];
$Telephone = $_POST['Telephone'];
$MotDePasseh = password_hash($MotDePasse, PASSWORD_BCRYPT);
$MotDePasse = $MotDePasseh;

if (!empty($Nom) AND !empty($MotDePasse) AND !empty($Email) AND !empty($Telephone))
{
    #code
    $host = "localhost";
    $dbNom = "root";
    $dbMotDePasse = "willy9105";
    $dbName = "test";
    // create connection
    $conn = new mysqli($host, $dbNom, $dbMotDePasse, $dbName);
    if (mysqli_connect_error())
    {
        die('Connec Error('.mysqli_connect_errno().')'. mysqli_connect_error());
    }
    else
    {
//        $SELECT = "SELECT Email From register Where Email = ? Limit 1";
  //      $INSERT = "INSERT Into register (Nom, MotDePasse, Email, Telephone) values(?, ?, ?, ?)";
        

        $SELECT = "SELECT Email FROM register WHERE Email = ? LIMIT 1";
        $INSERT = "UPDATE register SET Nom='".$Nom."', MotDePasse='".$MotDePasse."', Email='".$Email."', Telephone='".$Telephone."' WHERE idMachine = 41";
        //$INSERT = "UPDATE register SET (Nom, MotDePasse, Email, Telephone) values (?, ?, ?, ?)";
      //  $INSERT = "UPDATE register SET (Nom, MotDePasse, Email, Telephone, EtatMachine) values (?, ?, ?, ?, 1) WHERE MIN(idPersonne) AND EtatMachine = 0";


        // prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0)
        {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssi", $Nom, $MotDePasse, $Email, $Telephone,);
            $stmt->execute();
            echo "Nouvelle enregistrement réussi !\nVotre numéro de machine $minMachine";
        }
        else
        {
            echo "Quelqu'un est déjà enregistrer avec cet email : $dispoMachine";
        }
        $stmt->close();
        $conn->close();
    }
}

else
{
    echo "Vous devez remplir le questionnaire entièrement";
    die();
}


?>
