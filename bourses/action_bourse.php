<?php
include('../connexion/conn.php');
$request = 0;

if (isset($_POST['request'])) {
    $request = $_POST['request'];
}
// Fetch state list by countryid
if ($request == 1) {
    $countryid = $_POST['countryid'];
    $stmt = $bdd->prepare("SELECT * FROM paiement_add_modalite WHERE classe_id=:countryname");
    $stmt->bindValue(':countryname', (int)$countryid, PDO::PARAM_INT);
    $stmt->execute();
    $statesList = $stmt->fetchAll();
    $response = array();
    foreach ($statesList as $state) {
        $response[] = array(
        "id" => $state['id_mod_paie'],
            "stateame" => $state['modalite']
        );
    }
    echo json_encode($response);
    exit;
}
// Fetch city list by countryid
if ($request == 2) {
    $stateid = $_POST['countryid1'];
    $stmt = $bdd->prepare("SELECT * FROM inscription WHERE classe_id=:statename ORDER BY nom");
    $stmt->bindValue(':statename', (int)$stateid, PDO::PARAM_INT);
    $stmt->execute();
    $statesList = $stmt->fetchAll();
    $response = array();
    foreach ($statesList as $state) {
        $response[] = array(
         "id" => $state['id_insc'],
            "cityname" => $state['nom']. ' '. $state['prenom']
        );
    }
    echo json_encode($response);
    exit;
}

// Fetch city list by stateid
if ($request == 3) {
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




$a = $_POST['code_bourse'];
$b = $_POST['cate_bourse'];
$d = $_POST['id_insc'];
$e = $_POST['id_mod_paie'];
$f = $_POST['cout_bourse'];
$g = $_POST['classe_id'];


include('../connexion/conn.php');
$result = $bdd->prepare("SELECT COUNT(code_bourse) AS code FROM bourse");
$result->execute();
$row = $result->fetch();
$a = "SUNACA-B-" . "1000" . $row['code'];

// query
$ps = $bdd->prepare("INSERT INTO bourse (code_bourse, reduction, id_ins, id_type_bourse, id_mod_paie,classe_id) VALUES (?,?,?,?,?,?)");
$params = array($a, $f, $d, $b, $e,$g);
$ps->execute($params);
header("location: ../bourses/bourse.php");

?>