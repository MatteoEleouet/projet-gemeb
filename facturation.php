<?php session_start();
if($_SESSION['Email'] !== $email)
{
    $host2 = "localhost";
    $host = 'mysql:host=localhost;dbname=test2';
    $dbUser = 'root';
    $dbMdp = 'willy9105';
    $dbName = "test2";

    $email = $_SESSION['Email'];
    try
    {
        $options =
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $PDO = new PDO($host, $dbUser, $dbMdp, $options);
        $sqlFacture1 = "SELECT * FROM registers WHERE Email = '$email'"; // Afficher toutes la informations de tous les comptes
        $results = $PDO->query($sqlFacture1);

        
    }

    catch(PDOException $pe)
    {
        echo 'ERREUR : '.$pe->getMessage();
    }
}
else
{
    header("Location: connexion.php");
}


$data = $results->fetch(PDO::FETCH_ASSOC);
    $nomUser = $data ['Nom'];
    $telephone = $data ['Telephone'];
    $dateFacture = $data ['datefact'];
    $idClient = $data['idClient'];
    $adresse = $data['Adresse'];
    $prenomUser = $data ['Prenom'];

// Calcule de la date de facturation
    $dateDepartTimestamp = strtotime($dateFacture);
    $dateFacture = date('d-m-Y', strtotime('-1 month', $dateDepartTimestamp)); 

// ===================================================================================
// Etude d'achat machine
$moisActif;
$sqlAvg = "SELECT * FROM date1 WHERE Client = '$idClient'"; 
$results = $PDO->query($sqlAvg);
while($dataAvg = $results->fetch(PDO::FETCH_ASSOC))
{
    $janvier = $dataAvg ['Janvier'];
    $fevrier = $dataAvg ['Fevrier'];
    $mars = $dataAvg ['Mars'];
    $avril = $dataAvg ['Avril'];
    $mai = $dataAvg ['Mai'];
    $juin = $dataAvg ['Juin'];
    $juillet = $dataAvg ['Juillet'];
    $aout = $dataAvg ['Aout'];
    $septembre = $dataAvg ['Septembre'];
    $octobre = $dataAvg ['Octobre'];
    $novembre = $dataAvg ['Novembre'];
    $decembre = $dataAvg ['Decembre'];
}
$tousLesMois = $fevrier + $janvier + $fevrier + $mars + $avril + $mai + $juillet +
    $juin + $aout + $septembre + $octobre + $decembre + $novembre;
if ($janvier > 0)       {$moisActif++;}
if ($fevrier > 0)       {$moisActif++;}
if ($mars > 0)          {$moisActif++;}
if ($avril > 0)         {$moisActif++;}
if ($mai > 0)           {$moisActif++;}
if ($juin > 0)          {$moisActif++;}
if ($juillet > 0)       {$moisActif++;}
if ($aout > 0)          {$moisActif++;}
if ($septembre > 0)     {$moisActif++;}
if ($octobre > 0)       {$moisActif++;}
if ($decembre > 0)      {$moisActif++;}
if ($novembre > 0)      {$moisActif++;}

$moyenneMoisActif = $tousLesMois / $moisActif;
// ======================================================================




// ========================================================================
// Selection du mois en cours
$month = date('m');

if($month=="01")
{
    $sqlSelectMonth = "SELECT Decembre FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Decembre'];
}
elseif($month=="02")
{
    $sqlSelectMonth = "SELECT Janvier FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Janvier'];
}
elseif($month=="03")
{
    $sqlSelectMonth = "SELECT Fevrier FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Fevrier'];
}
elseif($month=="04")
{
    $sqlSelectMonth = "SELECT Mars FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Mars'];
}
elseif($month=="05")
{
    $sqlSelectMonth = "SELECT Avril FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Avril'];
}
elseif($month=="06")
{
    $sqlSelectMonth = "SELECT Mai FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Mai'];
} 
elseif($month=="07")
{
    $sqlSelectMonth = "SELECT Juin FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Juin'];
}
elseif($month=="08")
{
    $sqlSelectMonth = "SELECT Juillet FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Juillet'];
}
elseif($month=="09")
{
    $sqlSelectMonth = "SELECT Aout FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Aout'];
}
elseif($month=="10")
{
    $sqlSelectMonth = "SELECT Septembre FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Septembre'];
}
elseif($month=="11")
{
    $sqlSelectMonth = "SELECT Octobre FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Octobre'];
}
elseif($month=="12")
{
    $sqlSelectMonth = "SELECT Novembre FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Novembre'];
}
else{echo "erreur";}
// ======================================================================



$prixDeLaMachine = 20000;
$prixDuFlash = 1.2;
$totalFlash= $nbFlash * $prixDuFlash;
$sousTotal = $totalFlash;
$taxe = $sousTotal * 0.20;
$grandTotal = $sousTotal + $taxe;

$bilanAchat = $moyenneMoisActif * 36;


if ($bilanAchat > $prixDeLaMachine) 
{
    $achatMachine = "Une machine GEMEB d'épilation coûte " . $prixDeLaMachine . "€, sur une moyenne de vos 11 derniers mois sur une location de 3 ans vous payerai " . $bilanAchat ."€, nous vous invitons à vous interessé à l'achat d'une machine d'épilation";
}
else
{
    $achatMachine = "Une machine GEMEB d'épilation coûte " . $prixDeLaMachine . "€, sur une moyenne de vos 11 derniers mois sur une location de 3 ans vous payerai " . $bilanAchat ."€, nous vous conseillons de continuer à louer notre machine.";
}
?>














<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>FACTURATION - GEMEB</title>
    <link rel="stylesheet" href="dossier-facturation/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="dossier-facturation/logo-gemeb.jpg">
      </div>
      <div id="company">
        <h2 class="name">GEMEB</h2>
        <div>230, rue de Faubourg-Saint-Honoré</div>
        <div>01 45 63 55 31</div>
        <div><a href="mailto:admin@gemeb.site">admin@gemeb.site</a></div>
      </div>
      </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">FACTURE DE:</div>
                <h2 class="name"><?php echo htmlspecialchars($nomUser); echo " ";echo htmlspecialchars($prenomUser);?></h2>
                <div class="address"><?php echo htmlspecialchars($adresse); ?> </div>
                <div class="email"><a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></div>
            </div>
            <div id="invoice">
                <h1>FACTURE TELELOCATION</h1>
                <div class="date">Date de facturation: <?php echo $dateFacture; ?></div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="desc">DESCRIPTION</th>
                    <th class="unit">PRIX A l'UNITE</th>
                    <th class="qty">QUANTITE</th>
                    <th class="total">TOTAL</th>
                </tr>
            </thead>
            <tbody>            
                <tr>
                    <td class="no">1</td>
                    <td class="desc"><h3>Consommation de flash</h3>Utilisation du nombre de flash de la machine d'épilation</td>
                    <td class="unit"><?php echo htmlspecialchars($prixDuFlash); ?>€</td>
                    <td class="qty"><?php echo htmlspecialchars($nbFlash); ?></td>
                    <td class="total"><?php echo htmlspecialchars($totalFlash); ?>€</td>
                </tr>

                <tr>
                    <td class="no">2</td>
                    <td class="desc"><h3>Frais supplémentaire</h3></td>
                    <td class="unit"><?php ?>0€</td>
                    <td class="qty">0</td>
                    <td class="total"><?php ?>0€</td>
                </tr>
            </tbody>
            <br />
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SOUS-TOTAL</td>
                    <td><?php echo htmlspecialchars($sousTotal); ?>€</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">TAXE 20%</td>
                    <td><?php echo htmlspecialchars($taxe); ?>€</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td><?php echo htmlspecialchars($grandTotal); ?>€</td>
                </tr>
            </tfoot>
        </table>
        <div id="notices">
            <div>Etude d'achat de machine:</div>
            <div class="notice"><?php echo $achatMachine; ?>    </div>
        </div>
        <br />
        <div id="thanks">Merci !</div>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">Des frais financiers de 1,5 % seront appliqués aux soldes impayés après 30 jours.    </div>
        </div>
    </main>
    <footer>
        La facture a été créée sur un ordinateur et est valable sans la signature et le cachet.
    </footer>
  </body>
</html>