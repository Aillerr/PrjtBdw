<?php
	require_once('./includes/connexionBD.php');
	function res() {
		
		if (isset($_POST['envoi']) && !empty($_POST['idcheck'])) {
			$p_rescheck='SELECT * FROM resultat WHERE IdE LIKE "'.$_POST['idcheck'].'" ORDER BY rang';
			$tabrescheck=traiterRequete($p_rescheck);
			Array2Table($tabrescheck);
		}else form_res();
	}

	function form_res() {
		echo "<form method='POST' action='espaceperso.php'>
				<input type='text' name='idcheck' placeholder='Numéro de l édition choisie' required=''><br>
				<input type='submit' name='envoi'>
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
?>