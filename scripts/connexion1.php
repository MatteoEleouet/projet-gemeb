<?php
session_start();
if(isset($_POST['Email']) && isset($_POST['MotDePasse']))
{
    // connexion à la base de données
    $db_Email = 'root';
    $db_MotDePasse = 'willy9105';
    $db_name     = 'test2';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_Email, $db_MotDePasse,$db_name)
           or die('La connexion à la base de données a échoué');
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL. Pas besoin  de htmlspecialchar une base de donnée n'est cible de ce genre d'attaque
    
    $Email = mysqli_real_escape_string($db,$_POST['Email']); 
    $MotDePasse = $_POST['MotDePasse'];

    /*if($Email !== "" && $MotDePasse !== "")
    {*/
        $requete = "SELECT MotDePasse FROM registers WHERE Email = '".$Email."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $Mdp_h = $reponse['MotDePasse'];
	    if(password_verify($MotDePasse, $Mdp_h))
        {
            $_SESSION['Email'] = $Email;
	        $_SESSION['idClient'] = $idClient;
            header('Location: ../consommation.php');
	        exit();
        }
        else
        {
            header('Location: ../connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
	        exit();
        }
   // }
}
else
{
   header('Location: connexion.php');
   exit();
}
mysqli_close($db); // fermer la connexion
?>