<?php

	require_once('./includes/connexionBD.php');

	function retour_acc() {

		 echo '<a href="../retouracc.php">Retour Accueil</a>';
	}



	/* COURSES.PHP*/

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
						echo "<form method='POST' action='courses.php'>
								<input type='text' name='name_add' placeholder='Nom de la course' required=''><br>
								<input type='text' name='year_add' placeholder='Année de création' required=''><br>
								<input type='text' name='epreuve_add' placeholder='Epreuves' required=''><br>
								<input type='text' name='mois_add' placeholder='Mois de la course' required=''><br>
								<input type='submit' name='send_add' value='Ajouter'><br>
							</form>";
						break;
						
					case 'del':
						echo "<form method='POST' action='courses.php'>
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
		echo "<form method='POST' action='courses.php'>
				<input type='radio' name='action_wanted' value='add_edt' checked> Ajouter une édition<br>
				<input type='radio' name='action_wanted' value='del_edt'> Supprimer une édition<br>
				<input type='submit' name='send_edt' value='Choisir'> 
			</form>";
			if (isset($_POST['send_edt'])) {
				switch ($_POST['action_wanted']) {
					case 'add_edt':
						echo "<form method='POST' action='courses.php'>
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
						echo "<form method='POST' action='courses.php'>
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
				$p_courses="INSERT INTO course (IdC, Nom, Annee_creation, Epreuves, Mois) VALUES ('".$id."', '".$_POST['name_add']."', '".$_POST['year_add']."', '".$_POST['epreuve_add']."', '".$_POST['mois_add']."')";

				traiterRequete($p_courses);
				break;
			case 3:
				$p_ide="SELECT MAX(IdE) FROM edition";
				$tab1=traiterRequete($p_ide);
				$id=$tab1[1]['MAX(IdE)']+1;
				$p_courses="INSERT INTO edition (IdE, IdC, Annee, Nb_participants, Plan, Adresse_depart, Date_inscriptions, Date_depot, Date_recuperation, Site, Tarifs) VALUES ('".$id."', '".$_POST['idc_add_edt']."', '".$_POST['year_add_edt']."', '".$_POST['nbpart_add_edt']."', '".$_POST['plan_add_edt']."', '".$_POST['adep_add_edt']."', '".$_POST['dati_add_edt']."', '".$_POST['datd_add_edt']."', '".$_POST['datr_add_edt']."', '".$_POST['site_add_edt']."', '".$_POST['tarif_add_edt']."')";
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



	/*RESULTATS.PHP*/

	function res() {
		
		if (isset($_POST['send']) && !empty($_POST['idcheck'])) {
			$p_rescheck='SELECT Dossard, Rang, Nom, Prenom, Sexe, IdA FROM resultat WHERE IdE LIKE "'.$_POST['idcheck'].'"';
			$tabrescheck=traiterRequete($p_rescheck);
			Array2Table($tabrescheck);
		}else form_res();
	}

	function form_res() {
		echo "<form method='POST' action='resultats.php'>
				<input type='text' name='idcheck' placeholder='Numéro de l édition choisie' required=''><br>
				<input type='submit' name='send'>
			</form>";
		edition();
	}

	function edition() {
		$p_ed="SELECT MAX(IdE) FROM edition";
		$tab_ed=traiterRequete($p_ed);
		echo "<br>";
		$tab_edt = array (
			0 => array(	'Num' => 'Numéro édition',
						'Nom' => 'Nom course',
						'Année' => 'Année édition'
			),
		);
		$i=1;
		$p_c="SELECT * FROM course AS c NATURAL JOIN edition AS e WHERE c.IdC LIKE e.IdC";
		$tab_idc=traiterRequete($p_c);
		while ($i<=$tab_ed[1]['MAX(IdE)']) {
			$tab_edt[$i]=array( 'Num' => $i,
								'Nom' => $tab_idc[$i]['Nom'],
								'Année' => $tab_idc[$i]['Annee']);
			$i++;
		}
		Array2Table($tab_edt);
	}

	/*ADHERENTS.PHP*/

	function adhe() {
		
		if (isset($_POST['send_del']) || isset($_POST['send_add'])) {
			if (isset($_POST['send_del']) && !empty($_POST['id_del'])) {
				$choix=0;
			}elseif (isset($_POST['send_add']) && !empty($_POST['name_add']))  {
				$choix=1;
			}else echo "Champ manquant";
		} 
		form_adh();
		if (isset($choix) && ($choix==1 || $choix==0)) {
			req_adh($choix);
		}

		$p_res="SELECT * FROM adherent";
		$tab_res=traiterRequete($p_res);
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
								<input type='text' name='id_add' placeholder='ID de l adherent' required=''><br>
								<input type='text' name='name_add' placeholder='Nom de l adherent' required=''><br>
								<input type='text' name='prn_add' placeholder='Prénom de l adherent' required=''><br>
								<input type='text' name='year_add' placeholder='Année de naissance' required=''><br>
								<input type='text' name='sexe_add' placeholder='Sexe' required=''> H ou F<br>
								<input type='text' name='adr_add' placeholder='Adresse' required=''><br>
								<input type='text' name='justif_add' placeholder='Dernier justif valide' required=''><br>
								<input type='text' name='club_add' placeholder='Club' required=''><br>
								<input type='text' name='pwd_add' placeholder='Pwd' required=''><br>
								<input type='submit' name='send_add' value='Ajouter' required=''><br>
							</form>";
						break;
						
					case 'del':
						echo "<form method='POST' action='adherents.php'>
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
			case 0:
				$p_adh="DELETE FROM adherent WHERE IdA LIKE '".$_POST['id_del']."'"; 
				traiterRequete($p_adh);
				break;
			case 1 :
				$p_adh= "INSERT INTO adherent (IdA, Nom, Prenom, Date_naissance, Sexe, Adresse, Date_dernier_justif, Club, Pwd, Type) VALUES ('".$_POST['id_add']."', '".$_POST['name_add']."', '".$_POST['prn_add']."', '".$_POST['year_add']."', '".$_POST['sexe_add']."', '".$_POST['adr_add']."', '".$_POST['justif_add']."', '".$_POST['club_add']."', '".$_POST['pwd_add']."', '0')";
				
				traiterRequete($p_adh);
				break;
			case -1:
				return;
			default:
				break;
		}
	}



	/*ADHERENT.PHP*/

	function list_adh() {
		$p_res="SELECT * FROM adherent";
		modif();	
		$tab=traiterRequete($p_res);
		Array2Table($tab);
	}

	function modif() {
		echo "<form method='POST' action='adherent.php'>
						<input type='text' name='id_correct' placeholder='ID de l adherent à selectionner' required=''><br>
						<input type='text' name='nveau' placeholder='Entrez la modification'/>
						<select name='attribut'	size='1'>
							<option>Nom
							<option>Prenom
							<option>Date_naissance
							<option>Sexe
							<option>Adresse
							<option>Date_dernier_justif
							<option>Club
							<option>Pwd
							<option>Type
						</select>
						<input type='submit' name='modifsend' value='Valider'/>
					</form>";
		if (isset($_POST["modifsend"]) && !empty($_POST["nveau"]) && isset($_POST['id_correct']) ) {
					$p_m="UPDATE adherent SET ".$_POST['attribut']." = '".$_POST['nveau']. "' WHERE IdA LIKE ".$_POST['id_correct'];
					
					traiterRequete($p_m);
					echo "Modif effectuée";
				}
	}



	/*COURSE.PHP*/

	function crse() {
		$p_c='SELECT * FROM course';
		$p_ed='SELECT * FROM edition';

		if (isset($_POST["modifsend"]) && !empty($_POST["nveau"]) && !empty($_POST["amodif"]) && isset($_POST['attribut'])) {
			$p_m="UPDATE course SET ".$_POST["attribut"]." = '".$_POST["nveau"]."' WHERE IdC LIKE '".$_POST["amodif"]."'";		
			traiterRequete($p_m);
			echo "Changement effectué";
		}
		if (isset($_POST['editmodifsend']) && !empty($_POST['editmodif']) && !empty($_POST['editnveau']) && isset($_POST['editattribut'])) {
			$p_m="UPDATE edition SET ".$_POST["editattribut"]." = '".$_POST["editnveau"]."' WHERE IdE LIKE '".$_POST["editmodif"]."'";
			traiterRequete($p_m);
			echo "Changement effectué";	
		}	
		echo "<h2>Modifier une course</h2>";
		$tab=traiterRequete($p_c);
		Array2Table($tab);
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
					</form><br>";

		echo "<h2>Modifier une édition</h2>";			
		$tab_ed=traiterRequete($p_ed);
		Array2Table($tab_ed);
		echo "<form method='POST' action='course.php'>
						<input type='text' name='editmodif' placeholder='Entrez l édition à modifier'/>
						<input type='text' name='editnveau' placeholder='Entrez la modification'/>
						<select name='editattribut'	size='1'>
							<option>Annee
							<option>Nb_participants
							<option>Plan
							<option>Adresse_depart
							<option>Date_inscritpions
							<option>Date_depot
							<option>Date_recuperation
							<option>Site
							<option>Tarifs
						</select>
						<input type='submit' name='editmodifsend' />
					</form>";
	}



	/*IMPORT.PHP*/

	function imp() {
		echo "<h1>Import</h1>";
		if (isset($_POST['subm_file'])) {
			check_file();
		}else form_imp();
	}

	function form_imp () {
		echo "<form method='POST' action'import.php' enctype='mulitpart/form-data'>
				<input type='hidden' name='max_file_size' value='20000'>
				<input type='file' name='res_imp' >
				<input type='submit' name='subm_file'>
			</form>";
	}

	function check_file() {
	if( isset($_POST['res_imp']) ) // si formulaire soumis
	{
    	$content_dir = 'res_imp/'; // dossier où sera déplacé le fichier

    	$tmp_file = $_FILES['res_imp']['tmp_name'];

    	if( !is_uploaded_file($tmp_file) )
    	{	
        	exit("Le fichier est introuvable");
    	}
	}
		$handle=fopen($_FILES['res_imp']['name'], "r");
		/*//Créer un dossier 'fichiers/1/'
 		 mkdir('fichier/1/', 0777, true);
 
		//Créer un identifiant difficile à deviner
 		$nom = md5(uniqid(rand(), true));


		$nom = "avatars/{$id_membre}.{$extension_upload}";
		$resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
		if ($resultat) echo "Transfert réussi";*/

	}
?>