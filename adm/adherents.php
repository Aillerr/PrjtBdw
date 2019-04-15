<?php session_start() ; ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="../css/style_eperso.css">
			<?php 
				
				require_once('fonctions_adm.php');

			?>
			<title>Accueil</title>
		</head>
		<body>
			<h1>Adhérents</h1>
			<?php
				adhe();
				retour_acc();
			?>
			<a href="../logout.php">Déconnexion</a>
		</body>
	</html>
