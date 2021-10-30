<?php
$connection = mysqli_connect("localhost", "root", "willy9105");
$db = mysqli_select_db($connection, 'test2');
$bdd = new PDO('mysql:host=localhost;dbname=test2;charset=utf8','root','willy9105');


if(isset($_POST['Email']))
{
    $email = htmlspecialchars($_POST['Email']);
    $MotDePasse = $_POST['MotDePasse'];
    $MotDePasse = password_hash($MotDePasse, PASSWORD_BCRYPT);
    $adresse = htmlspecialchars($_POST['Adresse']);
    $nom =  htmlspecialchars($_POST['Nom']);
    $telephone = htmlspecialchars($_POST['Telephone']);
    $prenom = htmlspecialchars($_POST['Prenom']);


    $SELECT = "SELECT Email FROM registers WHERE Email = ? LIMIT 1";
    $stmt = $connection->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    $SELECT = "SELECT Email FROM FutureClient WHERE Email = ? LIMIT 1";
    $stmt = $connection->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum2 = $stmt->num_rows;

    $sqlRegistre = "SELECT registre FROM registers ORDER BY idClient DESC LIMIT 1";
    $resultsRegistre = $bdd->query($sqlRegistre); // 8
    $registreMax = $resultsRegistre->fetch(PDO::FETCH_ASSOC);
    $comptePasDispo = $registreMax['registre'];

    if($rnum == 0 && $comptePasDispo == 0 && $rnum2 == 0)
    {
        $sqlInsert = "INSERT INTO FutureClient (Nom, Prenom, Adresse, Email, Telephone, MotDePasse, Date)
            VALUES ( '$nom', '$prenom', '$adresse', '$email', '$telephone', '$MotDePasse', CURDATE() )";
        $query_run = mysqli_query($connection, $sqlInsert);
        $stmt->close();
        if($query_run)
        {
            /*header("location: ../connexion.php");
            exit();*/
            echo "Votre demande de location de machine a été effectuer. Elle doit maintenant être validé par un administrateur";
        }
        else
        {
            echo 'Erreur';
        }
    }
   else
   {
	echo "Cette email est déjà utilisé ou il n'y pas plus de machine disponible à la location";
   }
}
else{
    echo "vous avez même pas rentrez d'email";
}
