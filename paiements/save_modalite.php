<?php
//if(isset($_POST['save'])){
$a = $_POST['modalite'];
$b = $_POST['categorie_type'];
$c = $_POST['cout'];
$d = $_POST['classe'];
include('../connexion/conn.php');
// query
$ps=$bdd->prepare("INSERT INTO paiement_add_modalite (modalite,id_type_paiement,cout,classe_id) VALUES (?,?,?,?)");
$params=array($a,$b,$c,$d);
$ps->execute($params);
header("location: ../paiements/paiement_add_modalite.php");
//}
