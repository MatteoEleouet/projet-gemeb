<?php
$server = "localhost";
$username = "root";
$password = "willy9105";
$database = "test";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    die("Error". mysqli_connect_error());
}

?>
