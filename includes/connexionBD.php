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
		var_dump($resultat);
		if($resultat == false) // échec si FALSE 
		printf("Échec de la requête"); 
		
		else/*if (gettype($resultat[0]) != "boolean")*/ {  // collecte des métadonnées
			//printf("Requête effectuée");
			//echo "</br>";
			var_dump($resultat);
			$finfo = mysqli_fetch_fields($resultat);  
			$entete=array() ; 

			foreach ($finfo as $key => $value) {  
				       
				$entete[$key]=$value->name;

			}  
			
			$tableauRetourne[0]=$entete;  
			$cpt=1 ; 
			while ($ligne = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) { 
				$tableauRetourne[$cpt++]= $ligne; 
				return $tableauRetourne;
			} 
		}


		mysqli_close($connexion);
		

	}


	function Array2Table ($tableauRetourne) {
		$leTableau = "<table>"; 
		foreach($tableauRetourne as $tuple) {  
			$leTableau .="<tr>";  
			foreach($tuple as $attribut) {   
				$leTableau .= "<td>" .$attribut . "</td>";  
			}  $leTableau .="</tr>"; 
 		} $leTableau .= "</table>";
 		echo $leTableau; 
 		return $leTableau; 	
	}
?>