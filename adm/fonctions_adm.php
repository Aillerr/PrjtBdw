<?php

	require_once('../includes/connexionBD.php');

	function retour_acc() {
		 echo '<a href="retouracc.php">Retour Accueil</a>';
	}


	/* COURSES.PHP*/

	function form_courses() {
		echo "<form method='POST' action='courses.php'>
				<input type='radio' name='action_wanted' value='add' checked> Ajouter une course<br>
				<input type='radio' name='action_wanted' value='del'> Supprimer une course<br>
				<input type='submit' name='send' value='Choisir'> 
			</form>";
			if (isset($_POST['send'])) {
				switch ($_POST['action_wanted']) {
					case 'add':
						echo "<form method='POST' action='courses.php'>
								<input type='text' name='name_add' placeholder='Nom de la course'> Champ obligatoire<br>
								<input type='text' name='year_add' placeholder='Année de création'><br>
								<input type='text' name='epreuve_add' placeholder='Epreuves'><br>
								<input type='text' name='mois_add' placeholder='Mois de la course'><br>
								<input type='submit' name='send_add' value='Ajouter'><br>
							</form>";
						break;
						
					case 'del':
						echo "<form method='POST' action='courses.php'>
								<input type='text' name='id_del' placeholder='ID de la course à enlever'> Champ obligatoire<br>
								<input type='submit' name='send_del' value='Ajouter'><br>
							</form>";
						break;

					default:
						break;
				}
			}

	}

	function req_courses($choix) {
		switch ($choix) {
			case 0:
				$p_courses='DELETE FROM course WHERE "IdC" = '.$_POST['id_del']; 
				traiterRequete($p_courses);
				break;
			case 1 :
				$p_courses= //Requete pour ajouter une ligne a la table
				traiterRequete($p_courses);
				break;
			case -1:
				return;
			default:
				break;
		}

	}


	/*RESULTATS.PHP*/

	function res() {
		$p_res="SELECT * FROM resultat";
		$tab_res=traiterRequete($p_res);
		Array2Table($tab_res); 

	}




	/*ADHERENTS.PHP*/

	function adhe() {
		$p_res="SELECT * FROM adherent";
		$tab_res=traiterRequete($p_res);
		if (isset($_POST['send_del']) || isset($_POST['send_add'])) {
			if (isset($_POST['send_del']) && !empty($_POST['id_del'])) {
				$choix=0;
			}elseif (isset($_POST['send_add']) && !empty($_POST['name_add']))  {
				$choix=1;
			}else echo "Champ manquant";
		}else form_adh();
		if (isset($choix) && ($choix==1 || $choix==0)) {
			req_adh($choix);
		}

		
		Array2Table($tab_res);
		

	}

	function form_adh() {
		echo "<form method='POST' action='adherents.php'>
				<input type='radio' name='action_wanted' value='add' checked> Ajouter un adh<br>
				<input type='radio' name='action_wanted' value='del'> Supprimer un adh<br>
				<input type='submit' name='send' value='Choisir'> 
			</form>";
			if (isset($_POST['send'])) {
				switch ($_POST['action_wanted']) {
					case 'add':
						echo "<form method='POST' action='adherents.php'>
								<input type='text' name='id_add' placeholder='ID de l adherent'> Champ obligatoire<br>
								<input type='text' name='name_add' placeholder='Nom de l adherent'> Champ obligatoire<br>
								<input type='text' name='prn_add' placeholder='Prénom de l adherent'> Champ obligatoire<br>
								<input type='text' name='year_add' placeholder='Année de naissance'><br>
								<input type='text' name='sexe_add' placeholder='Sexe'> H ou F<br>
								<input type='text' name='adr_add' placeholder='Adresse'><br>
								<input type='text' name='justif_add' placeholder='Dernier justif valide'><br>
								<input type='text' name='club_add' placeholder='Club'><br>
								<input type='text' name='pseudo_add' placeholder='Psd'><br>
								<input type='text' name='pwd_add' placeholder='Pwd'><br>
								<input type='submit' name='send_add' value='Ajouter'><br>
							</form>";
						break;
						
					case 'del':
						echo "<form method='POST' action='adherents.php'>
								<input type='text' name='id_del' placeholder='ID de l adherent à enlever'> Champ obligatoire<br>
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
			case 0:
				$p_adh="DELETE FROM adherent WHERE IdA LIKE '".$_POST['id_del']."'"; 
				traiterRequete($p_adh);
				break;
			case 1 :
				$p_adh= "INSERT INTO adherent (IdA, Nom, Prenom, Date_naissance, Sexe, Adresse, Date_dernier_justif, Club, Pseudo, Pwd, Type) VALUES ('".$_POST['id_add']."', '".$_POST['name_add']."', '".$_POST['prn_add']."', '".$_POST['year_add']."', '".$_POST['sexe_add']."', '".$_POST['adr_add']."', '".$_POST['justif_add']."', '".$_POST['club_add']."', '".$_POST['pseudo_add']."', '".$_POST['pwd_add']."', '0')";
				echo $p_adh;
				traiterRequete($p_adh);
				break;
			case -1:
				return;
			default:
				break;
		}

	}

?>