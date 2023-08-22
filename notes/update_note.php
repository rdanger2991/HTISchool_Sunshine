<?php
require_once("../connexion/conn.php");
    $freq=$_POST['freq'];
    $id_mat = $_POST['matiere'];
	$note  = $_POST["note"];
    $id_note = $_POST['id_note'];
 $ps = $bdd->prepare ("UPDATE note set note=?, id_freq=? where id_note=?");
$params=array($note, $freq, $id_note);
$ps->execute($params);
header("location:../notes/liste_des_notes.php");
?>
