<?php
include 'fonction.php';
include 'Formulaire.php';

if (!empty($_POST) && isset($_POST["typeB"])) {
    // appel de la fonction qui retourne seulement les étudiants de la ville choisie
    $tab = listefiltrerBiere($_POST['typeB']);
    if ($tab) {
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
					<div class="card" style="width: 89%; margin-bottom: 5%;">
						<img style="width: 190px; height: 190px;" src="'.$cellule.'" class="card-img-top" alt='.$cellule.'>';
			} elseif ($key == 'Brasseur') {
				echo '<div class="card-body">
						<h5 style= "text-align: center;" class="card-title">'.$cellule.'</h5><br>';
			} elseif ($key == 'Quantite') {
						echo '<button type="button" class="btn btn-outline-secondary"> Quantité : '.$cellule.'</button>';
			} elseif ($key == 'Pays') {
				echo '<button type="button" class="btn btn-outline-secondary">'.$cellule.'</button>';
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
}
?>