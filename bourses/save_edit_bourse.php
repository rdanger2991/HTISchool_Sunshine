<?php
// configuration
include('../connexion/conn.php');
// new data
if(isset($_POST['update_b'])){

    $id = $_POST['id_bourse'];
    $a = $_POST['code_bourse'];
    $b = $_POST['cate_bourse'];
    $d = $_POST['id_insc'];
    $e = $_POST['id_mod_paie'];
    $f = $_POST['cout_bourse'];
    $g = $_POST['classe_id'];
// query
$sql = "UPDATE bourse 
        SET code_bourse=?, reduction=?, id_ins=?, id_type_bourse=?, id_mod_paie=?, classe_id=?   WHERE id_bourse=?";
$q = $bdd->prepare($sql);
$q -> execute(array($a, $f, $d, $b, $e, $g,$id));
header("location: ../bourses/bourse.php");

}
