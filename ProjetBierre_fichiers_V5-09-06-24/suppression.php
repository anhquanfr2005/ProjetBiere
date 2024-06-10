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
		<link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<title>Suppression</title>

	</head>
	<body class="cob">
        <header>
        <?php
                if (!empty($_SESSION) && isAdmin($_SESSION["login"]) == false) {
                    echo "Vous n'êtes ne vous êtes pas connecter ou vous n'avez pas les droits pour accéder à cette pages vous allez être rediriger vers la page index.";
					redirect_2('index.php',0.1);
                }
                    if (empty($_SESSION)) {
                        echo "Vous n'êtes ne vous êtes pas connecter ou vous n'avez pas les droits pour accéder à cette pages vous allez être rediriger vers la page index.";
                        redirect_2('connexion.php',0.1);
                }?>
        </header>
        <nav>
			<?php
            Choix();
            ?>
        </nav>

        <article>
            <h1>Que voulez vous supprimer ?</h1>
            <li><a href="suppression.php?action=supprimer_biere" title="biere">Supprimer une bière</a></li>
            <li><a href="suppression.php?action=supprimer_stock" title="stock">Supprime un stock</a></li>
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
        <article>
            
            <?php
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'supprimer_stock') {
                echo '<h1>SUPPRIMER UN STOCK</h1>';
            if (!empty($_SESSION)){
                    if ($_SESSION["statut"] == "admin"){
                        FormulaireSupStock();
                }}
            ?>
        </article>
        <?php
            }
            
            elseif ($_GET['action'] == 'supprimer_biere') {
        ?>
        <article>
        <h1>SUPPRIMER UNE BIERE</h1>
            <?php
            if (!empty($_SESSION)){
                    if ($_SESSION["statut"] == "admin"){
                        FormulaireChoixBiere();
                }}
            ?>
        </article>
        <?php
        }
        }
        ?>

    <?php
    copyrightF();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
