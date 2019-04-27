<?php

/* ETAPES

*/

	function traiterRequete ($req) {
		$mdp = "" ;
		$machine = "localhost" ; // machine locale
		$bd = "prjtbdw" ;
		$user="root";
		$connexion = mysqli_connect($machine,$user,$mdp, $bd);
		if(mysqli_connect_errno()) {// erreur si > 0 
		printf("Échec de la connexion : " ,mysqli_connect_error() ); 
		}else //printf("Connexion ok");
		echo "</br>";

		$tableauRetourne = array();
		$resultat = mysqli_query($connexion, $req);
		$tabeleau=explode(" ", $req);
		if($resultat == false) // échec si FALSE 
		printf("Échec de la requête"); 	
		elseif($tabeleau[0]=="SELECT") {  // collecte des métadonnées
			//printf("Requête effectuée");
			//echo "</br>";
			

			$finfo = mysqli_fetch_fields($resultat);  
			$entete=array() ; 

			foreach ($finfo as $key => $value) {  
				       
				$entete[$key]=$value->name;

			}  
			
			$tableauRetourne[0]=$entete;  
			$cpt=1 ; 
			while ($ligne = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) { 
				$tableauRetourne[$cpt++]= $ligne; 

			} 
			return $tableauRetourne;
		}

		
		mysqli_close($connexion);
		

	}

	function Array2Table ($tb) {
		echo "<table><thead>"; 
		foreach ($tb[0] as $head) {
			echo "<th>$head</th>";
		}
		echo "</thead><tbody>";

		for($i=1; $i < count($tb); $i++) {
			if ($i%2 == 0)
				$classCss = "class='p'";
			else
				$classCss = "class='i'";

			echo "<tr $classCss>";
			foreach ($tb[$i] as $v) {
				echo "<td>$v</td>";
			}
			echo "</tr>";
		}

 		echo "</tbody></table>";
	}
?>