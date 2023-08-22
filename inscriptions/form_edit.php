<?php require_once("../header/header.php"); ?>

<?php
$bd_eleve_id = $_GET['bd_eleve_id'];
require_once("../connexion/conn.php");
$ps = $bdd->prepare("SELECT inscription.id_insc, inscription.code_eleve, inscription.nom, inscription.prenom, inscription.sexe, inscription.date_naissance, 
inscription.tel, inscription.lieu_naissance, inscription.adresse,  inscription.email, inscription.dernier_etab, inscription.religion,inscription.nom_comp_p,
inscription.tel1_p, inscription.tel2_p, inscription.email_p, inscription.nom_comp_m, inscription.tel1_m, inscription.tel2_m, inscription.email_m, inscription.nom_comp_pers_resp, inscription.lien_parental,
     inscription.tel1_pers_resp, inscription.tel2_pers_resp, inscription.email_pers_resp, inscription.contact_pers, inscription.tel1_con_pers, inscription.tel2_con_pers,inscription.cout,
     inscription.derniere_classe, inscription.piece_fournies,inscription.classe_id, inscription.id_acad,inscription.photo,inscription.date_insc,inscription.statut,classe.classe_name,annee_acad.annee_acad
                FROM ((inscription
                INNER JOIN classe ON inscription.classe_id = classe.classe_id)
                INNER JOIN annee_acad ON inscription.id_acad = annee_acad.id_acad)
	WHERE inscription.id_insc = ?");
$params = array($bd_eleve_id);
$ps->execute($params);
$eleves = $ps->fetch();
?>

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
                            <h1>MODIFICATION</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">MODIFICATION</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- start your code hear -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">INFORMATION DE L'ELEVE</h3>
                                </div>
                                <form role="form" method="post" action="update_el.php" enctype="multipart/form-data" id="quickForm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">NOM</label>
                                                <input type="text" class="form-control" name="nom" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo ($eleves['nom']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">PRENOM</label>
                                                <input type="text" class="form-control" name="prenom" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo ($eleves['prenom']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">SEXE</label>
                                                <select class="form-control" name="sexe" required>
                                                    <?php echo '<option value=' . $eleves['sexe'] . '>'  . $eleves['sexe'] . '</option>'; ?>
                                                    <option value="MASCULIN">MASCULIN</option>
                                                    <option value="FEMININ">FEMININ</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">DATE DE NAISSANCE</label>
                                                <div class="input-group " id="reservationdate" data-target-input="nearest">
                                                    <input type="text" class="form-control  datetimepicker-input" data-target="#reservationdate" name="date_naissance" id="datee" value="<?php echo ($eleves['date_naissance']) ?>" onchange="ss()" required />
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">LIEU DE NAISSANCE</label>
                                                <input type="text" class="form-control" name="lieu_naissance" value="<?php echo ($eleves['lieu_naissance']) ?>" onkeyup="this.value=this.value.toUpperCase()">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">RELIGION</label>
                                                <select class="form-control" name="religion" required>
                                                    <?php echo '<option value=' . $eleves['religion'] . '>'  . $eleves['religion'] . '</option>'; ?>
                                                    <option value="CATHOLIQUE">CATHOLIQUE</option>
                                                    <option value="BAPTISTE">BAPTISTE</option>
                                                    <option value="ADVENTISTE">ADVENTISTE</option>
                                                    <option value="PENCOTISTE">PENCOTISTE</option>
                                                    <option value="TEMOINS DE JEHOVAH">TEMOINS DE JEHOVAH</option>
                                                    <option value="AUTRES">AUTRES</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">DERNIER
                                                    ETABLISSEMENT </label>
                                                <input type="text" class="form-control" name="dernier_etab" value="<?php echo ($eleves['dernier_etab']) ?>" onkeyup="this.value=this.value.toUpperCase()">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">DERNIERE CLASSE
                                                    FREQUENTER</label>
                                                <input type="text" class="form-control" name="derniere_classe" value="<?php echo ($eleves['derniere_classe']) ?>" onkeyup="this.value=this.value.toUpperCase()">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">PIECE FOURNIES</label>
                                                <select class="form-control" name="piece_fournies" required>
                                                    <?php echo '<option value=' . $eleves['piece_fournies'] . '>'  . $eleves['piece_fournies'] . '</option>'; ?>
                                                    <option value="CERTIFICAT DE NAISSANCE">CERTIFICAT DE NAISSANCE</option>
                                                    <option value="CERTIFICAT DE BAPTEME">CERTIFICAT DE BAPTEME</option>
                                                    <option value="EXTRAIT D'ARCHIVES">EXTRAIT D'ARCHIVES</option>
                                                    <option value="CARTE IDENTIFICATION">CARTE IDENTIFICATION</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">ADRESSE DE
                                                    L'ENFANT</label>
                                                <input type="text" class="form-control" name="adresse" value="<?php echo ($eleves['adresse']) ?>" onkeyup="this.value=this.value.toUpperCase()">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">PHOTO</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="photos[]" class="custom-file-input" id="exampleInputFile" multiple>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    <img src="../img/<?php echo ($eleves['photo']) ?>" /width="40" height="40">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">INSCRIT EN</label>
                                                <select class="form-control" name="classe_id" onchange="ss()" required>
                                                    <?php echo '<option value=' . $eleves['classe_id'] . '>'  . $eleves['classe_name'] . '</option>'; ?>
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

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel" value="<?php echo ($eleves['tel']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">EMAIL</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="email" value="<?php echo ($eleves['email']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">ANNEE ACADEMIQUE</label>
                                                <select class="form-control" name="id_acad" required>>
                                                    <?php echo '<option value=' . $eleves['id_acad'] . '>'  . $eleves['annee_acad'] . '</option>'; ?>
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
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">NOM COMPLET DU
                                                    PERE</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="nom_comp_p" value="<?php echo ($eleves['nom_comp_p']) ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE 1</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel1_p" value="<?php echo ($eleves['tel1_p']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE 2</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel2_p" value="<?php echo ($eleves['tel2_p']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">EMAIL</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" type="email" name="email_p" value="<?php echo ($eleves['email_p']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">NOM COMPLET DE LA
                                                    MERE</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="nom_comp_m" value="<?php echo ($eleves['nom_comp_m']) ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE 1</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel1_m" value="<?php echo ($eleves['tel1_m']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE 2</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel2_m" value="<?php echo ($eleves['tel2_m']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">EMAIL</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="email_m" value="<?php echo ($eleves['email_m']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">PERSONNE RESPONSABLE</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="nom_comp_pers_resp" value="<?php echo ($eleves['nom_comp_pers_resp']) ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE 1</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel1_pers_resp" value="<?php echo ($eleves['tel1_pers_resp']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE 2</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel2_pers_resp" value="<?php echo ($eleves['tel2_pers_resp']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">EMAIL</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="email_pers_resp" value="<?php echo ($eleves['email_pers_resp']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">
                                                    CONTACTE EN CAS D'URGENCE</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="contact_pers" value="<?php echo ($eleves['contact_pers']) ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">LIEN PARENTAL</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="lien_parental" value="<?php echo ($eleves['lien_parental']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE 1</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel1_con_pers" value="<?php echo ($eleves['tel1_con_pers']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">TELEPHONE 2</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="tel2_con_pers" value="<?php echo ($eleves['tel2_con_pers']) ?>">
                                            </div>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">COUT DE L'INSCRIPTION</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="cout" value="<?php echo ($eleves['cout']) ?>">
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="exampleInputEmail1">STATUS</label>
                                                <select class="form-control" name="status" required>
                                                    <?php echo '<option value=' . $eleves['statut'] . '>'  . $eleves['statut'] . '</option>'; ?>
                                                    <option value="ACTIF">ACTIF</option>
                                                    <option value="INACTIF">INACTIF</option>
                                                </select>
                                            </div>

                                        </div>
                                        <input type="hidden" name="id_insc" value="<?php echo ($eleves['id_insc']) ?>" class="form-control">
                                        <br>
                                        <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                    <!-- /.card-body -->
                                </form>
                            </div>
                            <!-- /.card -->

                            <!--/ end code -->

                        </div>
                    </div>
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
</body>