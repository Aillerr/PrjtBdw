/*Les administrateurs peuent ajouter modifier et supprimer des adhérents, des courses et des éditions*/

GRANT UPDATE, INSERT, DELETE ON adherent TO administrateur
GRANT UPDATE, INSERT, DELETE ON course TO administrateur
GRANT UPDATE, INSERT, DELETE ON edition TO administrateur

/* Les adhérents peuvent visualiser les éditions, classement et teps de passage et ils peuvent gérer leurs données*/

GRANT UPDATE, INSERT, DELETE adherent TO adherent
GRANT SELECT ON edition TO adherent
GRANT SELECT ON resultat TO adherent 
GRANT SELECT ON temps_passage TO adherent

/* Retourne le pseudo et le pwd d'un adhérent*/

SELECT Pseudo, Pwd FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] . '" AND Pwd LIKE "' . $_POST['pPwd'] . '"

/*Retourne Nom et Prénom de l'adhérent correspondant au Login renseigné pour se connecter*/

SELECT Nom, Prenom FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"

/*Retourne toutes les informations stockées sur l'adhérent dont le login a été utilisé pour se connecter*/

SELECT * FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"

/*Retourne le type de l'utilisateur*/

SELECT type FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"

/*Met à jour la table courses d'un IdC précisé pour un certain attribut*/

UPDATE course SET '.$_POST["modifsend"]." = ".$_POST["nveau"]. ' WHERE IdC = '.$_POST["amodif"]