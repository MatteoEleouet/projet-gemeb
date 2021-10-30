<?php 
session_start();
class esp8266{
 public $idMachine=$_SESSION['idMachine'];
 public $link='';
 

 // il maquait le paramètre idmachine dans ton constructeur

 function __construct($NbFlash,$idMachine){

  $this->connect();

  $this->storeInDB($NbFlash,$idMachine);

  // Les deux requetes sont regoupées en une avec 2 paramètres



  //$this->storedInDB($idMachine);

  //echo "test";

 }



 function connect(){

  $this->link = mysqli_connect('localhost','user','willy9105') or die('Cannot connect to the DB');



  //pour mes essais j'ai utilisé une base appeleé biomed -> a modifier en fct de ta base

  mysqli_select_db($this->link,'test') or die('Cannot select the DB');

 }



 function storeInDB($NbFlash,$idMachine){

  $idMachine=$_SESSION['idMachine']; 

  //Mise a jour du nb flashs de la machine idmachine

  $query = "update prestation set NbFlash=".$NbFlash." WHERE idMachine=".$idMachine;

  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);

  echo $result;

 }

//  function storedInDB($idMachine){

//  $query2="insert into Prestation set idMachine=3";

//  $result2=mysqli_query($this->link,$query2) or die('Errant query2: '.$query2);



//}

}

if($_GET['NbFlash'] != ''){

 $esp8266obj=new esp8266($_GET['NbFlash'],$_GET['idMachine']);

}



?>
