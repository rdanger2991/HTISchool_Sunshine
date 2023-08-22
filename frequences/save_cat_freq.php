<?php
require_once("../connexion/conn.php");
$userData = count($_POST["cat_freq"]);
	
	if ($userData > 0) {
	    for ($i=0; $i < $userData; $i++) {
        $cat_freq   = $_POST["cat_freq"][$i];
			require_once("../connexion/conn.php");
$ps=$bdd->prepare("INSERT INTO cat_freq(cat_freq) VALUES(?)");
$params=array($cat_freq);
$ps->execute($params);

	    }
		header("location: ../frequences/cat_freq.php"); 
	}
?>
