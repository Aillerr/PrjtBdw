<?php
	require_once('./includes/connexionBD.php');
	function list_adh() {

		$p_res="SELECT * FROM adherent ORDER BY IdA ASC";
		modif();

		//Affichage de tous les adhérents
		$tab=traiterRequete($p_res);
		Array2Table($tab);
	}

	function modif() {

		//Formulaire de modification d'un profil d'adhérent
		echo "<form method='POST' action='espaceperso.php'>
						<input type='text' name='id_correct' placeholder='ID de l adherent à selectionner' required=''><br>
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
							<option>Type
						</select>
						<input type='submit' name='modifsend' value='Valider'/>
					</form>";

		//Si le formulaire de mise à jour de l'adhérent a bien été rempli, on envoie la modification à la bdd
		if (isset($_POST["modifsend"]) && !empty($_POST["nveau"]) && isset($_POST['id_correct']) ) {
					$p_m="UPDATE adherent SET ".$_POST['attribut']." = '".$_POST['nveau']. "' WHERE IdA LIKE ".$_POST['id_correct'];
					traiterRequete($p_m);
					echo "Modif effectuée";
				}
	}

?>