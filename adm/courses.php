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
				if (isset($_POST['send_del']) || isset($_POST['send_add'])) {
					if (isset($_POST['send_del']) && !empty($_POST['id_del'])) {
						$choix=0;
					}elseif (isset($_POST['send_add']) && !empty($_POST['name_add']))  {
						$choix=1;
					}else echo "Champ manquant";
				}else form_courses();
				if (isset($choix) && ($choix==1 || $choix==0)) {
					req_courses($choix);
				}
				
				retour_acc();
			?>
			<a href="../logout.php">Déconnexion</a>
		</body>
	</html>
