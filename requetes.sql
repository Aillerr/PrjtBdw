GRANT UPDATE, INSERT, DELETE ON adherent TO administrateur
GRANT UPDATE, INSERT, DELETE ON course TO administrateur
GRANT UPDATE, INSERT, DELETE ON edition TO administrateur

 /*Les administrateurs peuent ajouter modifier et supprimer des adhérents, des courses et des éditions*/

GRANT UPDATE, INSERT, DELETE adherent TO adherent
GRANT SELECT ON edition TO adherent
GRANT SELECT ON resultat TO adherent 
GRANT SELECT ON temps_passage TO adherent

/* Les adhérents peuvent visualiser les éditions, classement et teps de passage et ils peuvent gérer leurs données*/

SELECT pseudo, pwd
FROM adherent
WHERE pseudo IS LIKE "'$pseudo'" AND pwd IS LIKE "'$pwd'"

/* Retourne le pseudo et le pwd d'un adhérent*/
