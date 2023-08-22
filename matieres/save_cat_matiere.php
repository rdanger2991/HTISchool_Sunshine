<?php
require_once("../connexion/conn.php");
$userData = count($_POST["cate_matiere"]);
	
	if ($userData > 0) {
	    for ($i=0; $i < $userData; $i++) { 
			$cate_matiere   = $_POST["cate_matiere"][$i];
			require_once("../connexion/conn.php");
$ps=$bdd->prepare("INSERT INTO cate_matiere(cate_matiere) VALUES(?)");
$params=array($cate_matiere);
$ps->execute($params);

	    }
		header("location: ../matieres/cate_matiere.php"); 
	}

?>