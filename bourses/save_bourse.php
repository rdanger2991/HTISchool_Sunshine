<?php
//if(isset($_POST['save'])){
$a = $_POST['code_bourse'];
$b = $_POST['cate_bourse'];
$d = $_POST['id_insc'];
$e = $_POST['id_mod_paie'];
$f = $_POST['cout_bourse'];


include('../connexion/conn.php');
$result = $bdd->prepare("SELECT COUNT(code_bourse) AS code FROM bourse");
$result->execute();
$row = $result->fetch();
$a = "SUNACA-B-" . "1000" . $row['code'];

// query
$ps=$bdd->prepare("INSERT INTO bourse (code_bourse,reduction,id_insc,id_type_bourse,id_mod_paie) VALUES (?,?,?,?,?)");
$params=array($a,$f,$d,$b,$e);
$ps->execute($params);
header("location: ../bourses/bourse.php");
//}
