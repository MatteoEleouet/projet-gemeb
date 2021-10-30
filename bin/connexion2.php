<?php
$login = false;
showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    {
        $host = "localhost";
        $dbNom = "root";
        $dbMotDePasse = "willy9105";
        $dbName = "test";

    // create connection
    $conn = new mysqli($host, $dbNom, $dbMotDePasse, $dbName);
        $Email = $_POST["Email"];
        $MotDePasse = $_POST["MotDePasse"];

        $sql = "Select * FROM register where Email = '$Email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                if(password_verify($MotDePasse, $row['MotDePasse']))
                {
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['Email'] = $Email;
                    header('Location: principale.php');
                }
                else
                {
                    $showError = "Mot de passe ou email incorrect";
                }
            }
        }
    }
    else
    {
        $showError = "Mot de passe ou email incorrect";
    }
}
// https://www.youtube.com/watch?v=3bGDe0rbImY
?>
