<?php
include('../connexion/conn.php');
$a = $_GET['trx_number']; //code_paiement
$b = $_GET['id_insc']; // id_insc
$c = $_GET['id_mod_paie']; //id_mod_paie
//$d = $_GET['cash'];
$e = $_GET['montant_verser']; //motant_verser
$f = $_GET['balance']; //balance
//$i = $_GET['classe_id'];
//$j = $_GET['id_bourse'];
$k = $_GET['code_eleve'];
$l=$_GET['date_paiement']; //date_paie

$result = $bdd->prepare("SELECT id_acad as id FROM annee_acad where id_acad in (select max(id_acad) from annee_acad)");
$result->execute();
$row = $result->fetch();
$g = $row['id']; //id_acad

//echo $k;
 //query
$sql = "INSERT INTO paiement (code_paiement, montant_verse, balance, date_paiement, id_insc, id_acad, id_mod_paie) VALUES (:a,:e,:f,:l,:b,:g,:c)";
$q = $bdd->prepare($sql);
$q->execute(array(':a'=>$a,':e'=>$e,':f'=>$f,':l' => $l, ':b' => $b, ':g' => $g, ':c' => $c));



header("location: print_paie.php?trx_number=$a&code_eleve=$k");
