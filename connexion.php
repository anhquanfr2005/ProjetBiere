<?php
	include_once("Formulaire.php");
	include_once("fonction.php");

	?>
<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="./JS_Cavebiere/verif_mdp_carac_spe.js"></script>
	<link href="./ps.css" rel="stylesheet" type="text/css">
		<title>Sessions</title>
        <link rel="shortcut icon" href="./imge/T.jpg" type="image/png">
	</head>

	<body id="cobody">
        <header>
        </header>
        <nav id ="mise">
			<?php // Pour la sécurité on utilise htmlentities pour empêcher les attaques XSS
				if (isset($_GET["var"])){
					$var= htmlentities($_GET["var"]);
					//echo "var : ".htmlentities($var); htmlentities permet de convertir les caractères spéciaux en entités  HTML
				}
				// affichage du formulaire de connexion ou le menu avec le nom de la personne
				if (empty($_SESSION)) Formulaireconnection();
				else redirect('index.php',0);
				// test de la connexion
				if (isset($_POST) && !empty($_POST) && isset($_POST['connect'])
					&& isset ($_POST["login"]) && isset ($_POST["pass"])){
						if (authentification($_POST['login'],$_POST['pass'])){
						$_SESSION['login'] = $_POST['login'];
						if (isAdmin($_SESSION["login"])) $_SESSION["statut"] = 'admin';
						else $_SESSION["statut"] = 'user';
						redirect('index.php',0.5);

						// Log de connexion
						$monfichier = fopen('./log/accesSucceed.log', 'a+');
						// 2 : Ecriture dans le fichier...
						fputs($monfichier, $_POST['login']." de ".$_SERVER['REMOTE_ADDR']." à ".date('l jS \of F Y h:i:s A')." connection réussie");
						fputs($monfichier, "\n");
						// 3 : quand on a fini de l'utiliser, on ferme le fichier
						fclose($monfichier);
						// si absence de session on affiche formulaire
						$lines = file('./log/accesSucceed.log');
						
						/*echo "<ul>";
						foreach ($lines as $line) {
							$parts = explode(' de ', $line);
							$login = $parts[0];
							echo "<li>" . $login . "</li>";
						}*/

						}
						else {
						// Log de l'échec de connexion
						$monfichier = fopen('./log/accesError.log', 'a+');
						// 2 : Ecriture dans le fichier...
						fputs($monfichier, $_POST['login']." de ".$_SERVER['REMOTE_ADDR']." à ".date('l jS \of F Y h:i:s A')." échec de connection ");
						fputs($monfichier, "\n");
						// 3 : quand on a fini de l'utiliser, on ferme le fichier
						fclose($monfichier);
						// si absence de session on affiche formulaire
						$lines = file('./log/accesError.log');
						
						/*echo "<ul>";
						foreach ($lines as $line) {
							$parts = explode(' de ', $line);
							$login = $parts[0];
							echo "<li>" . $login . "</li>";
						}*/
						
							redirect('connexion.php',7);
							echo "<h4 id=ss>"."L'utilisateur n'existe pas ou sinon le mot de passe est incorrecte veuillez réessayer dans 7 secondes.". "</h4>";
						}
				}
				// Destruction de la session
				if (isset($_GET) && !empty($_GET['action']) && $_GET['action'] == 'logout'){
					$_SESSION = array();
					session_destroy();
					redirect('connexion.php',0.5);
				}
			?>
		</nav>


    
		<?php
    copyrightF();
    ?>
    </body>
</html>
