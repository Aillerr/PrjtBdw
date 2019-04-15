<?php
	require_once('./includes/connexionBD.php');
	$p_courses='SELECT';
	function init_accueil()
	{
		echo "<h2>Accueil</h2>";
		formulaire();			
		
	}


	function formulaire() {

		echo '<form method="POST" action="espaceperso.php">
				<SELECT name="nom" size="1">
					<OPTION>courses
					<OPTION>course
					<OPTION>import
					<OPTION>resultats
					<OPTION>adherents
					<option>adherent
				</SELECT>
				<input type="submit" name="sand" value="Valider" />	
			</form>';



	}



?>