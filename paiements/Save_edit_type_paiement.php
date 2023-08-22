<?php
// configuration
include('../connexion/conn.php');
// new data
if(isset($_POST['update_typ_p'])){

$id = $_POST['id_type_paiement'];
$c = $_POST['categorie_type'];
// query
$sql = "UPDATE paiement_modalite_type 
        SET categorie_type=? WHERE id_type_paiement=?";
$q = $bdd->prepare($sql);
$q -> execute(array($c,$id));
    header("location: ../paiements/paiement_modalite_type.php");

}
