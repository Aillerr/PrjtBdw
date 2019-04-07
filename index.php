<?php session_start() ; ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="css/style_index.css">
			<?php 
				/*var_dump($_SESSION["slogin"]);
				var_dump($_SESSION["sPwd"]);*/
				if (!empty($_SESSION["slogin"]) && !empty($_SESSION["sPwd"])) {
					header('Location: espaceperso.php');
				}
			?>
			<title>login</title>
		</head>
		<body>
			<h1>Entrez vos identifiants</h1>
			<div class="authent">
				<form method="POST" action="espaceperso.php">
						<input type="text" name="pLogin" placeholder="Pseudo" />
						<input type="password" name="pPwd" placeholder="Mot de passe" />
						<input type="submit" name="pEnvoyer" value="Connexion" />
				</form>
			</div>
			<p></p>
		</body>
	</html>


	