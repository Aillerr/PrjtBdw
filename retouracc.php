<?php
 	session_start();
	unset($_SESSION['liste']);
	unset($_SESSION['impchoice']);
	header('Location: espaceperso.php');
?>