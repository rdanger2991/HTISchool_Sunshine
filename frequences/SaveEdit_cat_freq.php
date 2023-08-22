<?php
// configuration
include('../connexion/conn.php');
// new data
if(isset($_POST['update_cat_freq'])){

$id = $_POST['id_cat_freq'];
$c = $_POST['cat_freq'];
// query
$sql = "UPDATE cat_freq 
        SET cat_freq=? WHERE id_cat_freq=?";
$q = $bdd->prepare($sql);
$q -> execute(array($c,$id));   
header("location: ../frequences/cat_freq.php");

}
?>
