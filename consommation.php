<?php session_start();
if ($_SESSION['Email']) 
{
    $host2 = "localhost";
    $host = 'mysql:host=localhost;dbname=test2';
    $dbUser = 'root';
    $dbMdp = 'willy9105';
    $dbName = "test2";

    $email = $_SESSION['Email'];
    try {
        $options =
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
        $PDO = new PDO($host, $dbUser, $dbMdp, $options);
        
    } catch (PDOException $pe) {
        echo 'ERREUR : ' . $pe->getMessage();
    }
}
else {header("Location: connexion.php");}


// Capture des informations de la table registers ============================
$sqlUser = "SELECT * FROM registers WHERE Email = '$email'";
$results = $PDO->query($sqlUser);
$data = $results->fetch(PDO::FETCH_ASSOC);
    $nomUser = $data['Nom'];
    $prenomUser = $data['Prenom'];
    $idClient = $data['idClient'];
    $etatAdmin = $data['EtatAdmin'];

if ($etatAdmin == 1)
    header('Location: tableau-user.php');


// Capture des informations de la table Prestation ============================
$sqlNbFlash = "SELECT NbFlash FROM Prestation WHERE Client = '$idClient'";
$result1 = $PDO->query($sqlNbFlash);
$dataFlash = $result1->fetch(PDO::FETCH_ASSOC);
    $compteurTotal = $dataFlash['NbFlash'];

$sqlChart = "SELECT * FROM date1 WHERE Client = '$idClient'";
$results2 = $PDO->query($sqlChart);
while ($dataChart = $results2->fetch(PDO::FETCH_ASSOC)) {
    $janvier = $dataChart['Janvier'];
    $fevrier = $dataChart['Fevrier'];
    $mars = $dataChart['Mars'];
    $avril = $dataChart['Avril'];
    $mai = $dataChart['Mai'];
    $juin = $dataChart['Juin'];
    $juillet = $dataChart['Juillet'];
    $aout = $dataChart['Aout'];
    $septembre = $dataChart['Septembre'];
    $octobre = $dataChart['Octobre'];
    $novembre = $dataChart['Novembre'];
    $decembre = $dataChart['Decembre'];
}

$month = date('m');

if($month=="01")
{
    $sqlSelectMonth = "SELECT Janvier FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Janvier'];
}
elseif($month=="02")
{
    $sqlSelectMonth = "SELECT Fevrier FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Fevrier'];
}
elseif($month=="03")
{
    $sqlSelectMonth = "SELECT Mars FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Mars'];
}
elseif($month=="04")
{
    $sqlSelectMonth = "SELECT Avril FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Avril'];
}
elseif($month=="05")
{
    $sqlSelectMonth = "SELECT Mai FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Mai'];
} 
elseif($month=="06")
{
    $sqlSelectMonth = "SELECT Juin FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Juin'];
}
elseif($month=="07")
{
    $sqlSelectMonth = "SELECT Juillet FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Juillet'];
}
elseif($month=="08")
{
    $sqlSelectMonth = "SELECT Aout FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Aout'];
}
elseif($month=="09")
{
    $sqlSelectMonth = "SELECT Septembre FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Septembre'];
}
elseif($month=="10")
{
    $sqlSelectMonth = "SELECT Octobre FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Octobre'];
}
elseif($month=="11")
{
    $sqlSelectMonth = "SELECT Novembre FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Novembre'];
}
elseif($month=="12")
{
    $sqlSelectMonth = "SELECT Decembre FROM date1 WHERE Client = '$idClient'";
    $resultsMois = $PDO->query($sqlSelectMonth);
    $dataSelectMois = $resultsMois->fetch(PDO::FETCH_ASSOC);
    $nbFlash = $dataSelectMois['Decembre'];
}
else{echo "erreur";}




$prixDeLaMachine = 20000;
$prixDuFlash = 1.2;

$janvierChart = $janvier * $prixDuFlash;
$fevrierChart = $fevrier * $prixDuFlash;
$marsChart = $mars * $prixDuFlash;
$avrilChart = $avril * $prixDuFlash;
$maiChart = $mai * $prixDuFlash;
$juinChart = $juin * $prixDuFlash;
$juilletChart = $juillet * $prixDuFlash;
$aoutChart = $aout * $prixDuFlash;
$septembreChart = $septembre * $prixDuFlash;
$octobreChart = $octobre * $prixDuFlash;
$novembreChart = $novembre * $prixDuFlash;
$decembreChart = $decembre * $prixDuFlash;

$compteurTotal *= $prixDuFlash;
$compteurActuel = $nbFlash * $prixDuFlash;
$machine = $compteurTotal / $prixDeLaMachine * 100;

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Projet TELE-LOCATION LCR" content="">
    <meta name="Mattéo ELEOUET" content="">

    <title>SUIVI CONSOMMATION</title>

    <!-- Custom fonts for this template-->
    <link href="fichier-consommation/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="fichier-consommation/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="consommation.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">GEMEB TELELOCATION</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="consommation.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i> 
                    <span>Consommation</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Option supplémentaire
            </div>


            <!-- Nav Item - Changement de mot de passe MDP -->
            <li class="nav-item">
                <a class="nav-link" href="change-mdp.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Changement de MDP</span></a>
            </li>







            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="facturation.php" target='_blank'>
                    <i class="fas fa-fw fa-table"></i>
                    <span>Facturation</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Message -->
            <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="fichier-consommation/img/undraw_rocket.svg" alt="">
                <p class="text-center mb-2"><strong>GEMEB</strong> Vous propose d'acheter la machine et non de la louer tous les mois !</p>
                <a class="btn btn-success btn-sm" href="">Acheter la machine !</a>
            </div>
        </ul>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($prenomUser);
                                                                                            echo " ";
                                                                                            echo htmlspecialchars($nomUser); ?></span>
                                <img class="img-profile rounded-circle" src="fichier-consommation/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Suivi de consommation</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Compteur actuel</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($compteurActuel . '€'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-coins fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Ce que vous avez payé depuis que vous êtes abonné</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $compteurTotal; ?>€</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-euro-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">% du prix de la machine que avez payé en location
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo htmlspecialchars($machine); ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo htmlspecialchars($machine); ?>%" aria-valuenow="50" aria-valuemin="5 " aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-percent fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Nombre de flashs utilisés ce mois-ci</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($nbFlash); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-bolt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Grapique historique payment -- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Historique de la consommation des flashs</h6>
                                </div> <!-- chart- area demo.js -->
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>La Croix Rouge La Salle Projet TELELOCATION 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de vouloir partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à terminer votre session en cours.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-primary" href="deconnexion.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="fichier-consommation/vendor/jquery/jquery.min.js"></script>
    <script src="fichier-consommation/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fichier-consommation/js/demo/chart-pie-demo.js"></script>
    <script src="fichier-consommation/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="fichier-consommation/js/sb-admin-2.min.js"></script>
    <script src="fichier-consommation/vendor/chart.js/Chart.min.js"></script> <!-- sans lui on voit plus les deux graphs -->



    <!-- Page level custom scripts -->

    <!-- =============================================================================== -->

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }






        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"],
                datasets: [{
                    label: "Payé",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [
                        <?php echo htmlspecialchars($janvierChart); ?>,
                        <?php echo htmlspecialchars($fevrierChart); ?>,
                        <?php echo htmlspecialchars($marsChart); ?>,
                        <?php echo htmlspecialchars($avrilChart); ?>,
                        <?php echo htmlspecialchars($maiChart); ?>,
                        <?php echo htmlspecialchars($juinChart); ?>,
                        <?php echo htmlspecialchars($juilletChart); ?>,
                        <?php echo htmlspecialchars($aoutChart); ?>,
                        <?php echo htmlspecialchars($septembreChart); ?>,
                        <?php echo htmlspecialchars($octobreChart); ?>,
                        <?php echo htmlspecialchars($novembreChart); ?>,
                        <?php echo htmlspecialchars($decembreChart); ?>,
                    ],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value) + '€';
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + '€';
                        }
                    }
                }
            }
        });
    </script>





</body>

</html>