<?php /*

    // Prepare variables for database connection

    $username = "root";  // enter database username
    $password = "willy9105";  // enter database password
    $servername = "localhost";
    $dbname = "test";


    // Connect to your database

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn){
      die("connection failed: " . mysqli_connect_error());
    }
    // Prepare the SQL statement
    $Prix= ('".$_GET["NbFlash"]."' * 2); //prix = 2e
    $sql = "INSERT INTO Prestation (NbFlash,Prix,bro)
    VALUES ('".$_GET["NbFlash"]."',$Prix,'deb')";

    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

// '".$_GET["NbFlash"]."' */
?>


<?php
class esp8266{
 public $link='';
 function __construct($NbFlash){
  $this->connect();
  $this->storeInDB($NbFlash);
 }

 function connect(){
  $this->link = mysqli_connect('localhost','root','willy9105') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'test') or die('Cannot select the DB');
 }

 function storeInDB($NbFlash){
  $query = "insert into Prestation set NbFlash='".$NbFlash."'";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }

}
if($_GET['NbFlash'] != ''){
 $esp8266=new esp8266($_GET['NbFlash']);
}


?>




