<?php
	require_once('./includes/connexionBD.php');
	function adhe() {
		
		//On regarde si l'utilisateur veut ajouter ou supprimer un adhérent, et on affecte un paramètre pour effectuer la bonne requête dans req_adh
		if (isset($_POST['send_del']) || isset($_POST['send_add'])) {
			if (isset($_POST['send_del']) && !empty($_POST['id_del'])) {
				$choix=0;
			}elseif (isset($_POST['send_add']) && !empty($_POST['name_add']))  {
				$choix=1;
			}else echo "Champ manquant";
		} 
		form_adh();

		//Appel de la fonction de modif si on peut
		if (isset($choix) && ($choix==1 || $choix==0)) {
			req_adh($choix);
		}

		//Affichage de tous les adhérents
		$p_res="SELECT * FROM adherent ORDER BY IdA ASC";
		$tab_res=traiterRequete($p_res);
		Array2Table($tab_res);
	}

	function form_adh() {

		//Formulaire de choix d'action
		echo "<form method='POST' action='espaceperso.php'>
				<input type='radio' name='action_wanted' value='add' checked> Ajouter un adh<br>
				<input type='radio' name='action_wanted' value='del'> Supprimer un adh<br>
				<input type='submit' name='send' value='Choisir'> 
			</form>";

			//Si on a choisi l'action, montre un autre formulaire en fonction de l'action choisie
			if (isset($_POST['send'])) {
				switch ($_POST['action_wanted']) {
					case 'add':
						echo "<form method='POST' action='espaceperso.php'>
								<input type='text' name='id_add' placeholder='ID de l adherent' required=''><br>
								<input type='text' name='name_add' placeholder='Nom de l adherent' required=''><br>
								<input type='text' name='prn_add' placeholder='Prénom de l adherent' required=''><br>
								<input type='text' name='year_add' placeholder='Année de naissance' required=''><br>
								<input type='text' name='sexe_add' placeholder='Sexe' required=''> H ou F<br>
								<input type='text' name='adr_add' placeholder='Adresse' required=''><br>
								<input type='text' name='certif_add' placeholder='Dernier certificat valide' required=''><br>
								<input type='text' name='club_add' placeholder='Club' required=''><br>
								<input type='text' name='ident_add' placeholder='Identifiant' required=''><br>
								<input type='text' name='pwd_add' placeholder='Pwd' required=''><br>
								<input type='submit' name='send_add' value='Ajouter' required=''><br>
							</form>";
						break;
						
					case 'del':
						echo "<form method='POST' action='espaceperso.php'>
								<input type='text' name='id_del' placeholder='ID de l adherent à enlever' required=''><br>
								<input type='submit' name='send_del' value='Ajouter'><br>
							</form>";
						break;

					default:
						break;
				}
			}
	}

	function req_adh($choix) {
		switch ($choix) {

			//Supprime l'adhérent donné
			case 0:
				$p_adh="DELETE FROM adherent WHERE IdA LIKE '".$_POST['id_del']."'"; 
				traiterRequete($p_adh);
				break;

			//Ajoute un adhérent
			case 1 :
				$p_adh= "INSERT INTO adherent (IdA, Nom, Prenom, Date_naissance, Sexe, Adresse, dateCertif, Club, Identifiant, Pwd, Type) VALUES (".$_POST['id_add'].", '".$_POST['name_add']."', '".$_POST['prn_add']."', '".$_POST['year_add']."', '".$_POST['sexe_add']."', '".$_POST['adr_add']."', '".$_POST['certif_add']."', '".$_POST['club_add']."', '".$_POST['ident_add']."', '".$_POST['pwd_add']."', 0)";
				traiterRequete($p_adh);
				break;
			default:
				break;
		}
	}
?>