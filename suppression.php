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
		<title>Suppression</title>

	</head>
	<body class="coboy">
        <header>
        <?php
                if (!empty($_SESSION) && isAdmin($_SESSION["login"]) == false) {
                    echo "<h3 class='non'>Vous n'êtes ne vous êtes pas connecter ou vous n'avez pas les droits pour accéder à cette pages vous allez être rediriger vers la page index.</h3>";
                    redirect('index.php',0);
                }
                    if (empty($_SESSION)) {
                        echo "<h3 class='non'>Vous n'êtes ne vous êtes pas connecter ou vous n'avez pas les droits pour accéder à cette pages vous allez être rediriger vers la page index.</h3>";
                        redirect('connexion.php',0);
                }?>
        </header>
        <nav>
			<?php
            Choix();
            ?>
        </nav>
        <section class="supr">
            <h2 class= "ti" >Suppression</h2>
        </section>
        <article>
            <h2>Que voulez vous supprimer ?</h2>
            <ul>
            <li><a style="font-weight: bold;" class="btn btn-outline-danger" href="suppression.php?action=supprimer_stock" title="stock" role="button">Supprime un stock</a></li>
        </ul>
        <br>
        </article>
        <?php 

if (!empty($_POST) && isset($_POST["NoBiere"])){
    $resultat = SupprimerBiere($_POST["NoBiere"]);
    if ($resultat){
        echo"<br> Suppression de biere réussi";
        listerstockSup();
    }	
else{
    echo "Sur le caveau de mon père et de ma mère y a pas de stock mon copain";
}
}
if (!empty($_POST) && isset($_POST["NoStock"])){
    $resultat = SupprimerStock($_POST["NoStock"]);
    if ($resultat){
        echo"<br> Suppression de stock réussi";
        listerstockSup();
    }	
else{
    echo "Sur le caveau de mon père et de ma mère y a pas de stock mon copain";
}
}
        ?>
            
            <?php
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'supprimer_stock') {

            if (!empty($_SESSION)){
                    if ($_SESSION["statut"] == "admin"){
                        echo'<br><br>';
                        FormulaireSupStock();
                }}
            ?>
        <?php
            }
        }
        ?>

<br><br><br><br><br><br><br><br>

    <?php
    copyrightF();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
