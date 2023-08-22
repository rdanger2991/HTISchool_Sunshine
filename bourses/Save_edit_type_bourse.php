<?php
// configuration
include('../connexion/conn.php');
// new data
if(isset($_POST['update_typ_b'])){

$id = $_POST['id_type_bourse'];
$c = $_POST['type_bourse'];
// query
$sql = "UPDATE bourse_type 
        SET type_bourse=? WHERE id_type_bourse=?";
$q = $bdd->prepare($sql);
$q -> execute(array($c,$id));   
header("location: ../bourses/type_de_bourse.php");

}
