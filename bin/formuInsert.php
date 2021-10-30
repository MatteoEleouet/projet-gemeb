<?php
$connection = mysqli_connect("localhost", "root", "willy9105");
$db = mysqli_select_db($connection, 'test');

if(isset($_POST['Email']))
{
    $Email = $_POST['Email'];
    $MotDePasse = $_POST['MotDePasse'];
    $MotDePasseh = password_hash($MotDePasse, PASSWORD_BCRYPT);
    $MotDePasse = $MotDePasseh;

    $SELECT = "SELECT Email FROM register WHERE Email = ? LIMIT 1";

    $stmt = $connection->prepare($SELECT);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->bind_result($Email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;


    if($rnum == 0)
    {

	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','willy9105');
//	$reponse = $connection->query "SELECT MIN(idMachine) FROM register";
//	$idMachine = $reponse->fetch();



	$sql1 = 'SELECT idMachine FROM register WHERE idMachine = (SELECT MIN(idMachine) FROM register WHERE EtatMachine = 0)';
	$results = $bdd->query($sql1);
	$dataMin = $results->fetch(PDO::FETCH_ASSOC);
	$data2 = $dataMin['idMachine'];
	$query = "UPDATE register SET Nom = '$_POST[Nom]', MotDePasse='$MotDePasse', Email='$Email', Telephone='$_POST[Telephone]',
		  EtatMachine = 1 WHERE idMachine = '$data2'"; // '$idMachine'"; // idMachine = (SELECT MIN(idMachine) FROM register)";
	$query_run = mysqli_query($connection, $query);
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
