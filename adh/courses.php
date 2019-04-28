<?php
	require_once('./includes/connexionBD.php');
	function liste_course_adh() {

		//On affiche un tableau avec l'année, la distance et le temps mit des épreuves d'éditions de courses courues par l'adhérent rangé par ordre d'année décroissant, puis de distance décroissant, puis de temps croissant
		$p="SELECT  e.Annee, ep.distance, CONCAT(FLOOR(tp.temps/60),'h',tp.temps%60) AS 'Temps', c.nom  FROM  resultat AS r JOIN edition AS e ON r.IdE=e.IdE JOIN adherent ON r.nom=adherent.nom JOIN course AS c ON c.IdC=e.IdC JOIN epreuve AS ep ON ep.IdC=c.IdC JOIN temps_passage AS tp ON tp.dossard=r.dossard WHERE Identifiant ='".$_SESSION['slogin']."' AND tp.km=ep.distance ORDER BY e.Annee DESC, ep.distance DESC, tp.temps ASC";
		$tab=traiterRequete($p);
		echo "<h2>Editions courues</h2>";
		Array2Table($tab);

	}
?>