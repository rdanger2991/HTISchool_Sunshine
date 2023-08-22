<?php
// configuration
include('../connexion/conn.php');
// new data
if (isset($_POST['update_typ_p'])) {

    $id = $_POST['id_mod_paie'];
    $b= $_POST['modalite'];
    $c = $_POST['categorie_type'];
    $d = $_POST['cout'];
    $e = $_POST['classe'];
    // query
    $sql = "UPDATE paiement_add_modalite 
        SET modalite=? , id_type_paiement=? , cout=?, classe_id=? WHERE id_mod_paie=?";
    $q = $bdd->prepare($sql);
    $q->execute(array($b,$c,$d,$e, $id));
    header("location: ../paiements/paiement_add_modalite.php");
}
?>