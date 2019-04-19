<?php session_start() ; ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="../css/style_eperso.css">
			<?php 
				
				require_once('../includes/connexionBD.php');
				require_once('fonctions_adm.php');

			?>
			<title>Accueil</title>
		</head>
		<body>
			<?php
				echo "<h2>Ajouter/Supprimer une course</h2>";
				if (isset($_POST['send_del']) || isset($_POST['send_add'])) {
					if (isset($_POST['send_del']) && !empty($_POST['id_del'])) {
						$choix=0;
					}elseif (isset($_POST['send_add']) && !empty($_POST['name_add']))  {
						$choix=1;
					}else echo "Champ manquant";
				}
				form_courses();
				
				$p_c='SELECT * FROM course';
				$tab=traiterRequete($p_c);
				Array2Table($tab);
				echo "<br><h2>Ajouter/Supprimer une édition de course</h2>";
				if (isset($_POST['send_del_edt']) || isset($_POST['send_add_edt'])) {
					if (isset($_POST['send_del_edt']) && !empty($_POST['id_del_edt'])) {
						$choix=2;
					}elseif (isset($_POST['send_add_edt']) && !empty($_POST['idc_add_edt']))  {
						$choix=3;
					}else echo "Champ manquant";
				}
				form_edt();
				if (isset($choix) && ($choix==1 || $choix==0 || $choix==2 || $choix==3)) {
					req_courses($choix);
				}
				$p_edt="SELECT * FROM edition";
				$tab_edt=traiterRequete($p_edt);
				Array2Table($tab_edt);
				echo "<br>";
				retour_acc();
			?>
			<a href="../logout.php">Déconnexion</a>
		</body>
	</html>
