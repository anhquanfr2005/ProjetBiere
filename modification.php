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
		<title>Index</title>
	</head>
	<body class="coboy">
        <header>
        <?php
                if (!empty($_SESSION) && isAdmin($_SESSION["login"]) == false) {
                    echo "<h3 class='non'>Vous n'êtes ne vous êtes pas connecter ou vous n'avez pas les droits pour accéder à cette pages vous allez être rediriger vers la page index.</h3>";
                    redirect('index.php',1);
                }
                    if (empty($_SESSION)) {
                        echo "<h3 class='non'>Vous n'êtes ne vous êtes pas connecter ou vous n'avez pas les droits pour accéder à cette pages vous allez être rediriger vers la page index.</h3>";
                        redirect('connexion.php',1);
                }?>
        </header>
        <nav>
			<?php
            Choix();
            ?>
        </nav>
        <section class="mod">
            <h1 class= "ti" >Modification</h1>
        </section>
        <article>
            <h1>Que voulez vous ajouter ?</h1>
            <ul>
            <li><a style="font-weight: bold;" class="btn btn-outline-primary" href="modification.php?action=modifier_biere" title="biere" role="button">modifier une bière</a></li>
            </ul>
        </article>
    <aside class="as">
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
                        $id = $_POST["NoB"];
                        ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <fieldset> 
                            <label for="id_biere">Biere :</label>
                            <select id="id_biere" name="biere" size="1">
                                <?php // on se sert de value directement pour l'insertion
                                $madb2 = new PDO("sqlite:BDD_user/biere.sqlite");
                                $rq = "SELECT DISTINCT NoBiere, Brasseur from Biere";
                                $res = $madb2->query($rq);
                                $tab = $res->fetchAll(PDO::FETCH_ASSOC);

                                $rq2 = "SELECT * from Biere where NoBiere = $id";
                                $res2 = $madb2->query($rq2);
                                $tab2 = $res2->fetchAll(PDO::FETCH_ASSOC);

                                $rq3 = "SELECT * from Stock_cave where NoBiere = $id";
                                $res3 = $madb2->query($rq3);
                                $tab3 = $res3->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($tab as $key => $value){
                                    if ($value['NoBiere'] == $id){
                                    echo '<option value= '.$value['NoBiere'].'>'.$value['Brasseur'].'</option>';
                                }
                            }

                                foreach ($tab2 as $key => $va){
                                echo '<label for="prix">Prix actuelle : </label><input type="text" value='.$va['prix'].' name="Quantite" id="prix" >$<br>';
                                echo '<br><label for="pays">En provenance de : </label><input type="text" value='.$va['Pays'].' name="Quantite" id="pays" ><br>';
                                }
                                foreach ($tab3 as $k => $v){
                                    echo '<br><label for="id_quant">Nombre de bière dans le stock : </label><input type="text" value='.$v['Quantite'].' name="Quantite" id="id_quant" autofocus><br>';
                                    }
                                ?>
                            </select>
                            <label for="typebiere"> Type de Biere :</label>
                            <select name="type_B" id="typebiere">
                            <?php // on se sert de value directement pour l'insertion
						$madb = new PDO("sqlite:BDD_user/biere.sqlite");
						$rq4 = "SELECT NoBiere,Type_Biere from Biere group by Type_Biere ";
						$res4 = $madb->query($rq4);
						$tab4 = $res4->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($tab4 as $key => $value){
                        if ($value['NoBiere'] == $id){
                        echo '<option value= '.$value['Type_Biere'].'>'.$value['Type_Biere'].'</option>';
                        }
                }
                foreach ($tab4 as $key => $value){
                    if ($value['NoBiere'] != $id){
                    echo '<option value= '.$value['Type_Biere'].'>'.$value['Type_Biere'].'</option>';
                    }
            }
						?>
                            </select>
                            <br>
                            <input type="text" id="cap" name="captcha">
                            <img id="captchaImage" src="captchaimg.php" onclick="this.src='captchaimg.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
                            <br>
                            <button type="button" value='1' onclick="inse(this);">insert</button>
                            

                        </fieldset>
                    </form>
        <?php
        }}
            }
            
            elseif ($_GET['action'] == 'modifier_biere') {
        ?>
        <?php
        if (!empty($_SESSION)){
                    if ($_SESSION["statut"] == "admin"){
                    FormulaireModbiere();
                    ?>
                     <?php
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
    <p id="message"></p>
    </aside>

<br><br>
<?php
    copyrightF();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
