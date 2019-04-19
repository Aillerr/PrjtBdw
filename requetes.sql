/*Les administrateurs peuent ajouter modifier et supprimer des adhérents, des courses et des éditions*/

GRANT UPDATE, INSERT, DELETE ON adherent TO administrateur
GRANT UPDATE, INSERT, DELETE ON course TO administrateur
GRANT UPDATE, INSERT, DELETE ON edition TO administrateur

/* Les adhérents peuvent visualiser les éditions, classement et teps de passage et ils peuvent gérer leurs données*/

GRANT UPDATE, INSERT, DELETE adherent TO adherent
GRANT SELECT ON edition TO adherent
GRANT SELECT ON resultat TO adherent 
GRANT SELECT ON temps_passage TO adherent


/* CONNEXION */

/* Retourne le pseudo et le pwd d'un adhérent*/

SELECT Pseudo, Pwd FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] . '" AND Pwd LIKE "' . $_POST['pPwd'] . '"

/*Retourne Nom et Prénom de l'adhérent correspondant au Login renseigné pour se connecter*/

SELECT Nom, Prenom FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"

/*Retourne toutes les informations stockées sur l'adhérent dont le login a été utilisé pour se connecter*/

SELECT * FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"

/*Retourne le type de l'utilisateur*/

SELECT type FROM adherent WHERE Pseudo LIKE "' . $_POST['pLogin'] .'"



/* COURSES */

/*Met à jour la table courses d'un IdC précisé pour un certain attribut*/

UPDATE course SET $_POST["modifsend"]. " = " .$_POST["nveau"]. ' WHERE IdC = '.$_POST["amodif"]

/*Ajoute une course*/

INSERT INTO course (IdC, Nom, Annee_creation, Epreuves, Mois) VALUES ('".$id."', '".$_POST['name_add']."', '".$_POST['year_add']."', '".$_POST['epreuve_add']."', '".$_POST['mois_add']."')

/*Supprime une course*/

DELETE FROM course WHERE IdC LIKE '".$_POST['id_del']."'

/*Renvoie l'IdC le plus haut*/

SELECT MAX(IdC) FROM course


/* ADHERENT */

/*Ajoute un adh*/

INSERT INTO adherent (IdA, Nom, Prenom, Date_naissance, Sexe, Adresse, Date_dernier_justif, Club, Pseudo, Pwd, Type) VALUES ('".$_POST['id_add']."', '".$_POST['name_add']."', '".$_POST['prn_add']."', '".$_POST['year_add']."', '".$_POST['sexe_add']."', '".$_POST['adr_add']."', '".$_POST['justif_add']."', '".$_POST['club_add']."', '".$_POST['pseudo_add']."', '".$_POST['pwd_add']."', '0')

/*Supprime un adh*/

DELETE FROM adherent WHERE IdA LIKE '".$_POST['id_del']."'

/*Met à jour un adhérent d'un IdA précisé pour un certaine attribut*/

UPDATE adherent SET ".$_POST['attribut']." = '".$_POST['nveau']. "' WHERE IdA LIKE ".$_POST['id_correct']
" 


/* RESULTATS */

/*Sélectionne tous les résultats*/

SELECT * FROM resultat




/*Visualisation de la liste de toutes les courses*/
SELECT DISTINCT *
FROM course

/*Visualisation de la liste de toutes les courses et de leurs édition */
SELECT C.Nom,E.*
FROM edition E, course C
WHERE E.IdC=C.IdC
GROUP BY C.Nom

/*Je ne suis pas sure de celle là*/
SELECT AVG(SELECT COUNT (R.Dossard) FROM edition E, epreuve F, resultat R,
WHERE E.IdE = F.IdE AND E.IdE=R.IdE 
GROUP BY E.IdE)


SELECT AVG(SELECT COUNT (R.Dossard) FROM edition E, epreuve F, resultat R,
WHERE E.IdE = F.IdE AND E.IdE=R.IdE 
GROUP BY E.IdC)

/*Le nombre total d'adhérent ayant couru l'édition*/
SELECT E.IdC COUNT (R.Dossard) FROM edition E, epreuve F, resultat R,
WHERE E.IdE = F.IdE AND E.IdE=R.IdE 
GROUP BY E.IdE)

/*Le nombre d'adhérents ayant couru l'édition en tant que licencié dans un club d'athlétisme*/

SELECT E.IdC COUNT (R.Dossard) FROM adherent A, edition E, epreuve F, resultat R,
WHERE E.IdE = F.IdE AND E.IdE=R.IdE AND R.nom=A.nom AND A.club IS NOT NULL
GROUP BY E.IdE)

/*Le nombre de club d'athlétisme représentés durant l'édition de la course*/

SELECT  COUNT (DISTINCT A.club) FROM adherent A, edition E, epreuve F, resultat R,
WHERE E.IdE = F.IdE AND E.IdE=R.IdE AND R.nom=A.nom AND A.club IS NOT NULL
GROUP BY E.IdE)

/*Le temps du vainqueur de l'édition*/
SELECT T.temps
FROM temps_passage T, resultat R
WHERE R.rang='1' AND R.dossard=T.dossard 


/* le meilleur et le pire rang/temps obtenu par un adhérent de l'association*/

/*Le nombre d'abandon d'adhérents de l'associaition*/
SELECT COUNT(A.nom) 
FROM adhrent A, resultat R
WHERE A.nom=R.nom AND R.rang IS NULL
GROUP BY A.club

/*trier par nom*/
SELECT R.nom R.prenom
FROM resultat R, edition E 
WHERE E.IdE=R.IdE 
ORDER BY R.nom, R.prenom

/*trier par rang*/
SELECT R.nom R.prenom
FROM resultat R, edition E 
WHERE E.IdE=R.IdE 
ORDER BY R.rang



