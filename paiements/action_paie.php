<?php
include('../connexion/conn.php');
$request = 0;

if (isset($_POST['request'])) {
    $request = $_POST['request'];
}
if ($request == 1) {
    $coutModalite = $_POST['stateid'];
    $stmt = $bdd->prepare("SELECT cout FROM paiement_add_modalite WHERE id_mod_paie=:statename");
    $stmt->bindValue(':statename', (int)$coutModalite, PDO::PARAM_INT);
    $stmt->execute();
    $statesList1 = $stmt->fetch();
    $response1 = array();
    $response1[] = array(
        "id" => $statesList1['cout']
    );

    echo json_encode($response1);
    exit;
}

?>