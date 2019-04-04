<?php

/* ETAPES
	$mdp = 'un_mdp' ;
	$machine = '127.0.0.1' ; // machine locale
	$bd = 'une_bd' ;
	$connexion = mysqli_connect($machine,$user,$mdp, $bd) ;
	if(mysqli_connect_errno()) // erreur si > 0 
	printf("Échec de la connexion : %s",mysqli_connect_error()); 
	else { // utilisation de la base 

	}


	$req="SELECT…FROM…WHERE…";
	$tableauRetourne = array();
	$resultat = mysqli_query($connexion, $req);
	if($resultat == FALSE) // échec si FALSE 
	printf("Échec de la requête"); 
	else {  // collecte des métadonnées 
		$finfo = mysqli_fetch_fields($resultats);  
		$entete=array() ;     
		foreach ($finfo as $val) {         
			$entete($val->name);     
		}  
		$tableauRetourne[0]=$entete;  
		$cpt=1 ; 
		while ($ligne = mysqli_fetch_array($resultat)) { 
			$tableauRetourne[cpt++]= $ligne; 
		} 
	}

	mysqli_close($connexion);
*/

	function traiterRequete ($chaine) {


	}


	function Array2Table ($tableauRetourne) {
		$leTableau = ‘<table>’; 
		for($tableauRetourne as $tuple) {  
			$leTableau .=’<tr>’;  
			for($tuple as $attribut) {   
				$leTableau .= ‘<td>’ . $attribut . ‘</td>’;  
			}  $leTableau .=’</tr>’; 
 		} $leTableau = ‘</table>’; 
 		echo $leTableau 	
	}

?>