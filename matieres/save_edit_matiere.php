<?php
// configuration
include('../connexion/conn.php');
// new data
if(isset($_POST['updateMatiere'])){

$id = $_POST['id_matiere'];
$a = $_POST['code_matiere'];
$b = $_POST['cate_matiere'];
$c = $_POST['classe_name'];
$d = $_POST['matiere'];
$e = $_POST['coefficient'];
// query
$sql = "UPDATE matiere 
        SET code_matiere=?, matiere=?, id_cat_mat=?, classe_id=?, coefficient=? WHERE id_matiere=?";
$q = $bdd->prepare($sql);
$q -> execute(array($a,$d,$b,$c,$e,$id));   
header("location: ../matieres/matiere.php");

}
?>