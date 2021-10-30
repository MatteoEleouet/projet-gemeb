<?php 

class esp8266{

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

  $this->link = mysqli_connect('localhost','root','willy9105') or die('Cannot connect to the DB');


  //pour mes essais j'ai utilisé une base appeleé biomed -> a modifier en fct de ta base

  mysqli_select_db($this->link,'test') or die('Cannot select the DB');

 }



 function storeInDB($NbFlash,$idMachine){

  if ($_GET['NbFlash'] != ''){

  //Mise a jour du nb flashs de la machine idmachine

  $query1 = "SELECT NbFlash FROM register WHERE idMachine2=".$idMachine;

  $NbFlashBdd = mysqli_query($this->link,$query1) or die('Errant query1: '.$query1);

  $NbFlashResult = mysqli_fetch_assoc($NbFlashBdd);

  echo'<pre>';
  echo'</pre>';
  echo '</pre>';
  echo $NbFlashResult['idMachine2'];

  printf("%s (%s) \n", $NbFlashResult);

//  $NbFlash = $NbFlashResult + 1;

  $query = "update register set NbFlash=".$NbFlash." WHERE idMachine2=".$idMachine;

  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);

//  printf("%s (%s) \n", $NbFlash); }
 }

//  function storedInDB($idMachine){

//  $query2="insert into Prestation set idMachine=3";

//  $result2=mysqli_query($this->link,$query2) or die('Errant query2: '.$query2);



//}
}
}

if($_GET['NbFlash'] != ''){

 $esp8266obj=new esp8266($_GET['NbFlash'],$_GET['idMachine2']);

}



?>
