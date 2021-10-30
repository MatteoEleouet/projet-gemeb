<?php 
$username = "root";
$host = 'mysql:host=localhost;dbname=test2';
$password = "willy9105";
$pdo = new PDO($host,$username,$password);
echo "test";
if($_GET['NbFlash'] != ''){

  $NbFlash=$_GET['NbFlash'];
  $idMachine=$_GET['NomMachine'];
 
  $query = "UPDATE Prestation SET NbFlash=NbFlash+".$NbFlash." WHERE NomMachine=".$idMachine." and EtatMachine=1";
  $result = $pdo->query($query);
 
  $queryClient = "SELECT * FROM Prestation WHERE NomMachine=".$idMachine;
  $idClient=$pdo->query($queryClient);

while($data = $idClient->fetch(PDO::FETCH_ASSOC))
{
  $Client=$data['Client'];
  echo "</br>";
}

echo $Client;
echo "</br>";
$month = date('m');
echo $month;
echo "</br>";

if($month=="01"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Janvier=date1.Janvier+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="02") {
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Fevrier=date1.Fevrier+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="03"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Mars=date1.Mars+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="04"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Avril=date1.Avril+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="05"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Mai=date1.Mai+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1 AND date1.Client=".$idClient;}
elseif($month=="06"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Juin=date1.Juin+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="07"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Juillet=date1.Juillet+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="08"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Aout=date1.Aout+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="09"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Septembre=date1.Septembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="10"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Octobre=date1.Octobre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="11"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Novembre=date1.Novembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
elseif($month=="12"){
  $sqlreq="UPDATE date1 INNER JOIN Prestation SET date1.Decembre=date1.Decembre+".$NbFlash." WHERE Prestation.NomMachine=".$idMachine." AND Prestation.EtatMachine=1";}
  echo "667";
$result = $pdo->query($sqlreq);
echo "667";}

?>