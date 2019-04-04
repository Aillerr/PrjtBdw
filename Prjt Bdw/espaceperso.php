<?php $page = $_GET["page"];
 if($page == "courses"){
 	include ("./adm/courses.php") ;
  }else if($page == "adherents") {
  	include ("./adm/adherents.php"); 
    }else{  include("./erreur.php");
     }
?>