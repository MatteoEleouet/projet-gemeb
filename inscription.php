<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Inscription</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="espace-membre/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="espace-membre/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="espace-membre/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="espace-membre/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="espace-membre/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="espace-membre/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="espace-membre/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="espace-membre/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="espace-membre/css/util.css">
	<link rel="stylesheet" type="text/css" href="espace-membre/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="scripts/insert5.php">
					<span class="login100-form-title">
						Devenir client ? <br />
						Réservez une machine !
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Merci d'entrer votre prénom">
						<input class="input100" type="text" name="Prenom" placeholder="Prenom">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-16" data-validate="Merci d'entrer votre nom">
						<input class="input100" type="text" name="Nom" placeholder="Nom">
						<span class="focus-input100"></span>
                    </div>

		

					<div class="wrap-input100 validate-input m-b-16" data-validate="Merci d'entrer votre adresse">
						<input class="input100" type="text" name="Adresse" placeholder="Adresse">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-16" data-validate="Merci d'entrer votre N° de télépone">
						<input class="input100" type="phone" name="Telephone" placeholder="Numero de téléphone">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Merci d'entrer votre e-mail">
						<input class="input100" type="email" name="Email" placeholder="Adresse mail">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Merci d'entrer votre mot de passe">
						<input class="input100" type="password" name="MotDePasse" placeholder="Mot de passe">
						<span class="focus-input100"></span>
                    </div>


					
					<br />
					

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit">
							S'inscrire !
						</button>
					</div>

					<div class="flex-col-c p-t-120 p-b-40">
						<span class="txt1 p-b-9">
							Vous avez déjà un compte ?
						</span>

						<a href="connexion.php" class="txt3">
							Connecter vous !
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="espace-membre/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="espace-membre/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="espace-membre/vendor/bootstrap/js/popper.js"></script>
	<script src="espace-membre/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="espace-membre/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="espace-membre/vendor/daterangepicker/moment.min.js"></script>
	<script src="espace-membre/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="espace-membre/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="espace-membre/js/main.js"></script>

</body>
</html>
