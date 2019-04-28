<?php
	require_once('./includes/connexionBD.php');
	function fiche() {
		$p_res="SELECT IdA, nom, prenom, Date_naissance, sexe, Adresse, dateCertif, club, Identifiant, pwd FROM adherent WHERE Identifiant LIKE '".$_SESSION["slogin"]."'";
		modif_fiche();	
		
		//On affiche les informations de l'adhérent, sauf son type
		$tab=traiterRequete($p_res);
		Array2Table($tab);
	}

	function modif_fiche() {
		//Formulaire pour savoir ce que l'adhérent veut modifier, et puisse entrer la modification
		echo "<form method='POST' action='espaceperso.php'>
						<input type='text' name='nveau' placeholder='Entrez la modification'/>
						<select name='attribut'	size='1'>
							<option>Nom
							<option>Prenom
							<option>Date_naissance
							<option>Sexe
							<option>Adresse
							<option>dateCertif
							<option>Club
							<option>Identifiant
							<option>Pwd
						</select>
						<input type='submit' name='modifsend' value='Valider'/>
					</form>";

		//Si le formulaire a été soumis, on effectue la modif donnée
		if (isset($_POST["modifsend"]) && !empty($_POST["nveau"]) && isset($_SESSION['slogin']) ) {
					$p_m="UPDATE adherent SET ".$_POST['attribut']." = '".$_POST['nveau']. "' WHERE Identifiant LIKE '".$_SESSION['slogin']."'";
					
					traiterRequete($p_m);
					echo "Modif effectuée";
				}
	}
?>