
<?php

	require_once('../includes/connexionBD.php');

	function retour_acc() {

		 echo '<a href="../retouracc.php">Retour Accueil</a>';
	}



	/*FICHE.PHP*/

	function fiche() {
		$p_res="SELECT * FROM adherent WHERE IdA LIKE '".$_SESSION["slogin"]."'";
		modif_fiche();	
		
		$tab=traiterRequete($p_res);
		Array2Table($tab);
	}

	function modif_fiche() {
		echo "<form method='POST' action='fiche.php'>
						<input type='text' name='nveau' placeholder='Entrez la modification'/>
						<select name='attribut'	size='1'>
							<option>Nom
							<option>Prenom
							<option>Date_naissance
							<option>Sexe
							<option>Adresse
							<option>Date_dernier_justif
							<option>Club
							<option>Pseudo
							<option>Pwd
						</select>
						<input type='submit' name='modifsend' value='Valider'/>
					</form>";
		if (isset($_POST["modifsend"]) && !empty($_POST["nveau"]) && isset($_SESSION['slogin']) ) {
					$p_m="UPDATE adherent SET ".$_POST['attribut']." = '".$_POST['nveau']. "' WHERE IdA LIKE '".$_SESSION['slogin']."'";
					
					traiterRequete($p_m);
					echo "Modif effectuée";
				}
	}


	/*COURSES.PHP*/

	function liste_course_adh() {
		$p="SELECT e.IdE, e.IdC, e.Annee, e.Nb_participants, e.Plan, e.Adresse_depart, e.Date_inscriptions, e.Date_depot, e.Date_recuperation, e.Site, e.Tarifs, e.Epreuve FROM  resultat JOIN edition AS e ON resultat.IdE=e.IdE WHERE IdA =".$_SESSION['slogin'];
		
		$tab=traiterRequete($p);
		Array2Table($tab);

	}


	/*COURSE.PHP*/

		function aff_cr() {
			$p_c='SELECT * FROM course';
			$p_ed='SELECT * FROM edition';
			$tab=traiterRequete($p_c);
			echo "<h2>Courses</h2>";
			Array2Table($tab);
			$tab_ed=traiterRequete($p_ed);
			echo "<h2>Edition</h2>";
			Array2Table($tab_ed);
		}


	/*RESULTAT.PHP*/

	function res_adh() {
		if (isset($_POST['sub_ed']) && !empty($_POST['id_ed'])) {
			$p="SELECT t.dossard, t.km, t.temps FROM temps_passage AS t JOIN resultat ON t.Dossard=resultat.Dossard WHERE resultat.IdA = ".$_SESSION['slogin']." AND resultat.IdE = ".$_POST['id_ed'];
			$p_nom="SELECT c.Nom, e.Annee FROM course AS c NATURAL JOIN edition AS e WHERE e.IdE = ".$_POST['id_ed'];
			$tab_nom=traiterRequete($p_nom);
			echo "<h2>Temps de passage pour la course : ".$tab_nom[1]['Nom']." en ".$tab_nom[1]['Annee']."</h2>";
			$tab=traiterRequete($p);
			Array2Table($tab);
		}else form_res();
		
	}

	function form_res() {
		$p="SELECT e.IdE, e.Annee, c.Nom FROM edition AS e NATURAL JOIN course AS c";
		$tab=traiterRequete($p);
		Array2Table($tab);
		echo "<form method='POST' action='resultat.php'>
				<input type='text' name='id_ed' placeholder='Numéro de l édition voulue'> Champ obligatoire<br>
				<input type='submit' name='sub_ed'><br>
			</form>";
	}

?>