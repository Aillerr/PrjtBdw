<?php session_start() ; ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="css/style_eperso.css">
			<?php
				require_once("includes/connexionBD.php");
				require_once("adm/accueil.php");
				 
				if (!empty($_SESSION["slogin"]) && !empty($_SESSION["sPwd"])) {
					$_POST['pLogin']=$_SESSION["slogin"];
					$_POST['pPwd']=$_SESSION["sPwd"];
					
				}

				if  (empty($_POST['pLogin']) || empty( $_POST['pPwd'])) {
    				header('Location: erreur.php');
				}
				$_SESSION["slogin"]= $_POST['pLogin']; 
				$_SESSION["sPwd"]= $_POST['pPwd'];



				$p='SELECT Pseudo, Pwd FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] . '" AND Pwd LIKE "' . $_POST['pPwd'] . '"';

				$tab=traiterRequete($p);
				//Array2Table($tab);

				if($tab[1]['Pseudo']!=$_POST['pLogin'] || $tab[1]['Pwd']!=$_POST['pPwd'] ) {
					header('Location: erreur.php');
				}
			?>
			<title>Espace perso</title>
		</head>
		<body>			 
			<?php
				$p_titre='SELECT Nom, Prenom FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"';
				//$p_infos='SELECT * FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"';
				$p_type='SELECT type FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"';

				$tab=traiterRequete($p_titre);
				//$tab_infos=traiterRequete($p_infos);
				$tab_type=traiterRequete($p_type);

				echo "<h1>Espace perso de " . $tab[1]["Nom"] . " " . $tab[1]["Prenom"] . "</h1></br>";
				/*echo "<h2>Vos informations :</h2></br><div class='infos'>"; 
				Array2Table($tab_infos); 
				echo "</div></br>";*/

				if ($tab_type[1]['type']=='1') {
					if (!isset($_POST['nom'])) {
						printf("Accueil admin");
						init_accueil();
					}else header('Location: adm/'.$_POST["nom"].'.php');

				}elseif (!isset($_POST['nom'])) {
					printf("Accueil adh");
					//fonctions de accueil adherent
				}else printf("adh");//fonctions de $_POST['page'] adherent
			?>

			<a href="logout.php">Déconnexion</a>
			

			
		</body>
	</html>