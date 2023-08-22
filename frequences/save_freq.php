<?php
include('../connexion/conn.php');
$b = $_POST['frequence'];
$c = $_POST['id_cat_freq'];

// query
$sql = "INSERT INTO frequence (frequence,id_cat_freq) VALUES (:b,:c)";
$q = $bdd->prepare($sql);
$q->execute(array(':b'=>$b,':c'=>$c));
header("location: ../frequences/frequence.php");
