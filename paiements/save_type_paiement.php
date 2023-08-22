<?php
require_once("../connexion/conn.php");
$userData = count($_POST["categorie_type"]);

if ($userData > 0) {
    for ($i = 0; $i < $userData; $i++) {
        $cat_type   = $_POST["categorie_type"][$i];
        require_once("../connexion/conn.php");
        $ps = $bdd->prepare("INSERT INTO paiement_modalite_type(categorie_type) VALUES(?)");
        $params = array($cat_type);
        $ps->execute($params);
        header("location: ../paiements/paiement_modalite_type.php");
    }
}
?>