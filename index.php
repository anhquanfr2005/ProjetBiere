<?php
	include_once("Formulaire.php");
	include_once("fonction.php");
    if (empty($_SESSION)) {
        echo "<h3 class='non'>Vous n'êtes ne vous êtes pas connecter ou vous n'avez pas les droits pour accéder à cette pages vous allez être rediriger vers la page index.</h3>";
        redirect('connexion.php',0);
        exit;
    }
	?>
<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	    <script src="./JS_Cavebiere/verif_mdp_carac_spe.js"></script>
        <link href="./ps.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="./imge/T.jpg" type="image/png">
        <title>Index</title>
        <script>
    // Lorsque l'utilisateur quitte l'onglet
    window.onblur = function() {
        document.title = "Déconnecter-Vous!";
    };

    // Lorsque l'utilisateur revient à l'onglet
    window.onfocus = function() {
        document.title = "Index";
    };
</script>
	</head>
	<body class="cob">

        <header>

        </header>
        <nav>
			

			<?php
            Choix();
            ?>
        </nav>
        <section id="ca">      
        <?php
        afficheindex();
            affichB();
            ?>
        </div>
        </div>
        </section>
        <article>
            <h2 class="ti">Découvrir Nos Produits</h2>
            <?php
            afficheformbiereAJAX()
            ?>
            <!-- Ajax s'applique ici-->
            <p id="recherche"></p>            
        </article>

    
    <?php
    copyrightF();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
