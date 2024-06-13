<?php

	function Formulaireconnection(){
	?>

	
	<section id="re">
	<h2 id="c">Bienvenue à la Tavern</h2>	
		<img id = "Connection" src="./imge/LOGO-TAVERN.png" alt="logo">
			<form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return carac_mdp()">
				<fieldset>
					<label  class="tex" for="id_mail">Adresse Mail : </label><br>
					<input type="email" name="login" class="form-control" id="id_mail" placeholder="exemple@mail.fr" required size="20">
					<br>
					<label class="tex" for="id_pass">Mot de passe : </label><br>
					<input type="password" name="pass" class="form-control" id="id_pass" placeholder="********" required size="20"><br>
					<input type="checkbox" onclick="togglePasswordVisibility()"> Afficher le mot de passe<br>
					<p id="msge" class="erreur"></p>
					<input type="submit" name="connect" value="Connexion">
					
				</fieldset>
			</form>
		<br>
	</section>

<?php
    }
	function Choix(){

		//echo 'Vous êtes connecté en tant que : '.$_SESSION["login"].'<br>';
	?>
		<div id ="boi" class="navbar navbar-expand-xl navbar-dark fixed-top bg-dark">
          <div class="container-xl">
			
            <a href="index.php" class="d-flex align-items-center"><img style="width: 100px;" src="./imge/LOGO-TAVERN.png" alt="logo"></a>
            <p id="to">connecté en tant que : <?php echo $_SESSION["login"]; ?></p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Liste de Liens de navigation pour passer sur les autres pages -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav me-auto mb-2 mb-md-0">
				<?php if ($_SESSION['statut'] == "admin"){
			 if (basename($_SERVER['PHP_SELF']) != 'index.php') {
				?>
                <li class="nav-item">
				<a href="index.php" title="Modifier un utilisateur">retour à l'accueil</a></li>
				<?php
		}
		if (basename($_SERVER['PHP_SELF']) != 'insertion.php') {
		?>
                <li class="nav-item">
                  <a style="color: greenyellow;" href="insertion.php?action=inserer_utilisateur" title="Insérer un utilisateur">Ajouter</a></li>
				  <?php
		}
		if (basename($_SERVER['PHP_SELF']) != 'suppression.php') {
		?>
				  <li class="nav-item">
				  <a style="color: red;" href="suppression.php?action=supprimer_utilisateur" title="Supprimer un utilisateur">Supprimer</a></li>	
					<?php
		}
		if (basename($_SERVER['PHP_SELF']) != 'modification.php') {
		?>
                <li class="nav-item">
				<a style="color: rgb(0, 162, 255);" href="modification.php?action=modifier_utilisateur" title="Modifier un utilisateur">Modifier</a></li>	
		<?php
		}
	}
		?>  
              </ul>
                  <form class="d-flex">
				  <a href="connexion.php?action=logout" id="ho" role="button" class="btn btn-outline-warning btn-lg">Se déconnecter</a>
                  </form>
            </div>
          </div>
      </div>
			

	
	<?php
	}


 
	function FormulaireAjoutStock(){

	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset> 
			<label for="id_biere">Biere :</label>
			<select id="id_biere" name="biere" size="1">
				<?php // on se sert de value directement pour l'insertion
				$madb = new PDO("sqlite:BDD_user/biere.sqlite");
				$rq = "SELECT DISTINCT NoBiere, Brasseur from Biere";
				$res = $madb->query($rq);
				$tab = $res->fetchAll(PDO::FETCH_ASSOC);

				foreach ($tab as $key => $value){
					echo '<option value= '.$value['NoBiere'].'>'.$value['Brasseur'].'</option>';
				}
				?>
			</select>
			<br>
			<label for="id_stock">Quantite à rajouter : </label><input type="integer" name="Quantite" id="id_quant"/><br />
			<input type="submit" value="Insérer"/>
		</fieldset>
	</form>
	<?php
		echo "<br/>";
	}

	function FormulaireAjoutBiere(){

		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset> 
				<label for="id_nom">Biere :</label>
				<input type="text" name="nom_biere" id="id_nom"><br>
				<label for="id_type">Type de biere :</label>
				<select id="id_type" name="type" size="1">
				<option selected>--</option>
				<option value="blanche">blanche</option>
				<option value="blonde">blonde</option>
				<option value="ambree">ambree</option>
				<option value="abbaye">abbaye</option>
				<option value="aromatisee">aromatisee</option>
				</select><br>
				<label for="id_pays">Pays :</label>
				<input type="text" name="pays_biere" id="id_pays"><br>
				<label for="id_prix">Prix : </label><input type="number" name="prix" id="id_prix">€<br>
				<label for="id_quant">Quantite de départ : </label><input type="number" name="Quantite" id="id_quant"><br>
				<label for="id_quant">Collez un Url ici pour ajouter une image</label><input type="text" name="image" id="id_quant"><br>
				<input type="submit" value="Insérer">
			</fieldset>
		</form>
		<?php
			echo "<br>";
		}

	function FormulaireModifStock(){

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
	
					foreach ($tab as $key => $value){
						echo '<option value= '.$value['NoBiere'].'>'.$value['Brasseur'].'</option>';
					}
					?>
					
				</select>
				<br>
				<label for="id_quant">Nombre de bière dans le stock : </label><input type="number" name="Quantite" id="id_quant" autofocus><br>
				<input type="text" id="cap" name="captcha">
				<img id="captchaImage" src="captchaimg.php" onclick="this.src='captchaimg.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
				<br>
				<button type="button" value='1' onclick="inse(this);">insert</button>
				<p id="m"></p>
			</fieldset>
		</form>
		<?php
			echo "<br>";
		}
	
		function FormulaireModbiere(){

			?>
			<form action="modification.php?action=modifier_stock" method="post">
				<fieldset> 
					<label for="id_biereNo">Biere :</label>
					<select id="id_biereNo" name="NoB" size="1">
						<?php // on se sert de value directement pour l'insertion
						$madb = new PDO("sqlite:BDD_user/biere.sqlite");
						$rq = "SELECT DISTINCT NoBiere, Brasseur from Biere";
						$res = $madb->query($rq);
						$tab = $res->fetchAll(PDO::FETCH_ASSOC);
		
						foreach ($tab as $key => $value){
							echo '<option value= '.$value['NoBiere'].'>'.$value['Brasseur'].'</option>';
						}
						?>
					</select>
					<br>
					<input type="submit" name="submit" value="Modifier">
				</fieldset>
			</form>
			<?php
				echo "<br>";
			}

		function FormulaireSupStock(){

			?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<fieldset style="margin-left:12%;"> 
					<label for="id_stock">Stock :</label>
					<select id="id_stock" name="NoStock" size="1">
						<?php // on se sert de value directement pour l'insertion
						$madb = new PDO("sqlite:BDD_user/biere.sqlite");
						$rq = "SELECT DISTINCT NoStock, B.Brasseur,B.NoBiere, Quantite from Stock_cave as S inner join Biere as B on S.NoBiere = B.NoBiere";
						$res = $madb->query($rq);
						$tab = $res->fetchAll(PDO::FETCH_ASSOC);
		
						foreach ($tab as $key => $value){
							echo '<option value= '.$value['NoBiere'].'>'.$value['NoStock'].' -> '.$value['Brasseur'].'->'.$value['Quantite'].'</option>';
						}
						?>
					</select>
					<br>
					<input type="text" id="capa" name="captcha">
					<img id="captch" src="captchaimg.php" onclick="this.src='captchaimg.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
					<br>
					<button type="button" value='2' onclick="suppr(this);">Supprimer</button>
					<p id="message"></p>
				</fieldset>
			</form>
			<?php
				echo "<br><br><br>";
			}
			
			function FormulaireChoixBiere(){
				?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<fieldset> 
						<label for="id_biereNo">Biere :</label>
						<select id="id_biereNo" name="NoB" size="1">
							<?php // on se sert de value directement pour l'insertion
							$madb = new PDO("sqlite:BDD_user/biere.sqlite");
							$rq = "SELECT DISTINCT NoBiere, Brasseur from Biere";
							$res = $madb->query($rq);
							$tab = $res->fetchAll(PDO::FETCH_ASSOC);
			
							foreach ($tab as $key => $value){
								echo '<option value= '.$value['NoBiere'].'>'.$value['Brasseur'].'</option>';
							}
							?>
						</select>
						<br>
						<input type="submit" name="submit" value="Supprimer"/>
					</fieldset>
				</form>
				<?php
					echo "<br/>";
				}
		function choixType(){
			?>


						<?php // on se sert de value directement pour l'insertion
						$madb = new PDO("sqlite:BDD_user/biere.sqlite");
						$rq4 = "SELECT Type_Biere from Biere group by Type_Biere";
						$res4 = $madb->query($rq4);
						$tab4 = $res4->fetchAll(PDO::FETCH_ASSOC);
		
						foreach ($tab4 as $key => $value){
							echo '<option value= '.$value['Type_Biere'].'>'.$value['Type_Biere'].'</option>';
						}
						?>
		
			<?php
				echo "<br/>";
			}
			
	function afficheTableau($tab){
		echo '<table>';	
		echo '<tr>';// les entetes des colonnes qu'on lit dans le premier tableau par exemple
		foreach($tab[0] as $colonne=>$valeur){		echo "<th>$colonne</th>";		}
		echo "</tr>\n";
		// le corps de la table
		foreach($tab as $ligne){
			echo '<tr>';
			foreach($ligne as $cellule)		{		echo "<td>$cellule</td>";		}
			echo "</tr>\n";
		}
		echo '</table>';
	}

	function afficheindex(){
		if ($_SESSION['statut'] == "admin"){
			echo '<h1 class="textes">Accueil</h1>';
			echo '<h2 class="textes">Ces 5 bières ci-dessous sont les plus vendues et risquent d\'être en rupture de stock</h2>';
		} else {
			echo '<h1 class="textes">Accueil</h1>';
			echo '<h2 class="textes">Top 5 de nos bières les plus vendues</h2>';
		}
	}
	function captcha(){
		?> 
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="text" name="captcha"/>
		<img src="captchaimg.php" onclick="this.src='captchaimg.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
		
		<?php if(isset($_POST['captcha'])){
			if($_POST['captcha']==$_SESSION['code']){
				echo "Code correct";
				//ici vous traitez le formulaire
				} else {
				echo "Code incorrect";
				//ici vous faites un "echo" pour avertir qu'il y a une erreur
			}
		}
		?>
		<br/>
		<br/>
		<input type="submit" name="submit">
		</form>
		<?php
	}

function afficheformbiereAJAX()
{
	$madb = new PDO("sqlite:BDD_user/biere.sqlite");
	$rq = "SELECT DISTINCT Type_Biere from Biere";
	$res = $madb->query($rq);
	$tab = $res->fetchAll(PDO::FETCH_ASSOC);
?>
	<form method="post">
		<fieldset>
			<label for="id_ville">Trouvez la Perle rare</label>
			<select id="id_ville" name="typeB" size="1" onchange="listeFiltreUtilisateurs(this);">
				<option value="0" >Choisir un type de bière</option>
				<?php
				foreach ($tab as $ligne) {
					echo '<option value="' . $ligne["Type_Biere"] . '">' . $ligne["Type_Biere"] . "</option>" . "\n";
				}
				?>
			</select>
		</fieldset>
	</form>
	<br>
<?php
} // fin afficheFormulaireEtudiantParVille

function copyrightF(){
	echo '<footer>';
	echo '<p>Copyright &copy;2024 by NGUYEN & ROINET</p>';
	echo '</footer>';
}

?>