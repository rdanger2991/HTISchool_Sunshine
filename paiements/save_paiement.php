<?php
include('../connexion/conn.php');
$a = $_POST['trx_number'];
$b = $_POST['id_insc'];
$c = $_POST['modalite'];
$d = $_POST['cash'];
$e = $_POST['quantiteVerser'];
$f = $_POST['balance'];
$g = $_POST['id_acad'];
$i = $_POST['classe_id'];
$j = $_POST['id_bourse'];
$k = $_POST['code_eleve'];




echo $c;
 //query
$sql = "INSERT INTO info_paiement (code_paiement, montant_verse, balance, date_paiement, id_insc, id_acad, id_mod_paie, classe_id,id_bourse) VALUES (:a,:e,:f,now(),:b,:g,:c,:i,:j)";
$q = $bdd->prepare($sql);
$q->execute(array(':a'=>$a,':e'=>$e,':f'=>$f, ':b' => $b, ':g' => $g, ':c' => $c, ':i' =>$i, ':j' => $j));
header("location: multi_paiement.php?id=$d&trx_number=$a&code_eleve=$k");

?>
