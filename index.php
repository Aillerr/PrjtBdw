<?php session_start() ; ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">

			<title>Authentification</title>
			<link rel="icon" type="image/png" href="locked.png" />

			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

			<link rel="stylesheet" type="text/css" href="css/style_index.css">
			<?php 

				if (!empty($_SESSION["slogin"]) && !empty($_SESSION["sPwd"])) {
					header('Location: espaceperso.php');
				}
			?>

		</head>
		<body>

			<div class="conteneur">
				<form method="POST" action="espaceperso.php">

					<img class="img-head" src="img/sneaker.svg">

					<div class="input-conteneur">
						<input class="form-input" type="text" name="pLogin" placeholder="Pseudo" required=""/>	
					</div>

					<div class="input-conteneur">
						<span class="show">
							<i class="fa fa-eye"></i>
						</span>
						<input class="form-input pswd" type="password" name="pPwd" placeholder="Mot de passe" required="" />
					</div>

					<input type="submit" name="pEnvoyer" value="Se connecter" />
				</form>
			</div>


	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	<script type="text/javascript">
		$('.show').on('click', function () {
			if($('i').first().attr('class') == "fa fa-eye") {
				$('i').first().attr('class', "fa fa-eye-slash");
				$('.pswd').first().attr('type','text');

			} else {
				$('i').first().attr('class', "fa fa-eye");
				$('.pswd').first().attr('type','password');
			}
		})

	</script>

		</body>
	</html>


	