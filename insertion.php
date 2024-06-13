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
		<title >Insertion</title>

	</head>
	<body>
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
        <section class="ins">
            <h1 class= "ti" >Insertion</h1>
            <br><br><br><br><br><br><br><br><br><br>
        </section>
        <article>
            <h1>Que voulez vous ajouter ?</h1>
            <a style="font-weight: bold;" class="btn btn-outline-dark" href="insertion.php?action=inserer_biere" title="biere" role="button">Inserer une bière</a> 
            <a style="font-weight: bold;" class="btn btn-outline-dark" href="insertion.php?action=inserer_stock" title="stock_insert" role="button">Inserer un stock</a>
        <br><br>
        </article>

        <?php
        // on vérifie le Post 
        if (!empty($_SESSION) && $_SESSION["statut"] == "admin") {
if (!empty($_POST) && isset($_POST["biere"]) && isset($_POST["Quantite"]) !="") {

        $resultat = AjoutStock($_POST["biere"], $_POST["Quantite"]);
        if ($resultat) {
            echo "<br> Ajout de stock réussi";
            listerstock();
        } else {
            echo "Sur le caveau de mon père et de ma mère y a pas de stock mon copain";
        }
    }
     
} 
if (!empty($_POST) && isset($_POST["nom_biere"]) && isset($_POST["type"]) && isset($_POST["pays_biere"]) 
&& isset($_POST["prix"]) && isset($_POST["Quantite"]) && isset($_POST["image"])){
    if (!empty($_SESSION) && $_SESSION["statut"] == "admin") {
    $resultat = AjoutBiere($_POST["nom_biere"],$_POST["type"],$_POST["pays_biere"],$_POST["prix"],$_POST["image"]);
    if ($resultat){
        $resultat2 = AjoutBiere_qte($_POST["Quantite"]);
        echo"<br> Ajout de Biere réussi";
        listerbiere();
    }	
    else{
        echo "Sur le caveau de mon père et de ma mère y a pas de stock mon copain";
    }}
}
// on vérifie le GET après pour éviter le cas où on a un POST et un GET
elseif (isset($_GET['action']) && $_GET['action'] == 'inserer_stock') {
    ?>
    
    <article class="formu">
        <h1 >AJOUTER UN STOCK</h1>
        <?php
        if (!empty($_SESSION) && $_SESSION["statut"] == "admin") {
            FormulaireAjoutStock();
        }
        ?>
    </article>
    <?php
} elseif (isset($_GET['action']) && $_GET['action'] == 'inserer_biere') {
        ?>
        <article class="formu">
            <h1>AJOUTER UNE BIERE</h1>
            <?php
            if (!empty($_SESSION)){
                    if ($_SESSION["statut"] == "admin"){
                    FormulaireAjoutBiere();
                if (!empty($_POST) && isset($_POST["nom_biere"]) && isset($_POST["type"]) && isset($_POST["pays_biere"]) && isset($_POST["prix"]) && isset($_POST["Quantite"])){
                    $resultat = AjoutBiere($_POST["nom_biere"],$_POST["type"],$_POST["pays_biere"],$_POST["prix"]);
                    if ($resultat){
                        echo"<br> Ajout de Biere réussi";
                        listerbiere();
                    }	
                    else{
                        echo "Sur le caveau de mon père et de ma mère y a pas de stock mon copain";
                    }
                }
            }}
            ?>
        </article>
        <?php
        }
        
        ?>
    
    <?php
    copyrightF();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
