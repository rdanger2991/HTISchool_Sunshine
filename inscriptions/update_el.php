<?php
require_once("../connexion/conn.php");
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $tel = $_POST['tel'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $dernier_etab = $_POST['dernier_etab'];
    $religion = $_POST['religion'];
    $derniere_classe = $_POST['derniere_classe'];
    $piece_fournies = $_POST['piece_fournies'];
    $nom_comp_p = $_POST['nom_comp_p'];
    $tel1_p = $_POST['tel1_p'];
    $tel2_p = $_POST['tel2_p'];
    $email_p = $_POST['email_p'];
    $nom_comp_m = $_POST['nom_comp_m'];
    $tel1_m = $_POST['tel1_m'];
    $tel2_m = $_POST['tel2_m'];
    $email_m = $_POST['email_m'];
    $nom_comp_pers_resp = $_POST['nom_comp_pers_resp'];
    $lien_parental = $_POST['lien_parental'];
    $tel1_pers_resp = $_POST['tel1_pers_resp'];
    $tel2_pers_resp = $_POST['tel2_pers_resp'];
    $email_pers_resp = $_POST['email_pers_resp'];
    $contact_pers = $_POST['contact_pers'];
    $tel1_con_pers = $_POST['tel1_con_pers'];
    $tel2_con_pers = $_POST['tel2_con_pers'];
    $status =  $_POST['status'];;
    $class_id = $_POST['classe_id'];
    $id_acad = $_POST['id_acad'];
    $cout = $_POST['cout'];
    $id_insc=$_POST['id_insc'];

$extension = array('jpeg', 'jpg', 'png', 'gif');
foreach ($_FILES['photos']['tmp_name'] as $key => $value) {
    $filename = $_FILES['photos']['name'][$key];
    $filename_tmp = $_FILES['photos']['tmp_name'][$key];
    echo '<br>';
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($filename == '') {
        $ps = $bdd->prepare("UPDATE  inscription SET  nom=?, prenom=?, sexe=?, date_naissance=?, tel=?, lieu_naissance=?, adresse=?,  email=?, dernier_etab=?, religion=?,
     derniere_classe=?, piece_fournies=?, nom_comp_p=?, tel1_p=?, tel2_p=?, email_p=?, nom_comp_m=?, tel1_m=?, tel2_m=?, email_m=?, nom_comp_pers_resp=?, lien_parental=?,
     tel1_pers_resp=?, tel2_pers_resp=?, email_pers_resp=?, contact_pers=?, tel1_con_pers=?, tel2_con_pers=?, statut=?, classe_id=?, id_acad=?,cout=? where id_insc=?");
        $params = array(
            $nom, $prenom, $sexe, $date_naissance, $tel, $lieu_naissance, $adresse, $email, $dernier_etab, $religion, $derniere_classe,
            $piece_fournies, $nom_comp_p, $tel1_p, $tel2_p, $email_p, $nom_comp_m, $tel1_m, $tel2_m, $email_m, $nom_comp_pers_resp, $lien_parental,
            $tel1_pers_resp, $tel2_pers_resp, $email_pers_resp, $contact_pers, $tel1_con_pers, $tel2_con_pers, $status, $class_id, $id_acad, $cout, $id_insc
        );
        $ps->execute($params);
    } else {
    $finalimg = '';
    if (in_array($ext, $extension)) {
        if (!file_exists('../img/' . $filename)) {
            move_uploaded_file($filename_tmp, '../img/' . $filename);
            $finalimg = $filename;
        } else {
            $filename = str_replace('.', '-', basename($filename, $ext));
            $newfilename = $filename . time() . "." . $ext;
            move_uploaded_file($filename_tmp, '../img/' . $newfilename);
            $finalimg = $newfilename;
        }

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $sexe = $_POST['sexe'];
            $date_naissance = $_POST['date_naissance'];
            $tel = $_POST['tel'];
            $lieu_naissance = $_POST['lieu_naissance'];
            $adresse = $_POST['adresse'];
            $email = $_POST['email'];
            $dernier_etab = $_POST['dernier_etab'];
            $religion = $_POST['religion'];
            $derniere_classe = $_POST['derniere_classe'];
            $piece_fournies = $_POST['piece_fournies'];
            $nom_comp_p = $_POST['nom_comp_p'];
            $tel1_p = $_POST['tel1_p'];
            $tel2_p = $_POST['tel2_p'];
            $email_p = $_POST['email_p'];
            $nom_comp_m = $_POST['nom_comp_m'];
            $tel1_m = $_POST['tel1_m'];
            $tel2_m = $_POST['tel2_m'];
            $email_m = $_POST['email_m'];
            $nom_comp_pers_resp = $_POST['nom_comp_pers_resp'];
            $lien_parental = $_POST['lien_parental'];
            $tel1_pers_resp = $_POST['tel1_pers_resp'];
            $tel2_pers_resp = $_POST['tel2_pers_resp'];
            $email_pers_resp = $_POST['email_pers_resp'];
            $contact_pers = $_POST['contact_pers'];
            $tel1_con_pers = $_POST['tel1_con_pers'];
            $tel2_con_pers = $_POST['tel2_con_pers'];
            $status =  $_POST['status'];;
            $class_id = $_POST['classe_id'];
            $id_acad = $_POST['id_acad'];
            $cout = $_POST['cout'];
            $id_insc = $_POST['id_insc'];
        

       
            $ps = $bdd->prepare("UPDATE  inscription SET  nom=?, prenom=?, sexe=?, date_naissance=?, tel=?, lieu_naissance=?, adresse=?,  email=?, dernier_etab=?, religion=?,
     derniere_classe=?, piece_fournies=?, nom_comp_p=?, tel1_p=?, tel2_p=?, email_p=?, nom_comp_m=?, tel1_m=?, tel2_m=?, email_m=?, nom_comp_pers_resp=?, lien_parental=?,
     tel1_pers_resp=?, tel2_pers_resp=?, email_pers_resp=?, contact_pers=?, tel1_con_pers=?, tel2_con_pers=?, statut=?, classe_id=?, id_acad=?,photo=?,cout=? where id_insc=?");
            $params = array(
                $nom, $prenom, $sexe, $date_naissance, $tel, $lieu_naissance, $adresse, $email, $dernier_etab, $religion, $derniere_classe,
                $piece_fournies, $nom_comp_p, $tel1_p, $tel2_p, $email_p, $nom_comp_m, $tel1_m, $tel2_m, $email_m, $nom_comp_pers_resp, $lien_parental,
                $tel1_pers_resp, $tel2_pers_resp, $email_pers_resp, $contact_pers, $tel1_con_pers, $tel2_con_pers, $status, $class_id, $id_acad, $finalimg, $cout, $id_insc
            );
            $ps->execute($params);
        }
    

    }
  
    header("location:../inscriptions/inscription.php");
}
    ?>

 

