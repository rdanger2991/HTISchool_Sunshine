<?php
include('../connexion/conn.php');
	$id=$_GET['id'];
	$c=$_GET['trx_number'];
	$d=$_GET['id_trx'];
	
	$result = $bdd->prepare("DELETE FROM info_paiement WHERE id_paie= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
	header("location: new_paiement.php?id=$d&trx_number=$c");
