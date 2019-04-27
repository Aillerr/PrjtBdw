<?php
	require_once('./includes/connexionBD.php');
	function imp() {
		echo "<h1>Import</h1>";
		if (isset($_POST['subm_file'])) {
			check_file();
		}else form_imp();
			
		
	}

	function form_imp () {
		echo "<h2>Editions de courses</h2>";
		$p="SELECT e.IdE, e.Annee, c.Nom FROM edition AS e NATURAL JOIN course AS c";
		$tab=traiterRequete($p);
		Array2Table($tab);
		echo "<h2>Epreuves des courses</h2>";
		$p="SELECT ep.IdEpreuve, ep.distance, c.nom AS 'Nom course' FROM epreuve AS ep JOIN course AS c ON c.IdC=ep.IdC ORDER BY IdEpreuve ASC";
		$tab=traiterRequete($p);
		Array2Table($tab);
		echo '<form enctype="multipart/form-data" method="POST" action="espaceperso.php">
				<input type="radio" name="add" value="res" checked> Ajouter des résulats<br>
				<input type="radio" name="add" value="tps"> Ajouter des temps de passage<br>
				<input type="submit" name="subm_choice"><br>
			</form>';
		if (isset($_POST['subm_choice'])) {
			$_SESSION['impchoice']=$_POST['add'];
			if ($_POST['add'] == 'res') {
				echo '<form enctype="multipart/form-data" method="POST" action="espaceperso.php">
						<input type="hidden" name="max_file_size" value="20000"><br>
						<input type="file" name="resimp" required=""><br>
						<input type="text" name="id_ed" placeholder="Numéro de l édition voulue" required=""><br>
						<input type="text" name="epr" placeholder="Epreuve voulue" required=""><br>
						<input type="submit" name="subm_file"><br>
					</form>';
			}else {
				echo '<form enctype="multipart/form-data" method="POST" action="espaceperso.php">
						<input type="hidden" name="max_file_size" value="20000"><br>
						<input type="file" name="resimp" required=""><br>
						<input type="submit" name="subm_file"><br>
					</form>';
			}
		}
	}





	function check_file() {
		//var_dump($_FILES);	
		if( isset($_POST['resimp']) ) // si formulaire soumis
		{

   			if( !is_uploaded_file($tmp_file) ) {	
        	exit("Le fichier est introuvable");
    		}
		}
		$handle=fopen($_FILES['resimp']['tmp_name'], "r");
		
		$fich=file_get_contents($_FILES['resimp']['tmp_name']);
		
		$nblignes=getLines($_FILES['resimp']['tmp_name']);
		
		$array = preg_split("/\r\n|\n|\r/", $fich);
		
		if (isset($_SESSION['impchoice']) && $_SESSION['impchoice']=='res') {
			remplirres($nblignes, $array);
		}else remplirtps($nblignes, $array);

		fclose($handle);
		

	}

	function remplirtps($nblignes, $array) {
		for ($i=1; $i <$nblignes ; $i++) { 
			$ligne=explode(',', $array[$i]);
			//var_dump($ligne);
			$p='SELECT * FROM resultat WHERE dossard='.$ligne[0];
			$tab=traiterRequete($p);
			
			$p_up='INSERT INTO temps_passage (dossard, km, temps) VALUES ("'.$ligne[0].'", "'.$ligne[1].'", "'.$ligne[2].'")';
			echo $p_up;
			traiterRequete($p_up);
			
		}
	}



	function remplirres($nblignes, $array) {
		$l1=explode(',', $array[1]);
		$nbdossard=$l1[0];
		var_dump($nbdossard);
		$p_check='SELECT dossard, nom FROM resultat WHERE dossard='.$nbdossard;
		$tabcheck=traiterRequete($p_check);
		var_dump($tabcheck);
		if (empty($tabcheck[1]['dossard']) || ($l1[2]!=$tabcheck[1]['nom'] || $nbdossard!=$tabcheck[1]['dossard'])) {
			$pligne='SELECT Nb_participants FROM edition WHERE IdE='.$_POST['id_ed'];
			$tabpart=traiterRequete($pligne);
			var_dump($tabpart);
			if ($tabpart[1]['Nb_participants']==NULL) {
				$nbpart=0;
			}else $nbpart=$tabpart[1]['Nb_participants'];
			$nbpart+=$nblignes-1;
			var_dump($nbpart);
			$paddnb='UPDATE edition SET Nb_participants="'.$nbpart.'" WHERE IdE='.$_POST['id_ed'];
			echo $paddnb;
			traiterRequete($paddnb);
		}
		



		for ($i=1; $i <$nblignes ; $i++) { 
			$ligne=explode(',', $array[$i]);
			//var_dump($ligne[1]);
			$p='SELECT * FROM adherent WHERE nom LIKE "'.$ligne[2].'" AND prenom LIKE "'.$ligne[3].'"';
			$tab=traiterRequete($p);
			//var_dump($tab);
			
			if (!empty($tab[1])) {
				if ($ligne[1]=='') {
					$p_up='INSERT INTO resultat (dossard, rang, nom, prenom, sexe, IdEpreuve, IdE) VALUES ("'.$ligne[0].'", NULL, "'.$ligne[2].'", "'.$ligne[3].'", "'.$ligne[4].'", "'.$_POST['epr'].'", "'.$_POST['id_ed'].'")';
					echo $p_up;
					traiterRequete($p_up);
				}else {
					$p_up='INSERT INTO resultat (dossard, rang, nom, prenom, sexe, IdEpreuve, IdE) VALUES ("'.$ligne[0].'", '.$ligne[1].', "'.$ligne[2].'", "'.$ligne[3].'", "'.$ligne[4].'", "'.$_POST['epr'].'", "'.$_POST['id_ed'].'")';
					echo $p_up;
					traiterRequete($p_up);
				}
				
			}elseif ($i==1) {
				$p_up='INSERT INTO resultat (dossard, rang, nom, prenom, sexe, IdEpreuve, IdE) VALUES ("'.$ligne[0].'", '.$ligne[1].', "'.$ligne[2].'", "'.$ligne[3].'", "'.$ligne[4].'", "'.$_POST['epr'].'", "'.$_POST['id_ed'].'")';
					echo $p_up;
					traiterRequete($p_up);
			}
		}
	}


	function getLines($file) {
    	$f = fopen($file, 'rb');
    	$lines = 0;
    	while (!feof($f)) {
        	$lines += substr_count(fread($f, 8192), "\n");
   		}
   		fclose($f);
    	return $lines;
	}




?>