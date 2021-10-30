<?php
session_start();
if ($_SESSION['Email'] !== $email) {

    // Connexion au serveur 
    $host = 'localhost';
    $dbname = 'test2';
    $username = 'root';
    $password = 'willy9105';
    $dsn = "mysql:host=$host;dbname=$dbname";
    $email = $_SESSION['Email'];

    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    header("Location: connexion.php");
}


// On choppe si c'est un admin ou pas
$sqlVerif = "SELECT * FROM registers WHERE Email = '$email'";
$verifAdmin = $pdo->query($sqlVerif);
if ($verifAdmin === false)
    die("ErreurVerif");
$dataVerif = $verifAdmin->fetch(PDO::FETCH_ASSOC);
    $etatAdmin = $dataVerif['EtatAdmin'];
    $idClient = $dataVerif['idClient'];
    $prenomUser = $dataVerif['Prenom'];
    $nomUser = $dataVerif['Nom'];


//
$sql = "SELECT Prestation.NbFlash, registers.date, registers.Nom, registers.Prenom, registers.Adresse, registers.Email, registers.Telephone, registers.idClient  FROM registers INNER JOIN Prestation WHERE registers.idClient=Prestation.Client and Prestation.EtatMachine = 1";
$stmt = $pdo->query($sql);
if ($stmt === false) {
    die("Erreur");
}

if ($etatAdmin == 0)
    header("Location: consommation.php");

// On calcule le pourcentage de machine utilisé
$sqlMachineUse ="SELECT * FROM registers WHERE registre = 1";
$sqlMachineDispo ="SELECT * FROM registers WHERE registre = 0";
$machineBoucle1 = $pdo->query($sqlMachineUse);
while ($machineBoucle1->fetch(PDO::FETCH_ASSOC)) :
    $machineUse++;
endwhile;
$machineBoucle2 = $pdo->query($sqlMachineDispo);
while ($machineBoucle2->fetch(PDO::FETCH_ASSOC)) :
    $machineDispo++;
endwhile;
$calcul = $machineUse / $machineDispo;
$pourcentMachineUse = $calcul * 100;
$pourcentMachineUse = round($pourcentMachineUse, 1); // calcul chiffre après la virgule


?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tableau information - GEMEB</title>



    <!-- Custom fonts for this template -->
    <link href="fichier-consommation/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="fichier-consommation/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="fichier-consommation/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>




<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">GEMEB TELELOCATION</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Sidebar Message -->
            <div class="sidebar-divider">

            </div>
            <hr class='sidebar-divider d-none d-md-block'>
            <div class='sidebar-heading'>
                Option administrateur
            </div>

            <li class='nav-item active'>
                <a class='nav-link' href='tableau-user.php'>
                    <i class='fas fa-fw fa-table'></i>
                    <span>Tableau clients</span></a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='tableau-futureclient.php'>
                    <i class='fas fa-fw fa-user-plus'></i>
                    <span>Validation client</span></a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href='tableau-oldclient.php'>
                    <i class='fas fa-fw fa-address-book'></i>
                    <span>Ancien client</span></a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href='modification-client.php'>
                    <i class='fas fa-fw fa-cog'></i>
                    <span>Modification clients</span></a>
            </li>


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
                    <h1 class="h3 mb-2 text-gray-800">Tableau des clients</h1>
                    <br /><br />

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Table de données des utilisateurs inscrits.</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Num client</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Adresse</th>
                                            <th>date de création</th>
                                            <th>Nombre flash</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Num client</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Adresse</th>
                                            <th>date de création</th>
                                            <th>Nombre flash</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <tr>
                                                <td><?php echo "<a href='modification-client.php?idClient=".$row["idClient"] . "' 
                                                    title ='Modifier les informations du client' class='btn btn-info btn-circle btn-sm'>
                                                    <i class='fas fa-info-circle'></i></a>"; echo "&nbsp"; 
                                                    echo $row['idClient'];   
                                                    ?>
                                                </td>
                                                <td><?php echo $row['Nom'];
                                                    echo " ";
                                                    echo $row['Prenom']; ?></td>
                                                <td><?php echo $row['Email']; ?></td>
                                                <td><?php echo $row['Telephone']; ?></td>
                                                <td><?php echo $row['Adresse']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo "<a href='scripts/sup2.php?idClient=" . $row["idClient"] . "'
                                                     title='Désabonner le client' class='btn btn-danger btn-circle btn-sm'>
                                                    <i class='fas fa-trash'></i></a>"; echo "&nbsp";                                                
                                                    echo $row['NbFlash']; 
                                                
                                                ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="my-2"></div>
                                    <a href="/scripts/ajout-machine.php" class="btn btn-primary btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Ajouter une machine</span>
                                    </a>
                                   <?php

                                        //echo $calcul;
                                      

                                    ?>
                                    


                                    <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pourcentage des machines utiliséss :
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $pourcentMachineUse ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo $pourcentMachineUse ?>%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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

    <!-- Core plugin JavaScript-->
    <script src="fichier-consommation/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="fichier-consommation/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="fichier-consommation/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="fichier-consommation/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="fichier-consommation/js/demo/datatables-demo.js"></script>

</body>

</html>