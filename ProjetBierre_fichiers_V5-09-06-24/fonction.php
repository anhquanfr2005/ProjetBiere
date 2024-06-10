<?php

	session_start();

	function authentification($mail,$pass){
		$retour = false ;
		$madb = new PDO('sqlite:BDD_user/comptes.sqlite'); 
		$mail= $madb->quote($mail);
		$pass = $madb->quote($pass);
		$rq = "SELECT EMAIL,PASS FROM utilisateurs WHERE EMAIL = ".$mail." AND PASS = ".$pass ;
		//var_dump($rq);echo "<br/>";  	
		$resultat = $madb->query($rq);
		$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
		if (sizeof($tableau_assoc)!=0) $retour = true;	
		return $retour;
	}
	

	function redirect_2($url) {
		header('Location: ' . $url);
		exit();
	}

	function redirect($url,$tps)
	{
		$temps = $tps * 1000;
		
		echo "<script type=\"text/javascript\">\n"
		. "<!--\n"
		. "\n"
		. "function redirect() {\n"
		. "window.location='" . $url . "'\n"
		. "}\n"
		. "setTimeout('redirect()','" . $temps ."');\n"
		. "\n"
		. "// -->\n"
		. "</script>\n";
		
	}
		
	function isAdmin($mail){
		$retour = false ;
		try{
			// connexion à la base de données
			$madb = new PDO('sqlite:BDD_user/comptes.sqlite');
			//écriture de la requête 
			$mail= $madb->quote($mail);
			$rq = "SELECT STATUT FROM utilisateurs WHERE EMAIL = $mail";
			//execution de la requête
			$resultat = $madb->query($rq);
			//var_dump($resultat);
			//récupération des résultats
			$tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
			//var_dump($tableau_assoc);
			if ($tableau_assoc != null){
				if ($tableau_assoc['STATUT']=='admin') $retour = true;
			}	
		}
		catch(PDOException $e){
			echo "Erreur lors de l'authentification : ".$e->getMessage()."<br/>";
		}



		return $retour;	
		
	}

	function connexion_bdd(){	// A faire
		try	{ // Construire un objet PDO pour la BDD SQLITE fournie
			
			$madb = new PDO('sqlite:BDD_user/biere.sqlite');	
				
		}// fin try
		catch (Exception $e) {		
			echo "Erreur " . $e->getMessage();
		}// fin catch		
		return $madb;
	}

	function AjoutStock($biere, $stock){
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$biere= $madb->quote($biere);
		$rq = "UPDATE Stock_cave set Quantite = Quantite + $stock where NoBiere = $biere";
		$retour = $madb->exec($rq);

		return $retour;
	}
	function AjoutBiere($nom, $type, $pays, $prix,$url){
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$nom= $madb->quote($nom);
		$type= $madb->quote($type);
		$pays= $madb->quote($pays);
		$url= $madb->quote($url);
		$rq = "INSERT INTO biere (url,Brasseur, Type_Biere, Pays, prix) values ($url,$nom, $type, $pays, $prix)";
		var_dump($rq);
		$retour = $madb->exec($rq);
		return $retour;
	}
	function AjoutBiere_qte($qte){
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$rq1 = "SELECT MAX(Nobiere) as Nobiere FROM biere;";
		$tab = $madb->query($rq1);
		$result = $tab->fetch(PDO::FETCH_ASSOC);
		var_dump($result);
		$maxNobiere = $result['Nobiere'];
		$rq = "INSERT INTO Stock_cave (NoStock,Quantite,Nobiere) values ($maxNobiere,$qte, $maxNobiere)";
		var_dump($rq);
		$retour = $madb->exec($rq);
		return $retour;
	}

	function ModifierStock($biere, $stock){
		$retour=0;
		try {
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$biere= $madb->quote($biere);
		$rq = "UPDATE Stock_cave set Quantite = $stock WHERE NoBiere = $biere";
		$retour = $madb->exec($rq);
	}
	catch (PDOException $e) {
		echo "Erreur lors de l'authentification : ".$e->getMessage()."<br/>";
		
		}
	return $retour;
}
	
function SupprimerBiere($NoB){
	$madb = new PDO('sqlite:BDD_user/biere.sqlite');
	$rq = "DELETE FROM biere where NoBiere = $NoB";
	$retour = $madb->exec($rq);

	return $retour;
}
	function SupprimerStock($NoStock){
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$rq = "DELETE FROM Stock_cave where NoStock = $NoStock";
		$retour = $madb->exec($rq);

		return $retour;
	}
	function listerstock(){
		$retour = false;
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$rq = "SELECT B.Brasseur, Quantite from Stock_cave as S inner join Biere as B on S.NoBiere = B.NoBiere";
		$res = $madb->query($rq);
		$tab = $res->fetchAll(PDO::FETCH_ASSOC);
		if ($tab !=  null){
			afficheTableau($tab);
			$retour = true;
		}
	}
	function listerstockV2(){
		$retour = false;
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$rq = "SELECT * from Stock_cave";
		$res = $madb->query($rq);
		$tab = $res->fetchAll(PDO::FETCH_ASSOC);
		if ($tab !=  null){
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
			$retour = true;
		}
	}
	function listerbiere(){
		$retour = false;
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$rq = "SELECT * from biere";
		$res = $madb->query($rq);
		$tab = $res->fetchAll(PDO::FETCH_ASSOC);
		if ($tab !=  null){
			afficheTableau($tab);
			$retour = true;
		}
	}
	function listerstockSup(){
		$retour = false;
		$madb = new PDO('sqlite:BDD_user/biere.sqlite');
		$rq = "SELECT NoStock, B.Brasseur, Quantite from Stock_cave as S inner join Biere as B on S.NoBiere = B.NoBiere";
		$res = $madb->query($rq);
		$tab = $res->fetchAll(PDO::FETCH_ASSOC);
		if ($tab !=  null){
			afficheTableau($tab);
			$retour = true;
		}
	}
	
	function affichB(){
		$retour = false ;
		try{
			// connexion à la base de données
			$madb = new PDO('sqlite:BDD_user/biere.sqlite');
			//écriture de la requête 
			//$image= $madb->quote($image);
			$rq = "SELECT url,Brasseur,Pays,Type_Biere,quantite,prix FROM Biere as B inner join stock_cave as SC on B.nobiere = SC.nobiere order by quantite asc limit 5 ;";
			//execution de la requête
			$resultat = $madb->query($rq);
			//var_dump($resultat);
			//récupération des résultats
			$tab = $resultat->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($tab);
			/*echo '<tr>';// les entetes des colonnes qu'on lit dans le premier tableau par exemple
			foreach($tab[0] as $colonne=>$valeur){
				if ($colonne == 'url' ){
					echo "<th></th>";}
					if ($colonne == 'Brasseur' || $colonne == 'Pays' || $colonne == 'Type_Biere' || $colonne == 'Quantite'){
						echo "<th>$colonne</th>";}	}
			echo "</tr>\n";*/
			// le corps de la table
			
			echo '<div class="container">
				<div class="row">';
			foreach($tab as $index => $ligne){
				// Début d'une nouvelle ligne toutes les 4 cartes
				if ($index % 3 == 0 && $index != 0) {
					
					echo '<div class="row"></div>';
					
				}
				foreach($ligne as $key => $cellule) {
					if ($key == 'url') {
						echo '<div class="col-md-4">
							<div class="card" style="width: 89%; margin-bottom: 6%;">
								<img style="width: 200px; height: 200px;" src="'.$cellule.'" class="card-img-top" alt='.$cellule.'>';
					} elseif ($key == 'Brasseur') {
						echo '<div class="card-body">
								<h5 style= "text-align: center;" class="card-title">'.$cellule.'</h5><br>';
					} elseif ($key == 'Quantite') {
								echo '<button type="button" class="btn btn-outline-dark"> Quantité : '.$cellule.'</button>';
					} elseif ($key == 'Pays') {
						echo '<button type="button" class="btn btn-outline-info">'.$cellule.'</button>';
			} elseif ($key == 'prix') {
				echo '<button type="button" class="btn btn-outline-secondary">'.$cellule.'$</button>';
	}
				}
				
				// Assuming the rest of the card body is the same for all cards
				echo '</div>
					</div>
				</div>
				';}

		}
		catch(PDOException $e){
			echo "Erreur lors de l'authentification : ".$e->getMessage()."<br/>";
		}



		return $retour;	
		
	}

	function listefiltrerBiere($type)
{
	$retour=false;
	$madb = new PDO('sqlite:BDD_user/biere.sqlite');
	$type = $madb->quote($type);
	$rq = "SELECT url,Brasseur,Pays,Type_Biere,quantite,prix FROM Biere as B inner join stock_cave as SC on B.nobiere = SC.nobiere where lower(B.Type_Biere) =".$type;
	$resultat = $madb->query($rq);
	
	$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC); 

	if (sizeof($tableau_assoc)!=0) $retour = $tableau_assoc;
	return $retour;
}




if (isset($_POST["action"]) && ($_POST["action"]=="1") && $_POST['cap']== $_SESSION['code']) {
	insertBiere();
	listerstockV2();
}
if (isset($_POST["action"]) && ($_POST["action"]=="1") && $_POST['cap'] != $_SESSION['code']) {
	echo "Erreur captcha incorrect";
}
function insertBiere(){
	$retour=false;
	$madb = new PDO('sqlite:BDD_user/biere.sqlite');
	$qte = $_POST['qte'];
	$biere = $_POST['biere'];
	$rq = "UPDATE Stock_cave set Quantite = $qte WHERE NoBiere = $biere";
	$resultat = $madb->exec($rq);
	if ($resultat){
		echo "Modification effectuée pour : ID biere = $biere, Quantité = $qte";
	}
}

if (isset($_POST["action"]) && ($_POST["action"]=="2") && $_POST['cap']== $_SESSION['code']) {
	supprBiere();
	listerstockV2();
}
if (isset($_POST["action"]) && ($_POST["action"]=="2") && $_POST['cap'] != $_SESSION['code']) {
	echo "Erreur captcha incorrect";
}
function supprBiere(){
	$retour=false;
	$madb = new PDO('sqlite:BDD_user/biere.sqlite');
	$supprbiere = $_POST['supprbiere'];
	$rq = "DELETE FROM Biere where NoBiere = $supprbiere";
	$resultat = $madb->exec($rq);
	if ($resultat){
		echo "Suppression de la bière effectuée pour : pour la bière = $supprbiere";
	}
}

if (isset($_POST["action"]) && ($_POST["action"]=="3")) {
	$biere = $_POST['biere'];
	$rq = "SELECT * FROM Biere where Brasseur = $biere";
	$resultat = $madb->query($rq);
	
	$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC); 
}
?>
