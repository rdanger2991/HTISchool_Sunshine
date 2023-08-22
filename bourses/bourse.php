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
                            <h1>Gestion des bourses</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">Gestion des bourses</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        ADD
                    </button><br><br>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des bourse</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <form name="add_name" method="post" id="add_name">
                                        <div class="row">
                                            <!-- /.col -->
                                            <div class="col-sm-3">
                                                <!-- select -->
                                                <div class="form-group">
                                                    <label>RECHERCHE PAR CLASSE</label>
                                                    <select class="form-control" name="classe_id" required>
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
                                            <div class="col-sm-1">
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="rech">Recherche</button>
                                            </div>
                                        </div>

                                    </form>

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>CODE</th>
                                                <th>TYPE DE BOURSE</th>
                                                <th>MODALITE</th>
                                                <th>COUT MODALITE</th>
                                                <th>REDUCTION</th>
                                                <th>ELEVES</th>
                                                <th>CLASSE</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if (isset($_POST['rech'])) {
                                            extract($_POST);
                                            $classe1 = $_POST['classe_id'];
                                        ?>
                                            <tbody>
                                                <?php
                                                include('../connexion/conn.php');
                                                $result2 = $bdd->prepare("SELECT bourse_type.id_type_bourse,inscription.id_insc, paiement_add_modalite.id_mod_paie,
                                                 bourse.id_bourse, bourse.code_bourse, bourse_type.type_bourse, paiement_add_modalite.modalite,
                                            paiement_add_modalite.cout, bourse.reduction, inscription.nom,inscription.prenom, classe.classe_id,classe.classe_name
                                            from ((bourse
                                            inner join bourse_type on bourse.id_type_bourse=bourse_type.id_type_bourse
                                            inner join paiement_add_modalite on bourse.id_mod_paie= paiement_add_modalite.id_mod_paie
                                            inner join  inscription on bourse.id_ins=inscription.id_insc)  
                                            INNER JOIN classe ON bourse.classe_id = classe.classe_id)
                                            WHERE classe.classe_id = ? ");
                                                $params_1 = array($classe1);
                                                $result2->execute($params_1);
                                                //OUVERTURE DE LA BOUCLE FOR
                                                while ($row1 = $result2->fetch()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row1['code_bourse']; ?></td>
                                                        <td><?php echo $row1['type_bourse']; ?></td>
                                                        <td><?php echo $row1['modalite']; ?></td>
                                                        <td><?php echo $row1['cout']; ?></td>
                                                        <td><?php echo $row1['reduction']; ?></td>
                                                        <td><?php echo $row1['nom'] . ' ' . $row1['prenom']; ?></td>
                                                        <td><?php echo $row1['classe_name']; ?></td>
                                                        <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $row1['id_bourse']; ?>">Modifier</button></td>


                                                    </tr>
                                                    <!-- modal edit-->
                                                    <div class="modal fade" id="modalEdit<?php echo $row1['id_bourse']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #0078d7; border-radius:5px 5px 0 0;">
                                                                    <h4 class="title-conditionned" style="display: inline;">Modifier CLASSE</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <form action="save_edit_bourse.php" method="post">

                                                                    <div class="modal-body">

                                                                        <div class="form-group">
                                                                            <label for="name">CODE</label>
                                                                            <input type="text" class="form-control" name="code_bourse" value="<?php echo $row1['code_bourse']; ?>" readonly>
                                                                        </div>

                                                                        <!-- edit type_bourse-->
                                                                        <div class="form-group">
                                                                            <label>TYPE DE BOURSE </label>
                                                                            <select class="form-control" name="cate_bourse" id="">
                                                                                <?php echo '<option value=' . $row1['id_type_bourse'] . '>'  . $row1['type_bourse'] . '</option>'; ?>
                                                                                <?php
                                                                                // include('../connexion/conn.php');
                                                                                $result = $bdd->prepare("SELECT * FROM bourse_type ORDER BY type_bourse ASC");

                                                                                $result->execute();
                                                                                for ($i = 0; $row = $result->fetch(); $i++) {

                                                                                    echo '<option value=' . $row['id_type_bourse'] . '>'  . $row['type_bourse'] . '</option>';
                                                                                ?>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <!-- /edit type_bourse-->

                                                                        <div class="form-group">
                                                                            <label for="qualification">CLASSE</label>
                                                                            <select name="classe_id" id="sel_country" class="form-control input-sm" placeholder="Qualification" required="">
                                                                                <?php echo '<option value=' . $row1['classe_id'] . '>'  . $row1['classe_name'] . '</option>'; ?>
                                                                                <?php
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
                                                                            <label for="name">ELEVES</label>
                                                                            <select name="id_insc" id="sel_city" class="form-control input-sm">
                                                                                <?php echo '<option value=' . $row1['id_insc'] . '>'  . $row1['nom'] . ' ' . $row1['prenom'] . '</option>'; ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">MODALITE</label>
                                                                            <select name="id_mod_paie" id="sel_state" class="form-control input-sm">
                                                                                <?php echo '<option value=' . $row1['id_mod_paie'] . '>'  . $row1['modalite'] . '</option>'; ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group input-lg">
                                                                            <label for="name">COUT</label>
                                                                            <input type="text" class="form-control" name="cout" id="coutModalite" value="<?php echo $row1['cout']; ?>" readonly>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="col-form-label">POURCENTAGE
                                                                                DE REDUCTION</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" onkeyup="myFunction(this.value);" id="pourcentage">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i>%</i></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group ">
                                                                            <label for="name">REDUCTION</label>
                                                                            <input type="text" class="form-control" name="cout_bourse" id="bourse" value="<?php echo $row1['reduction']; ?>" readonly>
                                                                        </div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id_bourse" value="<?php echo $row1['id_bourse']; ?>" />
                                                                        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-xs btn-primary" name="update_b">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- modal -->

                                                    <!-- FERMETURE DE LA BOUCLE FOR -->
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        <?php
                                        }
                                        ?>
                                        <tfoot>
                                            <tr>
                                                <th>CODE</th>
                                                <th>TYPE DE BOURSE</th>
                                                <th>MODALITE</th>
                                                <th>COUT MODALITE</th>
                                                <th>REDUCTION</th>
                                                <th>ELEVES</th>
                                                <th>CLASSE</th>
                                                <th> Action </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <!-- Modal Save-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="title-conditionned" style="display: inline;">Add bourse</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <form action="action_bourse.php" method="post">

                        <div class="modal-body" id="dynamicApp">
                            <!-- SELECT CATEGORIE-->
                            <div class="form-group">
                                <label>TYPE DE BOURSE</label>
                                <select class="form-control" name="cate_bourse" id="">
                                    <option>-Select-</option>
                                    <?php
                                    // include('../connexion/conn.php');
                                    $result = $bdd->prepare("SELECT * FROM bourse_type ORDER BY type_bourse ASC");

                                    $result->execute();
                                    for ($i = 0; $row = $result->fetch(); $i++) {

                                        echo '<option value=' . $row['id_type_bourse'] . '>'  . $row['type_bourse'] . '</option>';
                                    ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="qualification">CLASSE</label>
                                <select name="classe_id" id="sel_country" class="form-control input-sm" placeholder="Qualification" required="">
                                    <option value='0'>Select Classe</option>
                                    <?php
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
                                <label for="name">ELEVES</label>
                                <select name="id_insc" id="sel_city" class="form-control input-sm">
                                    <option value='0'>Select Eleve</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">MODALITE</label>
                                <select name="id_mod_paie" id="sel_state" class="form-control input-sm">
                                    <option value='0'>Select Modalite</option>
                                </select>
                            </div>

                            <div class="form-group input-lg">
                                <label for="name">COUT</label>
                                <input type="text" class="form-control" name="cout" id="coutModalite" readonly>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">POURCENTAGE
                                    DE REDUCTION</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" onkeyup="myFunction(this.value);" id="pourcentage">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i>%</i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="name">REDUCTION</label>
                                <input type="text" class="form-control" name="cout_bourse" id="bourse" readonly>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-xs btn-primary" name="save">Save</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal -->
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
            // Country
            $('#sel_country').change(function() {
                var countryid = $(this).val();

                // Empty state and city dropdown
                $('#sel_state').find('option').not(':first').remove();
                $('#sel_city').find('option').not(':first').remove();
                // AJAX request
                $.ajax({
                    url: 'action_bourse.php',
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
                            var name = response[i]['stateame'];

                            $("#sel_state").append("<option value='" + id + "'>" + name + "</option>");
                        }
                    }
                });

            });
            // State
            $('#sel_country').change(function() {
                var countryid1 = $(this).val();

                // Empty city dropdown
                //  $('#sel_city').find('option').not(':first').remove();
                // AJAX request
                $.ajax({
                    url: 'action_bourse.php',
                    type: 'post',
                    data: {
                        request: 2,
                        countryid1: countryid1
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


            // State
            $('#sel_state').change(function() {
                var stateid = $(this).val();

                // Empty city dropdown
                // $('#sel_city').find('option').not(':first').remove();
                // AJAX request
                $.ajax({
                    url: 'action_bourse.php',
                    type: 'post',
                    data: {
                        request: 3,
                        stateid: stateid
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = response.length;
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id'];


                            $("#coutModalite").val(id);
                        }
                    }
                });
            });

        });


        function myFunction(value) {
            var res;
            var pourcentage = value / 100;
            var coutMod = document.getElementById('coutModalite').value
            res = coutMod * pourcentage;
            document.getElementById('bourse').value = res;
        }
    </script>
</body>

</html>