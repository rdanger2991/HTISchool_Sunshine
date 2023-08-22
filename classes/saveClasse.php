<?php
include('../connexion/conn.php');
$a = $_POST['code_classe'];
$b = $_POST['cate_classe'];
$c = $_POST['classe_name'];


$result = $bdd->prepare("SELECT COUNT(code_classe) AS code FROM classe");
$result->execute();
$row = $result->fetch();
//$t= substr($c,0 ,3);
//$a=$t.""."1000".$row['code'];

$a="SUNACA-"."1000".$row['code'];

// query
$sql = "INSERT INTO classe (code_classe,cate_classe,classe_name) VALUES (:a,:b,:c)";
$q = $bdd->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
header("location: ../classes/classe.php");


?>