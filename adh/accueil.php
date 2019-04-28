<?php
	require_once('./includes/connexionBD.php');
	
	function init_accueil_adh()
	{
		//Si on a envoyé le formulaire
		if (isset($_POST['envoi'])) {

			$p_idk='SELECT * FROM adherent WHERE Identifiant LIKE "'.$_SESSION["slogin"].'" AND pwd LIKE "'.$_SESSION["sPwd"].'"';
			$tab_idk=traiterRequete($p_idk);

			//Si on a pas modifié les informations suivantes, elles restent telles qu'elles
			if (empty($_POST['newadresse'])) {
				$_POST['newadresse']=$tab_idk[1]['Adresse'];
			}
			if (empty($_POST['newdate'])) {
				$_POST['newdate']=$tab_idk[1]['Date_naissance'];
			}
			if (empty($_POST['newcertif'])) {
				$_POST['newcertif']=$tab_idk[1]['dateCertif'];
			}
			if (empty($_POST['newclub'])) {
				$_POST['newclub']=$tab_idk[1]['Club'];
			}

			//On met à jour la fiche de l'adhérent
			$p='UPDATE adherent SET nom="'.$_POST['newnom'].'", prenom="'.$_POST['newprenom'].'", sexe="'.$_POST['newsexe'].'", adresse="'.$_POST['newadresse'].'", Date_naissance="'.$_POST['newdate'].'", dateCertif="'.$_POST['newcertif'].'", club="'.$_POST['newclub'].'" WHERE Identifiant LIKE "'.$_SESSION["slogin"].'"';
			echo $p;
			traiterRequete($p);
		}

		//On récupère nom prénom sexe de l'adhérent connecté
		$p='SELECT nom, prenom, sexe FROM adherent WHERE Identifiant LIKE "'.$_SESSION["slogin"].'" AND pwd LIKE "'.$_SESSION["sPwd"].'"';
		$tab=traiterRequete($p);
		//var_dump($tab);

		//Si c'est sa première connexion, il n'a pas de nom prenom sexe donc on affiche le formulaire de bienvenue
		if (empty($tab[1]['nom']) && empty($tab[1]['prenom']) && empty($tab[1]['sexe']) ) {
			nouveladh();
		}else {
			//Sinon accueil normal
			echo "<h2>Accueil</h2>";
			echo "<br>";
			formulaire_adh();	
		}
		
	}


	function formulaire_adh() {
		//Formulaire pour affiche les versions de espaceperso
		echo '<form method="POST" action="espaceperso.php">
				<SELECT name="nom" size="1">
					<OPTION>course
					<OPTION>courses
					<OPTION>fiche
					<OPTION>resultat
				</SELECT>
				<input type="submit" name="sand" value="Valider" />	
			</form>';



	}

	function nouveladh() {
		//Formulaire à remplir à la 1ère connexion
		echo "<h2>Bienvenue !</h2>
			<h3>Veuillez compléter les informations vous concernant</h3>
			<form method='POST' action='espaceperso.php'>
				<label for='newnom'> Votre nom</label>
				<input type='text' name='newnom' required=''></br>
				<label for='newprenom'> Votre prénom</label>
				<input type='text' name='newprenom' required=''></br>
				<label for='newadresse'> Votre adresse</label>
				<input type='text' name='newadresse' ></br>
				<label for='newdate'> Votre date de naissance</label>
				<input type='text' name='newdate' ></br>
				<label for='newsexe'> Votre sexe</label>
				<input type='text' name='newsexe' required=''></br>
				<label for='newcertif'> Date de dernier certificat médical valide</label>
				<input type='text' name='newcertif' ></br>
				<label for='newclub'> Votre club</label>
				<input type='text' name='newclub' ></br>
				<input type='submit' name='envoi' value='Confirmer' class='button'><br><br>
				";



	}


?>