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

  mysqli_select_db($this->link,'test2') or die('Cannot select the DB');

 }



 function storeInDB($NbFlash,$idMachine){

  if ($_GET['NbFlash'] != ''){

  //Mise a jour du nb flashs de la machine idmachine

  $query1 = "SELECT NbFlash FROM Prestation WHERE NomMachine=".$idMachine;

  $NbFlashBdd = mysqli_query($this->link,$query1) or die('Errant query1: '.$query1);

  $NbFlashResult = mysqli_fetch_assoc($NbFlashBdd);

  echo'<pre>';
  echo'</pre>';
  echo '</pre>';
  echo $NbFlashResult['NomMachine'];

  printf("%s (%s) \n", $NbFlashResult);

//  $NbFlash = $NbFlashResult + 1;

  $query="SELECT CASE MONTH(CURDATE()) 
               WHEN 1 THEN UPDATE date1 INNER JOIN Prestation SET date1.Janvier=date1.Janvier+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 2 THEN UPDATE date1 INNER JOIN Prestation SET date1.Fevrier=date1.Fevrier+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1         
               WHEN 3 THEN UPDATE date1 INNER JOIN Prestation SET date1.Mars=date1.Mars+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 4 THEN UPDATE date1 INNER JOIN Prestation SET date1.Avril=date1.Avril+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 5 THEN UPDATE date1 INNER JOIN Prestation SET date1.Mai=.date1.Mai+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 6 THEN UPDATE date1 INNER JOIN Prestation SET date1.Juin=date1.Juin+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 7 THEN UPDATE date1 INNER JOIN Prestation SET date1.Juilliet=date1.Juillet+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 8 THEN UPDATE date1 INNER JOIN Prestation SET date1.Aout=date1.Aout+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 9 THEN UPDATE date1 INNER JOIN Prestation SET date1.Septembre=date1.Septembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 10 THEN UPDATE date1 INNER JOIN Prestation SET date1.Octobre=date1.Octobre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 11 THEN UPDATE date1 INNER JOIN Prestation SET date1.Novembre=date1.Novembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
               WHEN 12 THEN UPDATE date1 INNER JOIN Prestation SET date1.Decembre=date1.Decembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1
//               WHEN 1=1 THEN UPDATE Prestation set NbFlash=NbFlash+".$NbFlash." WHERE NomMachine=".$idMachine." AND EtatMachine=1
               END;";

  //$query = "update Prestation set NbFlash=NbFlash+".$NbFlash." WHERE NomMachine=".$idMachine." AND EtatMachine=1";

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

 $esp8266obj=new esp8266($_GET['NbFlash'],$_GET['NomMachine']);

}



?>
