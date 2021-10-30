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

$host2 = "localhost";
$host = 'mysql:host=localhost;dbname=test2';
$dbUser = 'root';
$dbMdp = 'willy9105';
$dbName = "test2";
$PDO = new PDO($host, $dbUser, $dbMdp, $options);
$sqlUser = "SELECT * FROM registers WHERE Email = '$email'"; 
$results = $PDO->query($sqlUser);




/* Essayer de se connecter à la base de données MySQL */
$link = mysqli_connect($host2, $dbUser, $dbMdp, $dbName);
// Vérifier la connexion
if($link === false)
{
    echo "marche pas";
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
try
{
    $options =
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];







    $mdp1 = $_POST['new_password'];
    $mdp2 = $_POST['confirm_password'];
    $mdpHash = password_hash($mdp1, PASSWORD_BCRYPT);


    // Définir les variables et les initialiser avec des valeurs vides
    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";
    
    // Traitement du formulaire lorsqu'il est soumis
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Valider le nouveau mot de passe
        if(empty(trim($_POST["new_password"])))
        {
            $new_password_err = "Veuillez entrer votre nouveau mot de passe.";     
        }
        elseif(strlen(trim($_POST["new_password"])) < 6)
        {
            $new_password_err = "Votre mot de passe doit contenir au moins 6 caractères.";
        }
        else
        {
            $new_password = trim($_POST["new_password"]);
        }
        
        // Valider la confirmation du mot de passe
        if(empty(trim($_POST["confirm_password"])))
        {
            $confirm_password_err = "Veuillez confirmer votre mot de passe.";
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($new_password_err) && ($new_password != $confirm_password))
            {
                $confirm_password_err = "Les mots de passe ne correspondent pas.";
            }
        }
        // Vérifier les erreurs avant de mettre à jour la base de données
        if(empty($new_password_err) && empty($confirm_password_err)){
            // Préparer un update statement
            $sql = "UPDATE registers SET MotDePasse = '$mdpHash' WHERE Email = '$email'";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Mettre les variables en paramètres au statement préparé
                mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_idClient);
                
                // Set parameters
                $param_password = password_hash($new_password, PASSWORD_BCRYPT);
                $param_idClient = $_SESSION["Email"];
                
                // Essayer d'exécuter le statement préparé
                if(mysqli_stmt_execute($stmt)){
                    // Mot de passe mis à jour avec succès. Deétruire la session et rediriger vers la page login
                    session_destroy();
                    header("location: ../connexion.php");
                    exit();
                } else{
                    echo "Oups ! Un problème est survenu. Veuillez réessayer plus tard.";
                }
            }
            
            // Clore le statement
            mysqli_stmt_close($stmt);
        }
        
        // Clore la connexion
        mysqli_close($link);
    }
}


catch(PDOException $pe)
{
    echo 'ERREUR : '.$pe->getMessage();
}

while($data = $results->fetch(PDO::FETCH_ASSOC))
{
    $nomUser = $data ['Nom'];
    $prenomUser = $data['Prenom'];
    $idClient = $data ['idClient'];
    $etatAdmin = $data ['EtatAdmin'];

}


?>



<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rénitialisation MDP</title>

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
                        <li class="nav-item active">
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
        

                <?php
                    if ($etatAdmin == 1)
                    {
                    // Divider 
                    echo "<hr class='sidebar-divider d-none d-md-block'>

                    <div class='sidebar-heading'>
                        Option administrateur
                    </div>

                    <li class='nav-item'>
                        <a class='nav-link' href='tableau-user.php'>
                            <i class='fas fa-fw fa-table'></i>
                            <span>Tableau clients</span></a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link' href='modification-client.php'>
                            <i class='fas fa-fw fa-folder'></i>
                            <span>Modification clients</span></a>
                    </li>";
                    }
                ?>



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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo htmlspecialchars($prenomUser); echo" "; echo htmlspecialchars($nomUser);?></span>
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
                    <h1 class="h3 mb-2 text-gray-800">Réinitialisation du mot de passe</h1>
                    

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-6 col-lg-6">

                            <div class="wrapper">
                                <h2></h2>
                                <p>Veuillez remplir ce formulaire afin de réinitialiser votre mot de passe<br />Votre mot de passe devra contenir au mini 6 caractères</p>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                                    <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                                        <label>Nouveau mot de passe</label>
                                        <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                                        <span class="help-block"><?php echo $new_password_err; ?></span>
                                    </div>
                                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                        <label>Confirmez le mot de passe</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Valider">
                                        <a class="btn btn-link" href="consommation.php">Annuler</a>
                                    </div>
                                </form>
                            </div>    

                        </div>

                        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

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