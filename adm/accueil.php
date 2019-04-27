<?php
	require_once('./includes/connexionBD.php');
	
	function init_accueil()
	{
		echo "<h2>Accueil</h2>";
		formulaire();
		

		$p="SELECT nom FROM course";
		$tab=traiterRequete($p);
		$nb="SELECT MAX(IdC) FROM course";
		$tabnb=traiterRequete($nb);

		for ($i=1; $i <= $tabnb[1]['MAX(IdC)'] ; $i++) { 
			$tmp=$tab[$i]['nom'];
			$tab[$i]['nom']='<a href="?idcr='.$tmp.'" >'.$tmp.'</a>';
		}

		



		if (isset($tmp) && isset($_GET['idcr'])) {
			echo "<h2>Course séléctionnée</h2>";
			afflien_crse();
		}
		
		echo "<h2>Courses</h2>";
		Array2Table($tab);
		
		
		$nb="SELECT MAX(IdE) FROM resultat";
		$tabnb=traiterRequete($nb);
		for ($i=1; $i <= $tabnb[1]['MAX(IdE)'] ; $i++) { 
			$p="SELECT e.IdE, e.Annee, c.Nom, COUNT(DISTINCT r.dossard) AS 'Nombre de participants adhérents' FROM edition AS e NATURAL JOIN course AS c JOIN epreuve AS ep ON c.IdC=ep.IdC JOIN resultat AS r ON r.IdE=e.IdE AND ep.IdEpreuve=r.IdEpreuve WHERE e.IdE=".$i;
			$tab=traiterRequete($p);
			$newtab[0]=$tab[0];
			$newtab[$i]=$tab[1];
			$newtab[$i]['IdE']='<a href="?ided='.$tab[1]['IdE'].'" >'.$tab[1]['IdE'].'</a>';
			

		}

		if (isset($tmp) && isset($_GET['ided'])) {
			echo "<h2>Edition séléctionnée</h2>";
			afflien_ed();
		}
		
		echo "<h2>Editions</h2>";
		Array2Table($newtab);				

	}

	function afflien_crse() {
		$p='SELECT * FROM course WHERE nom LIKE "'.$_GET['idcr'].'"';
		$tab=traiterRequete($p);
		Array2Table($tab);
		echo "<br>";

	}

	function afflien_ed() {
		$p='SELECT e.IdE, e.IdC, e.Annee, e.Nb_participants, e.Plan, e.Adresse_depart, e.Date_inscriptions, e.Date_depot, e.Date_recuperation, e.Site, e.Tarifs  FROM edition AS e JOIN course AS c ON e.IdC=c.IdC WHERE e.IdE LIKE "'.$_GET['ided'].'"';
		$tab=traiterRequete($p);
		Array2Table($tab);
		echo "<br>";
		$p='SELECT DISTINCT(resultat.rang), adherent.nom, adherent.prenom, epreuve.distance FROM adherent JOIN resultat ON adherent.prenom=resultat.prenom AND adherent.nom=resultat.nom JOIN epreuve ON epreuve.IdEpreuve=resultat.IdEpreuve WHERE resultat.IdE='.$_GET['ided'].' ORDER BY epreuve.distance ASC, resultat.rang ASC';
		$tab=traiterRequete($p);
		echo "<h3>Adhérents ayant couru l'édition</h3>";
		Array2Table($tab);
		$p="SELECT ep.IdEpreuve FROM epreuve AS ep JOIN course AS c ON ep.IdC=c.IdC JOIN edition AS e ON e.IdC=c.IdC WHERE e.IdE=".$_GET['ided'];
		$tab_epreuve=traiterRequete($p);
		$compteur=0;
		while (!empty($tab_epreuve[$compteur+1])) {
			$compteur++;
		}
		

		for ($j=0; $j <$compteur ; $j++) { 
			for ($i=-1; $i <7 ; $i++) { 
			switch ($i) {
				case -1:
					$p="SELECT ep.distance AS 'Distance' FROM epreuve AS ep JOIN course AS c ON ep.IdC=c.IdC JOIN edition AS e ON e.IdC=c.IdC WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve'];
					$tab=traiterRequete($p);
					
					break;
				case 0:
					$p="SELECT COUNT(DISTINCT r.dossard) AS 'Nombre de participants adhérents' FROM edition AS e NATURAL JOIN course AS c JOIN epreuve AS ep ON c.IdC=ep.IdC JOIN resultat AS r ON r.IdE=e.IdE AND ep.IdEpreuve=r.IdEpreuve WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve'];
					$tab=traiterRequete($p);
					break;
				case 1:
					$p="SELECT COUNT(DISTINCT a.IdA) AS 'Nombre de participants adhérents licenciés' FROM adherent AS a JOIN resultat AS r ON a.nom=r.nom AND a.prenom=r.prenom JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE WHERE e.IdE=".$_GET['ided']." AND a.club IS NOT NULL AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve'];
					$tab=traiterRequete($p);
					break;
				case 2:
					$p="SELECT COUNT(DISTINCT a.club) AS 'Nombre de clubs représentés' FROM adherent AS a JOIN resultat AS r ON a.nom=r.nom AND a.prenom=r.prenom JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve'];
					$tab=traiterRequete($p);
					break;
				case 3:
					$p="SELECT MIN(tp.temps) AS 'Temps du vainqueur' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND tp.km=".$newtab[$j+1][0];
					$tab=traiterRequete($p);
					break;
				case 4:
					$pmin="SELECT MIN(tp.temps) AS 'Meilleur temps adhérent' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard JOIN adherent AS a on a.nom=r.nom AND a.prenom=r.prenom WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND tp.km=".$newtab[$j+1][0];
					$tabmin=traiterRequete($pmin);
					$pmax="SELECT MAX(tp.temps) AS 'Pire temps adhérent' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard JOIN adherent AS a on a.nom=r.nom AND a.prenom=r.prenom WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND tp.km=".$newtab[$j+1][0];
					$tabmax=traiterRequete($pmax);
					$tab[0][0]='Meilleur/Pire temps adhérent';
					$tab[1][$tab[0][0]]=$tabmin[1]['Meilleur temps adhérent']."/".$tabmax[1]['Pire temps adhérent'];
					break;
				case 5:
					$p="SELECT AVG(tp.temps) AS 'Moyenne temps adhérents' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard JOIN adherent AS a on a.nom=r.nom AND a.prenom=r.prenom WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND tp.km=".$newtab[$j+1][0];
					$tab=traiterRequete($p);
					break;
				case 6:
					$p="SELECT COUNT(DISTINCT(r.dossard)) AS 'Nombre d abandons adhérents' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard JOIN adherent AS a on a.nom=r.nom AND a.prenom=r.prenom WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND r.rang IS NULL";
					$tab=traiterRequete($p);
					break;
				default:
					break;
			}
			//var_dump($tab);
			$newtab[0][$i+1]=$tab[0][0];
			$newtab[$j+1][$i+1]=$tab[1][$tab[0][0]];
			//var_dump($newtab);
		}
		}

		
	
		echo "<h3>Statistiques sur l'édition</h3>";
		Array2Table($newtab);
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