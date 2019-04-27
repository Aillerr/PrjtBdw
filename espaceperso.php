<?php session_start() ; ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="css/style_eperso.css">
			<?php
				

				if (isset($_SESSION['liste'])) {
					$_POST['nom']=$_SESSION['liste'];
				}
				
				
				 
				if (!empty($_SESSION["slogin"]) && !empty($_SESSION["sPwd"])) {
					$_POST['pLogin']=$_SESSION["slogin"];
					$_POST['pPwd']=$_SESSION["sPwd"];
					
				}

				if  (empty($_POST['pLogin']) || empty( $_POST['pPwd'])) {
    				header('Location: erreur.php');
				}
				$_SESSION["slogin"]= $_POST['pLogin']; 
				$_SESSION["sPwd"]= $_POST['pPwd'];

				require_once("includes/connexionBD.php");
				require_once("adm/accueil.php");
				require_once("adh/accueil.php");

				$p='SELECT Identifiant, Pwd FROM adherent WHERE Identifiant LIKE "' . $_POST['pLogin'] . '" AND Pwd LIKE "' . $_POST['pPwd'] . '"';
				
				$tab=traiterRequete($p);
				//Array2Table($tab);

				if($tab[1]['Identifiant']!=$_POST['pLogin'] || $tab[1]['Pwd']!=$_POST['pPwd'] ) {
					header('Location: erreur.php');
				}
			?>
			<title>Espace perso</title>
		</head>
		<body>	
			<main>
				<?php
					$p_titre='SELECT Nom, Prenom FROM adherent WHERE Identifiant LIKE "' . $_POST['pLogin'] .'"';
					//$p_infos='SELECT * FROM adherent WHERE Identifiant LIKE "' . $_POST['pLogin'] .'"';
					$p_type='SELECT type FROM adherent WHERE Identifiant LIKE "' . $_POST['pLogin'] .'"';
	
					$tab=traiterRequete($p_titre);
					//$tab_infos=traiterRequete($p_infos);
					$tab_type=traiterRequete($p_type);

					echo "<h1>Espace perso de " . $tab[1]["Nom"] . " " . $tab[1]["Prenom"] . "</h1>";
					/*echo "<h2>Vos informations :</h2></br><div class='infos'>"; 
					Array2Table($tab_infos); 
					echo "</div></br>";*/
				
					if ($tab_type[1]['type']=='1') {
						if (isset($_POST['nom'])) {
							require_once('adm/'.$_POST["nom"].'.php');
							$_SESSION['liste']=$_POST['nom'];
							switch ($_POST['nom']) {
								case 'courses':
									crses();
									break;
								case 'course':
									crse();
									break;
								case 'adherent':
									list_adh();
									break;
								case 'adherents':
									adhe();
									break;
								case 'import':
									imp();
									break;
								case 'resultats':
									res();
									break;
								default:
									break;
							}
							echo '<a class="button" href="retouracc.php">Accueil</a>';
						}else{
							printf("Accueil admin");
							init_accueil();
						}
					}else{
						if(isset($_POST['nom'])) {
							require_once('adh/'.$_POST["nom"].'.php');
							$_SESSION['liste']=$_POST['nom'];
							switch ($_POST['nom']) {
								case 'course':
									aff_cr();
									break;
								case 'courses':
									liste_course_adh();
									break;
								case 'fiche':
									fiche();
									break;
								case 'resultat':
									res_adh();
									break;
								default:
									break;
							}
							echo '<a class="button" href="retouracc.php">Retour Accueil</a>';
						}else{
							printf("Accueil adh");
							init_accueil_adh();
							}
					}
				
	
				?>
				<a class="button" href="logout.php">Déconnexion</a>
			</main>		 

			
			
			<footer> &copy 2019 - Durand Louise / Axel Gassion </footer>
			
		</body>
	</html>