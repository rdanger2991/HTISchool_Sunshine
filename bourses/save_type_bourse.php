<?php
require_once("../connexion/conn.php");
$userData = count($_POST["type_bourse"]);
	
	if ($userData > 0) {
	    for ($i=0; $i < $userData; $i++) {
        $cat_bourse   = $_POST["type_bourse"][$i];
			require_once("../connexion/conn.php");
$ps=$bdd->prepare("INSERT INTO bourse_type(type_bourse) VALUES(?)");
$params=array($cat_bourse);
$ps->execute($params);

	    }
		header("location: ../bourses/type_de_bourse.php"); 
	}
