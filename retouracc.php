<?php
 	session_start();
 	//On unset aussi liste qui permet de rester sur la version d'espaceperso séléctionnée tant qu'on arrive pas sur ce fichier
	unset($_SESSION['liste']);
	//On unset impchoice qui correspond à un choix dans import.php
	unset($_SESSION['impchoice']);
	header('Location: espaceperso.php');
?>