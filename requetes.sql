										/* ESPACEPERSO.PHP */

/* Retourne le pseudo et le pwd d'un adhérent avec les info données à la connexion*/
$p='SELECT Identifiant, Pwd FROM adherent WHERE Identifiant LIKE "' . $_POST['pLogin'] . '" AND Pwd LIKE "' . $_POST['pPwd'] . '"';

/*Retourne Nom et Prénom de l'adhérent correspondant au Login renseigné pour se connecter*/
$p_titre='SELECT Nom, Prenom FROM adherent WHERE Identifiant LIKE "' . $_POST['pLogin'] .'"';

/*Retourne toutes les informations stockées sur l'adhérent dont le login a été utilisé pour se connecter*/
$p_infos='SELECT * FROM adherent WHERE Identifiant LIKE "' . $_POST['pLogin'] .'"';

/*Retourne le type de l'utilisateur*/
$p_type='SELECT type FROM adherent WHERE Identifiant LIKE "' . $_POST['pLogin'] .'"';



											/* ADMIN */

	/* ADM/COURSES.PHP */


/*Renvoie toutes courses*/
$p_c='SELECT * FROM course';

/*Renvoie toutes les éditions*/
$p_edt="SELECT * FROM edition";

/*Ajoute une course, l'IdC est géré automatiquement*/
$p_courses="INSERT INTO course (IdC, Nom, Annee_creation, Mois) VALUES (".$id.", '".$_POST['name_add']."', ".$_POST['year_add'].", '".$_POST['mois_add']."')";

/*Ajoute une édition, l'IdC est géré automatiquement*/
$p_courses="INSERT INTO edition (IdE, IdC, Annee, Nb_participants, Plan, Adresse_depart, Date_inscriptions, Date_depot, Date_recuperation, Site, Tarifs) VALUES (".$id.", ".$_POST['idc_add_edt'].", ".$_POST['year_add_edt'].", ".$_POST['nbpart_add_edt'].", '".$_POST['plan_add_edt']."', '".$_POST['adep_add_edt']."', '".$_POST['dati_add_edt']."', '".$_POST['datd_add_edt']."', '".$_POST['datr_add_edt']."', '".$_POST['site_add_edt']."', '".$_POST['tarif_add_edt']."')";

/*Supprime une course d'un IdC donné*/
$p_courses="DELETE FROM course WHERE IdC LIKE '".$_POST['id_del']."'"; 

/*Supprime une édition d'un IdE donné*/
$p_edt="DELETE FROM edition WHERE IdE LIKE '".$_POST['id_del_edt']."'";

/*Renvoie l'IdC le plus haut*/
$p_idc='SELECT MAX(IdC) FROM course';

/*Renvoie l'IdE le plus haut*/
$p_ide="SELECT MAX(IdE) FROM edition";


	/* ADM/COURSE.PHP */


/*Renvoie toutes courses*/
$p_c='SELECT * FROM course';

/*Renvoie toutes les éditions*/
$p_ed='SELECT * FROM edition';

/*Met à jour la table courses d'un IdC précisé pour un certain attribut*/
$p_m="UPDATE course SET ".$_POST["attribut"]." = '".$_POST["nveau"]."' WHERE IdC LIKE '".$_POST["amodif"]."'";

/*Met à jour la table édition d'un IdE précisé pour un certain attribut*/
$p_m="UPDATE edition SET ".$_POST["editattribut"]." = '".$_POST["editnveau"]."' WHERE IdE LIKE '".$_POST["editmodif"]."'";


	/* ADM/ADHERENT.PHP */

/*Affiche tous les adhérents dans l'ordre d'IdA croissant*/
$p_res="SELECT * FROM adherent ORDER BY IdA ASC";

/*Met à jour la table adhérent d'un IdA précisé pour un certain attribut*/
$p_m="UPDATE adherent SET ".$_POST['attribut']." = '".$_POST['nveau']. "' WHERE IdA LIKE ".$_POST['id_correct'];


	/* ADM/ADHERENTS.PHP */

/*Affiche tous les adhérents dans l'ordre d'IdA croissant*/
$p_res="SELECT * FROM adherent ORDER BY IdA ASC";

/*Ajoute un adhérent, il faut préciser l'IdA*/
$p_adh= "INSERT INTO adherent (IdA, Nom, Prenom, Date_naissance, Sexe, Adresse, dateCertif, Club, Identifiant, Pwd, Type) VALUES (".$_POST['id_add'].", '".$_POST['name_add']."', '".$_POST['prn_add']."', '".$_POST['year_add']."', '".$_POST['sexe_add']."', '".$_POST['adr_add']."', '".$_POST['certif_add']."', '".$_POST['club_add']."', '".$_POST['ident_add']."', '".$_POST['pwd_add']."', 0)";

/*Supprime un adhérent d'un IdA renseigné*/
$p_adh="DELETE FROM adherent WHERE IdA LIKE '".$_POST['id_del']."'"; 


	/* ADM/RESULTATS.PHP */

/*Affiche les résulats d'une édition d'un IdE donné*/
$p_rescheck='SELECT * FROM resultat WHERE IdE LIKE "'.$_POST['idcheck'].'" ORDER BY rang';

/*Prend l'IdE maximal*/
$p_ed="SELECT MAX(IdE) FROM edition";

/*On séléctionne les couples course/édition de même IdC*/
$p_c="SELECT * FROM course AS c NATURAL JOIN edition AS e WHERE c.IdC LIKE e.IdC";


	/* ADM/IMPORT.PHP */

/*Affiche IdE, Année, nom des couples course/édition de même IdC*/
$p="SELECT e.IdE, e.Annee, c.Nom FROM edition AS e NATURAL JOIN course AS c";

/*Affiche les IdEpreuve, distance, et nom de courses des couples course/épreuve de même IdC, dans l'ordre croissant d'IdEpreuve*/
$p="SELECT ep.IdEpreuve, ep.distance, c.nom AS 'Nom course' FROM epreuve AS ep JOIN course AS c ON c.IdC=ep.IdC ORDER BY IdEpreuve ASC";

/*Séléctionne les lignes de resultat d'un numéro de dossard donné*/
$p='SELECT * FROM resultat WHERE dossard='.$ligne[0];

/*Ajoute à temps_passage une ligne de valeurs spécifiées*/
$p_up='INSERT INTO temps_passage (dossard, km, temps) VALUES ("'.$ligne[0].'", "'.$ligne[1].'", "'.$ligne[2].'")';

/*Récupère nom, dossard d'un numéro de dossard donné*/
$p_check='SELECT dossard, nom FROM resultat WHERE dossard='.$nbdossard;

/*Récupère le nb de participants de l'édition renseignée*/
$pligne='SELECT Nb_participants FROM edition WHERE IdE='.$_POST['id_ed'];

/*Met à jour le nb de participants de l'édition renseignée*/
$paddnb='UPDATE edition SET Nb_participants="'.$nbpart.'" WHERE IdE='.$_POST['id_ed'];

/*Récupère les lignes d'adhérent de nom et prenom donnés*/
$p='SELECT * FROM adherent WHERE nom LIKE "'.$ligne[2].'" AND prenom LIKE "'.$ligne[3].'"';

/*Ajoute à resultat une ligne pour un participant ayant abandonné*/
$p_up='INSERT INTO resultat (dossard, rang, nom, prenom, sexe, IdEpreuve, IdE) VALUES ("'.$ligne[0].'", NULL, "'.$ligne[2].'", "'.$ligne[3].'", "'.$ligne[4].'", "'.$_POST['epr'].'", "'.$_POST['id_ed'].'")';

/*Ajoute à resultat une ligne pour un participant classé*/
$p_up='INSERT INTO resultat (dossard, rang, nom, prenom, sexe, IdEpreuve, IdE) VALUES ("'.$ligne[0].'", '.$ligne[1].', "'.$ligne[2].'", "'.$ligne[3].'", "'.$ligne[4].'", "'.$_POST['epr'].'", "'.$_POST['id_ed'].'")';


	/* ADM/ACCUEIL.PHP */

/*Récupère les noms de courses*/
$p="SELECT nom FROM course";

/*Récupère l'IdC maximal*/
$nb="SELECT MAX(IdC) FROM course";

/*Récupère l'IdE maximal*/
$nb="SELECT MAX(IdE) FROM resultat";

/*Récupère IdE, Année, nom, nb de participants adhérents d'une édition*/
$p="SELECT e.IdE, e.Annee, c.Nom, COUNT(DISTINCT r.dossard) AS 'Nombre de participants adhérents' FROM edition AS e NATURAL JOIN course AS c JOIN epreuve AS ep ON c.IdC=ep.IdC JOIN resultat AS r ON r.IdE=e.IdE AND ep.IdEpreuve=r.IdEpreuve WHERE e.IdE=".$i;

/*Récupère les lignes de course de même nom que la séléction*/
$p='SELECT * FROM course WHERE nom LIKE "'.$_GET['idcr'].'"';

/*Récupère les informations d'une édition de course d'IdE renseigné*/
$p='SELECT e.IdE, e.IdC, e.Annee, e.Nb_participants, e.Plan, e.Adresse_depart, e.Date_inscriptions, e.Date_depot, e.Date_recuperation, e.Site, e.Tarifs  FROM edition AS e JOIN course AS c ON e.IdC=c.IdC WHERE e.IdE LIKE "'.$_GET['ided'].'"';

/*Récupère le rang, nom, prenom d'un adherent pour une epreuve d'une edition de course, et la distance de l'épreuve, d'un IdE renseigné*/
$p='SELECT e.IdE, e.IdC, e.Annee, e.Nb_participants, e.Plan, e.Adresse_depart, e.Date_inscriptions, e.Date_depot, e.Date_recuperation, e.Site, e.Tarifs  FROM edition AS e JOIN course AS c ON e.IdC=c.IdC WHERE e.IdE LIKE "'.$_GET['ided'].'"';

/*Récupère les IdEpreuve de courses ayant des éditions, d'un IdE renseigné*/
$p="SELECT ep.IdEpreuve FROM epreuve AS ep JOIN course AS c ON ep.IdC=c.IdC JOIN edition AS e ON e.IdC=c.IdC WHERE e.IdE=".$_GET['ided'];

/*Récupère la distance d'une épreuve et d'un IdE donnés*/
$p="SELECT ep.distance AS 'Distance' FROM epreuve AS ep JOIN course AS c ON ep.IdC=c.IdC JOIN edition AS e ON e.IdC=c.IdC WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve'];

/*Récupère le nombre de participants adhérents à une édition de course d'un IdE donné*/
$p="SELECT COUNT(DISTINCT r.dossard) AS 'Nombre de participants adhérents' FROM edition AS e NATURAL JOIN course AS c JOIN epreuve AS ep ON c.IdC=ep.IdC JOIN resultat AS r ON r.IdE=e.IdE AND ep.IdEpreuve=r.IdEpreuve WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve'];

/*Récupère le nombre de participants adhérents licenciés à une édition de course par épreuve d'un IdE donné*/
$p="SELECT COUNT(DISTINCT a.IdA) AS 'Nombre de participants adhérents licenciés' FROM adherent AS a JOIN resultat AS r ON a.nom=r.nom AND a.prenom=r.prenom JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE WHERE e.IdE=".$_GET['ided']." AND a.club IS NOT NULL AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve'];

/*Récupère le nombre de clubs représentés à une édition de course par épreuve d'un IdE donné*/
$p="SELECT COUNT(DISTINCT a.club) AS 'Nombre de clubs représentés' FROM adherent AS a JOIN resultat AS r ON a.nom=r.nom AND a.prenom=r.prenom JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve'];

/*Récupère le temps du vainqueur à une édition de course par épreuve d'un IdE donné*/
$p="SELECT MIN(tp.temps) AS 'Temps du vainqueur' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND tp.km=".$newtab[$j+1][0];

/*Récupère le plus petit temps mis par un adhérent à une édition de course par épreuve d'un IdE donné*/
$pmin="SELECT MIN(tp.temps) AS 'Meilleur temps adhérent' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard JOIN adherent AS a on a.nom=r.nom AND a.prenom=r.prenom WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND tp.km=".$newtab[$j+1][0];

/*Récupère le plus grand temps mis par un adhérent à une édition de course par épreuve d'un IdE donné*/
$pmax="SELECT MAX(tp.temps) AS 'Pire temps adhérent' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard JOIN adherent AS a on a.nom=r.nom AND a.prenom=r.prenom WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND tp.km=".$newtab[$j+1][0];

/*Récupère la moyenne de temps des adhérents à une édition de course par épreuve d'un IdE donné*/
$p="SELECT AVG(tp.temps) AS 'Moyenne temps adhérents' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard JOIN adherent AS a on a.nom=r.nom AND a.prenom=r.prenom WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND tp.km=".$newtab[$j+1][0];

/*Récupère le nombre d'abandons d'adhérents à une édition de course par épreuve d'un IdE donné*/
$p="SELECT COUNT(DISTINCT(r.dossard)) AS 'Nombre d abandons adhérents' FROM  resultat AS r  JOIN epreuve AS ep ON ep.IdEpreuve=r.IdEpreuve JOIN edition AS e ON e.IdE=r.IdE JOIN temps_passage AS tp ON tp.dossard=r.dossard JOIN adherent AS a on a.nom=r.nom AND a.prenom=r.prenom WHERE e.IdE=".$_GET['ided']." AND ep.IdEpreuve=".$tab_epreuve[$j+1]['IdEpreuve']." AND r.rang IS NULL";



											/* ADHERENT */
 	
 	/* ADH/COURSE.PHP */

/*Séléctionne les courses*/
$p_c='SELECT * FROM course';

/*Séléctionne les éditions*/
$p_ed='SELECT * FROM edition';


	/* ADH/COURSES.PHP */

/*Séléctionne l'année, la distance et le temps mit des épreuves d'éditions de courses courues par l'adhérent*/
$p="SELECT  e.Annee, ep.distance, CONCAT(FLOOR(tp.temps/60),'h',tp.temps%60) AS 'Temps', c.nom  FROM  resultat AS r JOIN edition AS e ON r.IdE=e.IdE JOIN adherent ON r.nom=adherent.nom JOIN course AS c ON c.IdC=e.IdC JOIN epreuve AS ep ON ep.IdC=c.IdC JOIN temps_passage AS tp ON tp.dossard=r.dossard WHERE Identifiant ='".$_SESSION['slogin']."' AND tp.km=ep.distance ORDER BY e.Annee DESC, ep.distance DESC, tp.temps ASC";


	/* ADH/FICHE.PHP */

/*Séléctionne toutes les informations de l'adhérent sauf son type*/
$p_res="SELECT IdA, nom, prenom, Date_naissance, sexe, Adresse, dateCertif, club, Identifiant, pwd FROM adherent WHERE Identifiant LIKE '".$_SESSION["slogin"]."'";

/*Met à jour les informations de l'adhérent pour un certain attribut*/
$p_m="UPDATE adherent SET ".$_POST['attribut']." = '".$_POST['nveau']. "' WHERE Identifiant LIKE '".$_SESSION['slogin']."'";


	/* ADH/RESULATS.PHP */

/*Séléctionne les informations de temps_passage de l'adhérent pour une édition donnée*/
$p="SELECT t.dossard, t.km, t.temps FROM temps_passage AS t JOIN resultat ON t.Dossard=resultat.Dossard JOIN adherent AS A ON A.nom=resultat.nom WHERE Identifiant = ".$_SESSION['slogin']." AND resultat.IdE = ".$_POST['id_ed'];

/*Séléctionne nom de course et année d'édition des couples course/édition pour un IdE donné*/
$p_nom="SELECT c.Nom, e.Annee FROM course AS c NATURAL JOIN edition AS e WHERE e.IdE = ".$_POST['id_ed'];

/*Séléctionne nom de course et année d'édition des couples course/édition*/
$p="SELECT e.IdE, e.Annee, c.Nom FROM edition AS e NATURAL JOIN course AS c";


	/* ADH/ACCUEIL.PHP */

/*Récupère les informations de l'adhérent qui vient de se connecter*/
$p_idk='SELECT * FROM adherent WHERE Identifiant LIKE "'.$_SESSION["slogin"].'" AND pwd LIKE "'.$_SESSION["sPwd"].'"';

/*Met à jour la fiche de l'adhérent avec les informations données*/
$p='UPDATE adherent SET nom="'.$_POST['newnom'].'", prenom="'.$_POST['newprenom'].'", sexe="'.$_POST['newsexe'].'", adresse="'.$_POST['newadresse'].'", Date_naissance="'.$_POST['newdate'].'", dateCertif="'.$_POST['newcertif'].'", club="'.$_POST['newclub'].'" WHERE Identifiant LIKE "'.$_SESSION["slogin"].'"';

/*Récupère nom, prenom, sexe de l'adhérent connecté*/
$p='SELECT nom, prenom, sexe FROM adherent WHERE Identifiant LIKE "'.$_SESSION["slogin"].'" AND pwd LIKE "'.$_SESSION["sPwd"].'"';



										/* END */



















