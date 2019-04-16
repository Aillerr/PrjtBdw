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

UPDATE course SET $_POST["modifsend"]. " = " .$_POST["nveau"]. ' WHERE IdC = '.$_POST["amodif"]

/*Ajoute un adh*/

INSERT INTO adherent (IdA, Nom, Prenom, Date_naissance, Sexe, Adresse, Date_dernier_justif, Club, Pseudo, Pwd, Type) VALUES ('".$_POST['id_add']."', '".$_POST['name_add']."', '".$_POST['prn_add']."', '".$_POST['year_add']."', '".$_POST['sexe_add']."', '".$_POST['adr_add']."', '".$_POST['justif_add']."', '".$_POST['club_add']."', '".$_POST['pseudo_add']."', '".$_POST['pwd_add']."', '0')

/*Supprime un adh*/

DELETE FROM adherent WHERE IdA LIKE '".$_POST['id_del']."'











