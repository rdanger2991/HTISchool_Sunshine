<?php
include('../connexion/conn.php');
$request = 0;

if (isset($_POST['request'])) {
    $request = $_POST['request'];
}
// Fetch state list by countryid
if ($request == 1) {
    $countryid = $_POST['countryid'];
    $stmt = $bdd->prepare("SELECT * FROM matiere WHERE classe_id=:countryname");
    $stmt->bindValue(':countryname', (int)$countryid, PDO::PARAM_INT);
    $stmt->execute();
    $statesList = $stmt->fetchAll();
    $response = array();
    foreach ($statesList as $state) {
        $response[] = array(
        "id" => $state['id_matiere'],
            "cityname" => $state['matiere']
        );
    }
    echo json_encode($response);
    exit;
}




