<?php

try{
  $bdd = new PDO("mysql:host=127.0.0.1;dbname=HTISchool_sunschine", "", "");
  
}
catch(PDOException $e){
	$msg='Erreur PDO dans' . $e->getMessage();
	die ($msg);
	
	
}
?>