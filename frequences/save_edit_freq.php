<?php
// configuration
include('../connexion/conn.php');
// new data
if(isset($_POST['updateClasse'])){

$id = $_POST['id_freq'];
$b = $_POST['frequence'];
$c = $_POST['id_cat_freq'];
// query
$sql = "UPDATE frequence 
        SET frequence=?, id_cat_freq=? WHERE id_freq=?";
$q = $bdd->prepare($sql);
$q -> execute(array($b,$c,$id));   
header("location: ../frequences/frequence.php");

}
