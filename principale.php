<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="ccs/style.css" media="screen" type="text/css" />
    </head>
    <body style='background:#fff;'>
        <div id="content">
            <!-- tester si l'utilisateur est connecté -->
            <?php
                session_start();
                if($_SESSION['Email'] !== $email)
		{
                    $email = $_SESSION['Email'];
                    // afficher un message
                    echo "Bonjour $email, vous êtes connecté";



		    // Modification à moi en PHP
		    $sql = 'SELECT * FROM Prestation';
		    $results = $PDO->query($sql);
		    foreach($results as $re)
		    {
		    	echo '<pre>';
			print_r($re);
			echo '</pre>';
		    }
                }


		else
		{
			echo"pd";
		}
            ?>

        </div>
    </body>
</html>
