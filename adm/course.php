<?php session_start() ; ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="css/.css">
			<?php 
				
				require_once('../includes/connexionBD.php');

			?>
			<title>Accueil</title>
		</head>
		<body>
			<?php
				echo "<form method='POST' action='course.php'>
						<input type='text' name='amodif' placeholder='Entrez la course à modifier'/>
						<input type='text' name='nveau' placeholder='Entrez la modification'/>
						<select name='attribut'	size='1'>
							<option>Nom
							<option>Annee_creation
							<option>Epreuves
							<option>Mois
						</select>
						<input type='submit' name='modifsend' />
					</form>";

				if (isset($_POST["modifsend"]) && !empty($_POST["nveau"]) && !empty($_POST["amodif"]) && isset($_POST['attribut'])) {
					$p_m='UPDATE course SET '.$_POST["modifsend"]." = ".$_POST["nveau"]. ' WHERE IdC = '.$_POST["amodif"];
				
					traiterRequete($p_m);
				}else echo "Tous les champs doivent être renseignés";
				 echo '<a href="retouracc.php">Retour Accueil</a>';
			?>
			
		</body>
	</html>
