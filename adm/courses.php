<?php
	require_once('./includes/connexionBD.php');
	function crses () {
				echo "<h2>Ajouter/Supprimer une course</h2>";
				if (isset($_POST['send_del']) || isset($_POST['send_add'])) {
					if (isset($_POST['send_del']) && !empty($_POST['id_del'])) {
						$choix=0;
					}elseif (isset($_POST['send_add']) && !empty($_POST['name_add']))  {
						$choix=1;
					}else echo "Champ manquant";
				}
				form_courses();
				if (isset($choix) && ($choix==1 || $choix==0 )) {
					req_courses($choix);
				}

				$p_c='SELECT * FROM course';
				$tab=traiterRequete($p_c);
				Array2Table($tab);
				echo "<br><h2>Ajouter/Supprimer une édition de course</h2>";
				if (isset($_POST['send_del_edt']) || isset($_POST['send_add_edt'])) {
					if (isset($_POST['send_del_edt']) && !empty($_POST['id_del_edt'])) {
						$choix=2;
					}elseif (isset($_POST['send_add_edt']) && !empty($_POST['idc_add_edt']))  {
						$choix=3;
					}else echo "Champ manquant";
				}
				form_edt();
				if (isset($choix) && ($choix==2 || $choix==3)) {
					req_courses($choix);
				}
				
				$p_edt="SELECT * FROM edition";
				$tab_edt=traiterRequete($p_edt);
				Array2Table($tab_edt);				
	}

	function form_courses() {
		echo "<form method='POST' action='espaceperso.php'>
				<input type='radio' name='action_wanted' value='add' checked > Ajouter une course<br>
				<input type='radio' name='action_wanted' value='del'> Supprimer une course<br>
				<input type='submit' name='send' value='Choisir'> 
			</form>";
			if (isset($_POST['send'])) {
				switch ($_POST['action_wanted']) {
					case 'add':
						echo "<form method='POST' action='espaceperso.php'>
								<input type='text' name='name_add' placeholder='Nom de la course' required=''><br>
								<input type='text' name='year_add' placeholder='Année de création' required=''><br>
								<input type='text' name='mois_add' placeholder='Mois de la course' required=''><br>
								<input type='submit' name='send_add' value='Ajouter'><br>
							</form>";
						break;
						
					case 'del':
						echo "<form method='POST' action='espaceperso.php'>
								<input type='text' name='id_del' placeholder='ID de la course à enlever' required=''><br>
								<input type='submit' name='send_del' value='Ajouter'><br>
							</form>";
						break;

					default:
						break;
				}
			}
	}

	function form_edt () {
		echo "<form method='POST' action='espaceperso.php'>
				<input type='radio' name='action_wanted' value='add_edt' checked> Ajouter une édition<br>
				<input type='radio' name='action_wanted' value='del_edt'> Supprimer une édition<br>
				<input type='submit' name='send_edt' value='Choisir'> 
			</form>";
			if (isset($_POST['send_edt'])) {
				switch ($_POST['action_wanted']) {
					case 'add_edt':
						echo "<form method='POST' action='espaceperso.php'>
								<input type='text' name='idc_add_edt' placeholder='Numéro de la course' required=''><br>
								<input type='text' name='year_add_edt' placeholder='Année de l édition' required=''><br>
								<input type='text' name='nbpart_add_edt' placeholder='Nombre de participants' required=''><br>
								<input type='text' name='plan_add_edt' placeholder='Plan de l édition' required=''><br>
								<input type='text' name='adep_add_edt' placeholder='Adresse de départ de l édition' required=''><br>
								<input type='text' name='dati_add_edt' placeholder='Date lim inscriptions de l édition' required=''><br>
								<input type='text' name='datd_add_edt' placeholder='Date lim dépôt de l édition' required=''><br>
								<input type='text' name='datr_add_edt' placeholder='Date récupération dossard de l édition' required=''><br>
								<input type='text' name='site_add_edt' placeholder='Site de l édition' required=''><br>
								<input type='text' name='tarif_add_edt' placeholder='Tarifs de l édition' required=''><br>
								<input type='submit' name='send_add_edt' value='Ajouter'><br>
							</form>";
						break;
						
					case 'del_edt':
						echo "<form method='POST' action='espaceperso.php'>
								<input type='text' name='id_del_edt' placeholder='ID de l édition à enlever' required=''><br>
								<input type='submit' name='send_del_edt' value='Ajouter'><br>
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
				$p_courses="DELETE FROM course WHERE IdC LIKE '".$_POST['id_del']."'"; 
				traiterRequete($p_courses);
				break;
			case 1 :
				$p_idc='SELECT MAX(IdC) FROM course';
				$tab1=traiterRequete($p_idc);
				$id=$tab1[1]['MAX(IdC)']+1;
				$p_courses="INSERT INTO course (IdC, Nom, Annee_creation, Mois) VALUES (".$id.", '".$_POST['name_add']."', ".$_POST['year_add'].", '".$_POST['mois_add']."')";
				;
				traiterRequete($p_courses);
				break;
			case 3:
				$p_ide="SELECT MAX(IdE) FROM edition";
				$tab1=traiterRequete($p_ide);
				$id=$tab1[1]['MAX(IdE)']+1;
				$p_courses="INSERT INTO edition (IdE, IdC, Annee, Nb_participants, Plan, Adresse_depart, Date_inscriptions, Date_depot, Date_recuperation, Site, Tarifs) VALUES (".$id.", ".$_POST['idc_add_edt'].", ".$_POST['year_add_edt'].", ".$_POST['nbpart_add_edt'].", '".$_POST['plan_add_edt']."', '".$_POST['adep_add_edt']."', '".$_POST['dati_add_edt']."', '".$_POST['datd_add_edt']."', '".$_POST['datr_add_edt']."', '".$_POST['site_add_edt']."', '".$_POST['tarif_add_edt']."')";
				
				traiterRequete($p_courses);
				break;
			case 2:
				$p_edt="DELETE FROM edition WHERE IdE LIKE '".$_POST['id_del_edt']."'";
				traiterRequete($p_edt);
				break;
			default:
				break;
		}
	}

?>