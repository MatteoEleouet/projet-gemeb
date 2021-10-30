<?php
$connection = mysqli_connect("localhost", "root", "willy9105");
$db = mysqli_select_db($connection, 'test');

if(isset($_POST['Email']))
{
    $id = $_POST['idMachine'];
    $MotDePasse = $_POST['MotDePasse'];
    $MotDePasseh = password_hash($MotDePasse, PASSWORD_BCRYPT);
    $MotDePasse = $MotDePasseh;

    $query = "UPDATE `register` SET Nom='$_POST[Nom]', MotDePasse='$MotDePasse', Email='$_POST[Email]', Telephone='$_POST[Telephone]' WHERE idMachine=41";
    $query_run = mysqli_query($connection, $query);
    
    if($query_run)
    {
        echo 'Good';
    }
    else
    {
        echo 'Mais quel echec ou dirait la vie de Guylian'; 
    }



}

?>
