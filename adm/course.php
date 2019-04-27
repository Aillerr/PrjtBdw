<?php 
	require_once('./includes/connexionBD.php');
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
		echo "<form method='POST' action='espaceperso.php'>
						<input type='text' name='amodif' placeholder='Entrez la course à modifier'/>
						<input type='text' name='nveau' placeholder='Entrez la modification'/>
						<select name='attribut'	size='1'>
							<option>Nom
							<option>Annee_creation
							<option>Mois
						</select>
						<input type='submit' name='modifsend' />
					</form><br>";

		echo "<h2>Modifier une édition</h2>";			
		$tab_ed=traiterRequete($p_ed);
		Array2Table($tab_ed);
		echo "<form method='POST' action='espaceperso.php'>
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
?>
