<?php

// query
if (isset($_POST['save'])) {
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
    $status = 'ACTIF';
    $class_id = $_POST['classe_id'];
    $id_acad = $_POST['id_acad'];
    $cout = $_POST['cout'];
    // $nomPhoto = $_FILES['photos']['name'];
    // $fichierTempo = $_FILES['photos']['tmp_name'];
    //move_uploaded_file($fichierTempo, '../img/' . $nomPhoto);
    include('../connexion/conn.php');
    $result = $bdd->prepare("SELECT COUNT(code_eleve) AS code FROM inscription");
    $result->execute();
    $row = $result->fetch();
    $t = substr($nom, 0, 3);
    $u = substr($prenom, 0, 3);
    $code = $t . "" . $u . "-" . "1000" . $row['code'];

    $extension = array('jpeg', 'jpg', 'png', 'gif');
    foreach ($_FILES['photos']['tmp_name'] as $key => $value) {
        $filename = $_FILES['photos']['name'][$key];
        $filename_tmp = $_FILES['photos']['tmp_name'][$key];
        echo '<br>';
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

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
            $creattime = date('Y-m-d h:i:s');
            $ps = $bdd->prepare("INSERT INTO inscription(code_eleve, nom, prenom, sexe, date_naissance, tel, lieu_naissance, adresse,  email, dernier_etab, religion,
     derniere_classe, piece_fournies, nom_comp_p, tel1_p, tel2_p, email_p, nom_comp_m, tel1_m, tel2_m, email_m, nom_comp_pers_resp, lien_parental,
     tel1_pers_resp, tel2_pers_resp, email_pers_resp, contact_pers, tel1_con_pers, tel2_con_pers, statut, classe_id, id_acad,photo,date_insc,cout) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),?)");
            $params = array(
                $code, $nom, $prenom, $sexe, $date_naissance, $tel, $lieu_naissance, $adresse, $email, $dernier_etab, $religion, $derniere_classe,
                $piece_fournies, $nom_comp_p, $tel1_p, $tel2_p, $email_p, $nom_comp_m, $tel1_m, $tel2_m, $email_m, $nom_comp_pers_resp, $lien_parental,
                $tel1_pers_resp, $tel2_pers_resp, $email_pers_resp, $contact_pers, $tel1_con_pers, $tel2_con_pers, $status, $class_id, $id_acad, $finalimg, $cout
            );
            $ps->execute($params);
            header("location:../inscriptions/inscription.php");
        } else {
            //display error
        }
    }
}

?>

<?php require_once("../header/header.php"); ?>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- menu_top -->
        <?php require_once("../menu/menu_header.php"); ?>
        <!-- menu_left -->
        <?php require_once("../menu/menu_left.php"); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Gestion des inscriptions</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">Gestion des inscriptions</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">


                    <!-- start your code hear -->
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Formulaire d'inscription</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="bs-stepper">
                                        <div class="bs-stepper-header" role="tablist">
                                            <!-- your steps here -->
                                            <div class="step" data-target="#logins-part">
                                                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Informations personnels</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#information-part">
                                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Informations des Parents ou Personnes responsables</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#information-part1">
                                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">Personne à contacter en cas d'urgence</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                            <!-- your steps content here -->
                                            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" id="quickForm">
                                                <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">NOM</label> <input type="text" name="nom" class="form-control" id="nomEt" pattern="^[A-Za-z]+[ -]?[A-Za-z]+$" maxlength="20" required onkeyup="this.value=this.value.toUpperCase()">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">PRENOM</label> <input type="text" name="prenom" id="pren" pattern="^[A-Za-z]+[ -]?[A-Za-z]+$" maxlength="40" class="form-control" required onkeyup="this.value=this.value.toUpperCase()">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label>SEXE</label> <select class="form-control" name="sexe" required>
                                                                    <option value="">-SELECT-</option>
                                                                    <option value="MASCULIN">MASCULIN</option>
                                                                    <option value="FEMININ">FEMININ</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label>DATE DE NAISSANCE</label>
                                                                <div class="input-group " id="reservationdate" data-target-input="nearest">
                                                                    <input type="text" class="form-control  datetimepicker-input" data-target="#reservationdate" name="date_naissance" id="datee" onchange="ss()" required />
                                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">LIEU DE NAISSANCE</label> <input type="text" class="form-control" name="lieu_naissance" id="lieuDN" pattern="^[A-Z]+[ -]?[A-Z]+[ -]?[A-Z]+$" maxlength="35" required onkeyup="this.value=this.value.toUpperCase()">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <!-- select -->
                                                            <div class="form-group">
                                                                <label>RELIGION</label> <select class="form-control" name="religion" required>
                                                                    <option value="-SELECT-">-SELECT-</option>
                                                                    <option value="CATHOLIQUE">CATHOLIQUE</option>
                                                                    <option value="BAPTISTE">BAPTISTE</option>
                                                                    <option value="ADVENTISTE">ADVENTISTE</option>
                                                                    <option value="PENCOTISTE">PENCOTISTE</option>
                                                                    <option value="TEMOINS DE JEHOVAH">TEMOINS DE JEHOVAH</option>
                                                                    <option value="AUTRES">AUTRES</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <!-- /.col -->
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">DERNIER
                                                                    ETABLISSEMENT FREQUENTER</label> <input type="text" name="dernier_etab" class="form-control" onkeyup="this.value=this.value.toUpperCase()" id="exampleInputEmail1">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">DERNIERE CLASSE
                                                                    FREQUENTER</label> <input type="text" class="form-control" name="derniere_classe" id="exampleInputEmail1" onkeyup="this.value=this.value.toUpperCase()">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4">
                                                            <!-- select -->
                                                            <div class="form-group">
                                                                <label>PIECE FOURNIES</label> <select class="form-control" name="piece_fournies" required>
                                                                    <option value="-SELECT-">-SELECT-</option>
                                                                    <option value="CERTIFICAT DE NAISSANCE">CERTIFICAT DE NAISSANCE</option>
                                                                    <option value="CERTIFICAT DE BAPTEME">CERTIFICAT DE BAPTEME</option>
                                                                    <option value="EXTRAIT D'ARCHIVES">EXTRAIT D'ARCHIVES</option>
                                                                    <option value="CARTE IDENTIFICATION">CARTE IDENTIFICATION</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <!-- /.col -->
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">ADRESSE DE
                                                                    L'ENFANT</label> <input type="text" name="adresse" class="form-control" id="exampleInputEmail1" onkeyup="this.value=this.value.toUpperCase()" required>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">PHOTO</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="photos[]" class="custom-file-input" id="exampleInputFile" multiple>
                                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4">
                                                            <!-- select -->
                                                            <div class="form-group">
                                                                <label>INSCRIT EN</label>
                                                                <select class="form-control" name="classe_id" onchange="ss()" required>
                                                                    <option value="-SELECT-">-SELECT-</option>
                                                                    <?php
                                                                    include('../connexion/conn.php');
                                                                    $result = $bdd->prepare("SELECT * FROM classe ORDER BY classe_name ASC");

                                                                    $result->execute();
                                                                    for ($i = 0; $row = $result->fetch(); $i++) {

                                                                        echo '<option value=' . $row['classe_id'] . '>'  . $row['classe_name'] . '</option>';
                                                                    ?>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <!-- /.col -->
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">TELEPHONE</label> <input type="text" name="tel" class="form-control" id="exampleInputEmail1">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>

                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">EMAIL</label> <input type="text" name="email" class="form-control" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4">
                                                            <!-- select -->
                                                            <div class="form-group">
                                                                <label>ANNEE ACADEMIQUE</label> <select class="form-control" name="id_acad" required>
                                                                    <option value="-SELECT-">-SELECT-</option>
                                                                    <?php
                                                                    include('../connexion/conn.php');
                                                                    $result = $bdd->prepare("SELECT * FROM annee_acad ORDER BY annee_acad ASC");

                                                                    $result->execute();
                                                                    for ($i = 0; $row = $result->fetch(); $i++) {

                                                                        echo '<option value=' . $row['id_acad'] . '>'  . $row['annee_acad'] . '</option>';
                                                                    ?>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                                </div>
                                                <!-- your steps content here -->
                                                <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">NOM COMPLET DU
                                                                    PERE</label> <input type="text" name="nom_comp_p" class="form-control" pattern="^[A-Za-z]+[ -]?[A-Za-z]+$" maxlength="20" id="nomCP" onkeyup="this.value=this.value.toUpperCase()">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">TELEPHONE 1</label> <input type="text" class="form-control" id="exampleInputEmail1" name="tel1_p">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">TELEPHONE 2</label> <input type="text" name="tel2_p" class="form-control" id="exampleInputEmail1">
                                                            </div>

                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">EMAIL</label> <input type="email" name="email_p" class="form-control" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" id="exampleInputEmail1">
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">NOM COMPLET DE LA
                                                                    MERE</label> <input type="text" name="nom_comp_m" class="form-control" pattern="^[A-Za-z]+[ -]?[A-Za-z]+$" maxlength="20" id="nomCM" onkeyup="this.value=this.value.toUpperCase()">

                                                            </div>

                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">TELEPHONE 1</label> <input type="text" name="tel1_m" class="form-control" pattern="^[0-9]{4}[ -]?[0-9]{4}$" maxlength="9" id="exampleInputEmail1">
                                                                <div class="invalid-feedback"></div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">TELEPHONE 2</label> <input type="text" name="tel2_m" class="form-control" pattern="^[0-9]{4}[ -]?[0-9]{4}$" maxlength="9" id="exampleInputEmail1">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">EMAIL</label> <input type="text" name="email_m" class="form-control" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$">

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="line">
                                                        <center>
                                                            <h4>OU</h4>
                                                        </center>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">NOM COMPLET DE LA
                                                                    PERSONNE RESPONSABLE</label> <input type="text" name="nom_comp_pers_resp" pattern="^[A-Za-z]+[ -]?[A-Za-z]+$" maxlength="20" class="form-control" onkeyup="this.value=this.value.toUpperCase()" id="exampleInputEmail1">
                                                                <div class="invalid-feedback"></div>
                                                            </div>

                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">TELEPHONE 1</label> <input type="text" name="tel1_pers_resp" class="form-control" pattern="^[0-9]{4}[ -]?[0-9]{4}$" maxlength="9" id="exampleInputEmail1">
                                                                <div class="invalid-feedback"></div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">TELEPHONE 2</label> <input type="text" name="tel2_pers_resp" class="form-control" pattern="^[0-9]{4}[ -]?[0-9]{4}$" maxlength="9" id="exampleInputEmail1">
                                                                <div class="invalid-feedback"></div>
                                                            </div>

                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">EMAIL</label> <input type="text" name="email_pers_resp" class="form-control" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" id="exampleInputEmail1">
                                                                <div class="invalid-feedback"></div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                                </div>
                                                <!-- your steps content here -->
                                                <div id="information-part1" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">PERSONNE A
                                                                    CONTACTER EN CAS D'URGENCE</label> <input type="text" name="contact_pers" pattern="^[A-Za-z]+[ -]?[A-Za-z]+$" maxlength="20" required class="form-control" onkeyup="this.value=this.value.toUpperCase()" id="PersUrg">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">LIEN PARENTAL</label> <input type="text" name="lien_parental" class="form-control" pattern="^[A-Za-z]+[ -]?[A-Za-z]+$" maxlength="20" required id="LienP" onkeyup="this.value=this.value.toUpperCase()">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label>TELEPHONE 1:</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i>+(509)</i></span>
                                                                    </div>
                                                                    <input type="text" name="tel1_con_pers" class="form-control" id="tel1" pattern="^[0-9]{4}[ -]?[0-9]{4}$" maxlength="9" required>
                                                                    <div class="invalid-feedback"></div>
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">TELEPHONE 2</label> <input type="text" name="tel2_con_pers" class="form-control" id="exampleInputEmail1">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">COUT DE L'INSCRIPTION</label> <input type="number" name="cout" class="form-control" id="exampleInputEmail1">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->

                <!--/ end code -->

        </div>
        </section>
    </div>
    <?php
    require_once("../footer.php");
    ?>
    </div>
    <?php
    require_once("../js/js.php");
    ?>



    <script type="text/javascript">
        var id = 0;

        function ss() {
            id = $('#classe').val()
            var d = new Date($('#datee').val());
            contrainteDate(d.getFullYear());

        }


        function contrainteDate(dat) {
            var d1 = new Date();
            var dat1 = d1.getFullYear();
            var result = dat1 - dat;

            if (result > 1) {
                if (result >= 2 && result <= 4) {


                    var t1 = contrainteClasse($('#classe #' + id).text(), "3EME ANNEE");
                    var t2 = contrainteClasse($('#classe #' + id).text(), "4EME ANNEE");
                    var t3 = contrainteClasse($('#classe #' + id).text(), "5EME ANNEE");
                    var t4 = contrainteClasse($('#classe #' + id).text(), "6EME ANNEE");

                    var t5 = contrainteClasse($('#classe #' + id).text(), "8EME ANNEE");
                    var t6 = contrainteClasse($('#classe #' + id).text(), "9EME ANNEE");
                    var t7 = contrainteClasse($('#classe #' + id).text(), "3EME");
                    var t8 = contrainteClasse($('#classe #' + id).text(), "SECONDE");
                    var t9 = contrainteClasse($('#classe #' + id).text(), "RETHO");
                    var t10 = contrainteClasse($('#classe #' + id).text(), "PHILO");
                    var t11 = contrainteClasse($('#classe #' + id).text(), "7EME ANNEE");
                    if (t1 || t2 || t3 || t4 || t5 || t6 || t7 || t8 || t9 || t10 || t11) {
                        $.notify("classe incorrect");
                        $('#classe').val("1ERE et 2EME ANNEE");
                    }
                }

                if (result >= 4 && result <= 8) {
                    var t3 = contrainteClasse($('#classe #' + id).text(), "5EME ANNEE");
                    var t4 = contrainteClasse($('#classe #' + id).text(), "6EME ANNEE");

                    var t5 = contrainteClasse($('#classe #' + id).text(), "8EME ANNEE");
                    var t6 = contrainteClasse($('#classe #' + id).text(), "9EME ANNEE");
                    var t7 = contrainteClasse($('#classe #' + id).text(), "3EME");
                    var t8 = contrainteClasse($('#classe #' + id).text(), "SECONDE");
                    var t9 = contrainteClasse($('#classe #' + id).text(), "RETHO");
                    var t10 = contrainteClasse($('#classe #' + id).text(), "PHILO");
                    var t11 = contrainteClasse($('#classe #' + id).text(), "7EME ANNEE");
                    if (t3 || t4 || t5 || t6 || t7 || t8 || t9 || t10 || t11) {
                        $.notify("classe incorrect");
                        $('#classe').val("3EME et 4EME ANNEE");
                    }

                }

                if (result >= 8 && result <= 14) {
                    var t11 = contrainteClasse($('#classe #' + id).text(), "7EME ANNEE");
                    var t5 = contrainteClasse($('#classe #' + id).text(), "8EME ANNEE");
                    var t6 = contrainteClasse($('#classe #' + id).text(), "9EME ANNEE");
                    var t7 = contrainteClasse($('#classe #' + id).text(), "3EME");
                    var t8 = contrainteClasse($('#classe #' + id).text(), "SECONDE");
                    var t9 = contrainteClasse($('#classe #' + id).text(), "RETHO");
                    var t10 = contrainteClasse($('#classe #' + id).text(), "PHILO");
                    if (t5 || t6 || t7 || t8 || t9 || t10 || t11) {
                        $.notify("classe incorrect");
                        $('#classe').val("5EME a 6EME ANNEE");
                    }

                }
                if (result <= 15) {

                    var t12 = contrainteClasse($('#classe #' + id).text(), "Aucun");

                }
            } else {

                $.notify('date incorrect');
                $('#datee').val("");
            }

        }

        function contrainteClasse(classe, classeInitial) {
            var test = false;
            if (classeInitial != "Aucun") {
                if (classe == classeInitial) {
                    test = true;
                }
            }
            return test;
        }
    </script>
</body>