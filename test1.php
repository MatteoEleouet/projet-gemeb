<?php
session_start();
// Vérifier si l'utilisateur est connecté, si non, le rediriger vers la page de login
if($_SESSION['Email'] !== $email)
{
    $email = $_SESSION['Email'];
}
else
{
    header("Location: ../connexion.php");   

}

$host = 'mysql:host=localhost;dbname=test2';
$dbUser = 'root';
$dbMdp = 'willy9105';
$PDO = new PDO($host, $dbUser, $dbMdp);
$sqlUser = "SELECT * FROM registers WHERE Email = '$email'"; 
$results = $PDO->query($sqlUser);



$data = $results->fetch(PDO::FETCH_ASSOC);
    $nomUser = $data ['Nom'];
    $prenomUser = $data['Prenom'];
    $idClient = $data ['idClient'];
    $etatAdmin = $data ['EtatAdmin'];


if ($etatAdmin == 0)
{
    header("Location: consommation.php");
}

$ids = $_GET['idClient'];

$sqlClient = "SELECT * FROM registers WHERE idClient = '$ids'"; 
$results1 = $PDO->query($sqlClient);
$dataClient = $results1->fetch(PDO::FETCH_ASSOC);
    $nomClient = $dataClient['Nom'];
    $prenomClient = $dataClient['Prenom'];
    $emailClient = $dataClient['Email'];
    $dateClient = $dataClient['date'];
    $adresseClient = $dataClient['Adresse'];
    $telephoneClient = $dataClient['Telephone'];

?>



<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Changement infomration client</title>

    <!-- Custom fonts for this template-->
    <link href="fichier-consommation/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                    <li class="nav-item">
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
              
                    <hr class='sidebar-divider d-none d-md-block'>
                    <div class='sidebar-heading'>
                        Option administrateur
                    </div>

                    <li class='nav-item'>
                        <a class='nav-link' href='tableau-user.php'>
                            <i class='fas fa-fw fa-table'></i>
                            <span>Tableau clients</span></a>
                    </li>

                    <li class='nav-item active'>
                        <a class='nav-link' href='modification-client.php'>
                            <i class='fas fa-fw fa-folder'></i>
                            <span>Modification clients</span></a>
                    </li>";


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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($prenomUser); echo" "; echo htmlspecialchars($nomUser); ?></span>
                                <img class="img-profile rounded-circle"
                                    src="fichier-consommation/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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
                    <h1 class="h3 mb-2 text-gray-800">Modification des informations client</h1>
                    

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-6 col-lg-5">

                            <div class="wrapper">
                                <h2></h2>
                                <p>Veuillez remplir ce formulaire afin de modifier les informations du clients : <?php echo $test; ?><br /></p>
                                <form method ="post" action="scripts/update-client.php">
                                        
                                    <div class="form-group">
                                        <label>Nouvel email :</label>
                                        <input type="mail" name="Email" class="form-control" value="<?php echo $emailClient;?>" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Nouveau mot de passe :</label>
                                        <input type="password" name="MotDePasse" class="form-control" placeholder="Mot de passe">
                                    </div>
                                    <div class="form-group">
                                        <label>Nouveau nom :</label>
                                        <input type="text" name="Nom" class="form-control" value="<?php echo $nomClient;?>" placeholder="Nom">
                                    </div>
                                    <div class="form-group">
                                        <label>Nouveau prénom :</label>
                                        <input type="text" name="Prenom" class="form-control" value="<?php echo $prenomClient;?>" placeholder="Prenom">
                                    </div>
                                    <div class="form-group">
                                        <label>Nouveau numéro de téléphone :</label>
                                        <input type="phone" name="Telephone" class="form-control" value="<?php echo $telephoneClient;?>" placeholder="Téléphone">
                                    </div>
                                    <div class="form-group">
                                        <label>Nouvelle adresse :</label>
                                        <input type="text" name="Adresse" class="form-control" value="<?php echo $adresseClient;?>" placeholder="Adresse">
                                    </div>
                                    <div class="form-group">
                                        <label>Numéro d'identification du client :</label>
                                        <input type="text" name="idClient" class="form-control"  value="<?php echo $ids;?>" placeholder="Numéro client">
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Valider">
                                        <a class="btn btn-link" href="consommation.php">Annuler</a>
                                    </div>
                                </form>
                            </div>    

                        </div>

                        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

   

</body>

</html>