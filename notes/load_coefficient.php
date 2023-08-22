<?php
include('../connexion/conn.php');
if (isset($_GET['id_matiere'])) {
    $id=$_GET['id_matiere'];
    $result = $bdd->prepare("SELECT *from matiere WHERE id_matiere= $id");
    //$params = array($id);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {

        $data[]=$row;
    echo json_encode($data);
    
    }   
}
