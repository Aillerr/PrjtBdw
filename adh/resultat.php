<?php 
	require_once('./includes/connexionBD.php');
	function res_adh() {
		if (isset($_POST['sub_ed']) && !empty($_POST['id_ed'])) {
			$p="SELECT t.dossard, t.km, t.temps FROM temps_passage AS t JOIN resultat ON t.Dossard=resultat.Dossard JOIN adherent AS A ON A.nom=resultat.nom WHERE Identifiant = ".$_SESSION['slogin']." AND resultat.IdE = ".$_POST['id_ed'];
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
		echo "<form method='POST' action='espaceperso.php'>
				<input type='text' name='id_ed' placeholder='Numéro de l édition voulue' required=''><br>
				<input type='submit' name='sub_ed'><br>
			</form>";
	}
?>
