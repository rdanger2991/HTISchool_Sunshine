 <?php
include('../connexion/conn.php');
$a = $_POST['annee_acad'];

// query
$sql = "INSERT INTO annee_acad (annee_acad) VALUES (:a)";
$q = $bdd->prepare($sql);
$q->execute(array(':a'=>$a));
header("location: ../annee_acad/new_acad.php");


?>