<?php
// Connexion à la base de données
$host ='localhost';
$username = 'root';
$dbname = 'test2';
$password ='willy9105';

$conn = mysqli_connect($host, $username, $password, $dbname);



if (isset($_GET["idClient"]))
{
    $idm=$_GET["idClient"];
    $sql="SELECT Nom, Telephone, Email, MotDePasse FROM registers WHERE idClient = '.$idm.'";
    $result = mysqli_query($conn, $sql);

    $row=mysqli_fetch_assoc($result);

    $idClient=$row["idClient"];
    $Nom=$row["Nom"];
    $Telephone=$row["Telephone"];
    $Email=$row["Email"];
    $MotDePasse=$row["MotDePasse"];
}


if(isset($_POST['modifier']))
{
    $Nom = $_POST['Nom'];
    $Email = $_POST['Email'];
    $MotDePasse = $_POST['MotDePasse'];
    $Telephone = $POST['Telephone'];
    $MotDePasseh = password_hash($MotDePasse, PASSWORD_BCRYPT);
    $MotDePasse = $MotDePasseh;

    // Vérification email disponible ===============
    $SELECT = "SELECT Email FROM registers WHERE Email = ? LIMIT 1";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->bind_result($Email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    // ======================================
    if($rnum == 0)
    {

//	$bdd = new PDO('mysql:host=localhost;dbname=test2;charset=utf8','root','willy9105');


	$query = "UPDATE registers SET Nom = '{$Nom}',MotDePasse = '{$MotDePasse}' Email='{$Email}', Telephone='{$Telephone}' WHERE idClient = '$idm'"; 
	$query_run = mysqli_query($conn, $query);
        $stmt->close();
        if($query_run)
        {
	    echo '</br>';
            echo 'Good';
	    //
        }
        else
        {
            echo 'Erreur';
        }
    }
   else
   {
	echo 'Cette email est déjà utilisé';
   }
}


?>
