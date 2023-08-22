<?php
// configuration
include('../connexion/conn.php');
// new data
if(isset($_POST['update_cat_mat'])){

$id = $_POST['cat_mat_id'];
$c = $_POST['cate_matiere'];
// query
$sql = "UPDATE cate_matiere 
        SET cate_matiere=? WHERE cat_mat_id=?";
$q = $bdd->prepare($sql);
$q -> execute(array($c,$id));   
header("location: ../matieres/cate_matiere.php");

}
?>