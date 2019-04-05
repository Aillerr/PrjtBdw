

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<?php
				$mdp = "" ;
				$Utilis="root";
				$machine = "localhost" ; // machine locale
				$bd = "prjtbdw" ;
				
				function getConnexion($Host, $User, $Pwd, $Name) {
					$c=mysqli_connect($Host, $User, $Pwd, $Name);
					if (!$c) {
						echo "Erreur connexion";
					}else echo "Connexion ok";
					return $c;
				}

				function executeQuery($link, $query) {
					$res=mysqli_query($link, $query);
					if($res==false) {
						echo "Erreur exeQuery";
					}else echo "exe query ok";
					return $res;
				}

				if  (isset($_POST["pEnvoyer"]) == false) {
     				header('Location: erreur.php');
				}

				$p='SELECT Pseudo, Pwd FROM adherent WHERE Pseudo LIKE "'.$_POST["pLogin"].'" AND Pwd LIKE "'.$_POST["pPwd"].'"';

				$conn=getConnexion($machine, $Utilis, $mdp, $bd);
				$res=executeQuery($conn, $p);
				if (count($res)==0) {
					header('Location: erreur.php');
				}
				
				
     			
     			

			?>
			<title>Espace perso</title>
		</head>
		<body>

			</form>
			<p>Espace perso php</p>
		</body>
	</html>