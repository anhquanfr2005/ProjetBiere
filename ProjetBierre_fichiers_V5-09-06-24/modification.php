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
		<title>Index</title>
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
            <h1>Que voulez vous ajouter ?</h1>
            <ul>
                <li><a href="modification.php?action=modifier_biere" title="biere">modifier une bière</a></li>
                <li><a href="modification.php?action=modifier_stock" title="stock">modifier un stock</a></li>
            </ul>
        </article>

        <?php 
    if (!empty($_POST) && isset($_POST["biere"]) && isset($_POST["Quantite"]) && isset($_POST["captcha"])){
        if (!empty($_SESSION) && $_SESSION["statut"] == "admin") {
        if(!empty($_POST) && $_POST['captcha']==$_SESSION['code']){
            $resultat = ModifierStock($_POST["biere"], $_POST["Quantite"]);
            echo"<br> Changement de stock réussi";
            listerstock();
            //ici vous traitez le formulaire
            } else {
            echo "Code captcha est incorrecte";
            redirect("modification.php?action=modifier_stock",1);
            //ici vous faites un "echo" pour avertir qu'il y a une erreur
        }}
    }else{
    }
        ?>
        <?php
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'modifier_stock') {
        if (!empty($_SESSION)){
                    if ($_SESSION["statut"] == "admin"){
                    FormulaireModifStock();
            }}
        ?>

        <?php
            }
            
            elseif ($_GET['action'] == 'modifier_biere') {
        ?>
        <?php
        if (!empty($_SESSION)){
                    if ($_SESSION["statut"] == "admin"){
                    FormulaireModbiere();
                    ?> <a href="modification.php?action=modifier_biere_nom_biere" title="Modifier">Modifier</a> <?php
                    }
        ?>
    
    <?php
        }
        elseif ($_GET['action'] == 'modifier_biere_nom_biere'){
        ?>
        <?php
        if (!empty($_SESSION)){
                    if ($_SESSION["statut"] == "admin"){
                    FormulaireModifbiere($NoB);
                    var_dump($_POST);
                    if(!empty($_POST) && isset($_POST["captcha"]) ){
                        if($_POST['captcha']==$_SESSION['code']){
                        #$resultat = ModifierBiere($_POST["biere"]);
                        echo"<br> Changement de stock réussi";
                        listerstock();
                        }else{
                        echo "Code captcha est incorrecte";
                        }//ici vous traitez le formulaire
                    } else {
                        //ici vous faites un "echo" pour avertir qu'il y a une erreur
                    }
                }else{
                }
            }}
        ?>
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
