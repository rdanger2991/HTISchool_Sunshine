<?php

try{
	$bdd = new PDO("mysql:host=127.1.1.0;dbname=HTISchool_sunschine", "", "");
}
catch(PDOException $e){
	$msg='Erreur PDO dans' . $e->getMessage();
	die ($msg);
	
	
}
?>