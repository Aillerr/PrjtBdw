<?php
	require_once('./includes/connexionBD.php');
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

?>