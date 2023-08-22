<?php
//if(isset($_POST['save'])){
$d = $_POST['code_matiere'];
$a = $_POST['cate_matiere'];
$b = $_POST['classe'];
$c = $_POST['matiere_name'];
$e = $_POST['coefficient'];

include('../connexion/conn.php');
$result = $bdd->prepare("SELECT COUNT(code_matiere) AS code FROM matiere");
$result->execute();
$row = $result->fetch();
$t= substr($c,0 ,4);
$d=$t."-"."1000".$row['code'];

// query
$ps=$bdd->prepare("INSERT INTO matiere (code_matiere,matiere,id_cat_mat,classe_id,coefficient) VALUES (?,?,?,?,?)");
$params=array($d,$c,$a,$b,$e);
$ps->execute($params);
header("location: ../matieres/matiere.php");
//}
?>