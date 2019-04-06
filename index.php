<?php session_start() ; ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
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
			<form method="POST" action="espaceperso.php">
				<input type="text" name="pLogin" />
				<input type="password" name="pPwd" />
				<input type="submit" name="pEnvoyer" />
			</form>
			<p></p>
		</body>
	</html>


	