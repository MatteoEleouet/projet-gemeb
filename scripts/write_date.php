<?php 

$host = 'mysql:host=localhost;dbname=test2';
$dbUser = 'root';
$dbMdp = 'willy9105';

$PDO = new PDO($host, $dbUser, $dbMdp);
$selectMonth = "SELECT MONTH(CURDATE())";
$selected = $PDO->query($selectMonth);
echo ($selected);

class esp8266{

 public $link='';


 function __construct($NbFlash,$idMachine){

  $this->connect();

  $this->storeInDB($NbFlash,$idMachine);


 }


 function connect(){

  $this->link = mysqli_connect('localhost','root','willy9105') or die('Cannot connect to the DB');


  mysqli_select_db($this->link,'test2') or die('Cannot select the DB');

 }



 function storeInDB($NbFlash,$idMachine){

  if ($_GET['NbFlash'] != ''){


  $query = "update Prestation set NbFlash=NbFlash+".$NbFlash." WHERE NomMachine=".$idMachine." and EtatMachine=1";

  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);


 }
}
}

if($_GET['NbFlash'] != ''){

 $esp8266obj=new esp8266($_GET['NbFlash'],$_GET['NomMachine']);
 echo "gud";

}

  
 // $host = 'mysql:host=localhost;dbname=test2';
 // $dbUser = 'root';
  //$dbMdp = 'willy9105';

  //$PDO = new PDO($host, $dbUser, $dbMdp);
 // $selectMonth = "SELECT MONTH(CURDATE())";
  //$selected = $PDO->query($selectMonth);
  //echo $selected;


/*  if($selected==1){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Janvier=date1.Janvier+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==2) {
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Fevrier=date1.Fevrier+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==3){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Mars=date1.Mars+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==4){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Avril=date1.Avril+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==5){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Mai=date1.Mai+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==6){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Juin=date1.Juin+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==7){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Juillet=date1.Juillet+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==8){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Aout=date1.Aout+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==9){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Septembre=date1.Septembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==10){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Octobre=date1.Octobre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==11){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Novembre=date1.Novembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  elseif($selected==12){
    $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Decembre=date1.Decembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}

  $result2 = $PDO->query($sqlreq);*/
 // echo "good";  */

?>
