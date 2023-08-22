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
                            <h1>Gestion des notes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">Gestion des notes</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-2">
                        <!-- Horizontal Form -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Horizontal Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">CLASSE</label>
                                        <select name="classe_id" id="sel_country" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                            <option>-SELECT-</option>

                                            <?php
                                            include('../connexion/conn.php');
                                            ## Fetch countries
                                            $stmt = $bdd->prepare("SELECT * FROM classe ORDER BY classe_name");
                                            $stmt->execute();
                                            $countriesList = $stmt->fetchAll();
                                            foreach ($countriesList as $country) {
                                                echo "<option value='" . $country['classe_id'] . "'>" . $country['classe_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">MATIERE</label>
                                        <select name="id_mat" id="sel_city" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                            <option>-SELECT-</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">FREQUENCE</label>
                                        <select name="id_freq" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                            <option>-SELECT-</option>
                                            <?php
                                            include('../connexion/conn.php');
                                            $result = $bdd->prepare("SELECT * FROM frequence where statut='EN COURS' ");

                                            $result->execute();
                                            for ($i = 0; $row = $result->fetch(); $i++) {

                                                echo '<option value=' . $row['id_freq'] . '>'  . $row['frequence'] . '</option>';
                                            ?>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                  
                                        <!-- select annee academique-->
                                        <div class="form-group">
                                            <label>ANNEE ACADEMIQUE</label>
                                            <?php
                                            $ps_1 = $bdd->prepare("SELECT * FROM annee_acad where statut='EN COURS' ");
                                            $ps_1->execute();
                                            $row_1 = $ps_1->fetch();
                                            ?>
                                            <input name="annee_acad" value="<?php echo ($row_1['annee_acad']) ?>" class="form-control" readonly>
                                            <input type="hidden" value="<?php echo ($row_1['id_acad']) ?>" name="id_acad1">
                                        </div>
                                    
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <center>
                                        <button type="submit" name="rech" class="btn btn-primary">Rechercher</button>
                                        <center>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-9">
                        <div class="card card-primary card-primary">
                            <div class="card-header">
                                <h3 class="card-title">PALMARES</h3>
                            </div>


                            <!-- /.card-header -->
                            <form action="save_note.php" method="post" id="quickForm">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        if (isset($_POST['rech'])) {
                                            extract($_POST);
                                            $classe = $_POST['classe_id'];
                                            $mat = $_POST['id_mat'];
                                            $freq = $_POST['id_freq'];
                                            $id_acad = $_POST['id_acad1'];
                                            require_once("../connexion/conn.php");
                                            $result1 = $bdd->prepare("SELECT id_insc, nom,prenom,classe.classe_id
FROM Classe
INNER JOIN inscription
 ON classe.classe_id = inscription.classe_id
 WHERE classe.classe_id= $classe  and NOT EXISTS
 (SELECT * FROM note
                  INNER JOIN frequence
                   ON frequence.id_freq = note.id_freq
                  INNER JOIN matiere
                   ON matiere.id_matiere =note.id_matiere
                   INNER JOIN annee_acad 
                   ON annee_acad.id_acad=note.id_acad
                  WHERE note.id_matiere = $mat AND  note.id_freq= $freq AND note.id_acad=$id_acad
                    AND note.id_insc = inscription.id_insc)");
                                            $result1->execute();
                                            $data = $result1->fetchAll();
                                        ?>
                                            <div class="col-sm-3">
                                                <!-- input classe-->
                                                <div class="form-group">
                                                    <label>FREQUENCE</label>
                                                    <?php
                                                    include('../connexion/conn.php');
                                                    //  $bd_classe_id = $_GET['bd_classe_id'];
                                                    $ps = $bdd->prepare("SELECT * FROM frequence WHERE id_freq= $freq ");
                                                    $ps->execute();
                                                    $row3 = $ps->fetch();
                                                    ?>
                                                    <input name="fre" value="<?php echo ($row3['frequence'])
                                                                                ?>" class="form-control" readonly>
                                                    <input type="hidden" value="<?php echo ($row3['id_freq'])
                                                                                ?>" name="id_freq">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <!-- input classe-->
                                                <div class="form-group">
                                                    <label>MATIERE</label>
                                                    <?php
                                                    include('../connexion/conn.php');
                                                    //  $bd_classe_id = $_GET['bd_classe_id'];
                                                    $ps = $bdd->prepare("SELECT * FROM matiere WHERE id_matiere=$mat");
                                                    $ps->execute();
                                                    $row3 = $ps->fetch();
                                                    ?>
                                                    <input name="matiere" value="<?php echo ($row3['matiere'] . '/' . $row3['coefficient'])
                                                                                    ?>" class="form-control" readonly>
                                                    <input type="hidden" value="<?php echo ($row3['id_matiere'])
                                                                                ?>" name="id_matiere">
                                                    <input type="hidden" value="<?php echo ($row3['coefficient'])
                                                                                ?>" name="coef">
                                                </div>
                                            </div>


                                            <div class="col-sm-3">
                                                <!-- input classe-->
                                                <div class="form-group">
                                                    <label>CLASSE</label>
                                                    <?php
                                                    include('../connexion/conn.php');
                                                    //  $bd_classe_id = $_GET['bd_classe_id'];
                                                    $ps = $bdd->prepare("SELECT * FROM classe WHERE classe_id=$classe");
                                                    $ps->execute();
                                                    $row3 = $ps->fetch();
                                                    ?>
                                                    <input name="classe_name" value="<?php echo ($row3['classe_name'])
                                                                                        ?>" class="form-control" readonly>
                                                    <input type="hidden" value="<?php echo ($row3['classe_id'])
                                                                                ?>" name="classe_id">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <!-- select annee academique-->
                                                <div class="form-group">
                                                    <label>ANNEE ACADEMIQUE</label>
                                                    <?php
                                                    $ps_1 = $bdd->prepare("SELECT * FROM annee_acad where id_acad=$id_acad");
                                                    $ps_1->execute();
                                                    $row_1 = $ps_1->fetch();
                                                    ?>
                                                    <input name="annee_acad" value="<?php echo ($row_1['annee_acad']) ?>" class="form-control" readonly>
                                                    <input type="hidden" value="<?php echo ($row_1['id_acad']) ?>" name="id_acad">
                                                </div>
                                            </div>

                                    </div>
                                    <?php
                                            foreach ($data as $row4) {
                                    ?>
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo ($row4['nom'] . ' ' . $row4['prenom'])
                                                                                                            ?></label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" value="<?php echo ($row4['id_insc'])
                                                                                ?>" name="id_insc[]" class="form-control">

                                                </div>

                                                <div class="col-sm-5">
                                                    <input name="note[]" class="form-control" id="note[]" onchange="ss()">
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                            }
                                    ?>



                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                <?php

                                        }
                                ?>
                                </div>

                            </form>

                            <!-- /.card-body -->
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <?php
        require_once("../footer.php");
        ?>
    </div>
    <?php
    require_once("../js/js.php");
    ?>



    <!-- Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            // State
            $('#sel_country').change(function() {
                var countryid = $(this).val();

                // Empty city dropdown
                $('#sel_state').find('option').not(':first').remove();
                $('#sel_city').find('option').not(':first').remove();
                // AJAX request
                $.ajax({
                    url: 'load_matiere.php',
                    type: 'post',
                    data: {
                        request: 1,
                        countryid: countryid
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = response.length;
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id'];
                            var cityname = response[i]['cityname'];

                            $("#sel_city").append("<option value='" + id + "'>" + cityname + "</option>");
                        }
                    }
                });
            });

        });
    </script>
</body>