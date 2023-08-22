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
                            <h1>Gestion des modalités de paiement</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">Gestion des modalités de paiement</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        ADD MODALITE
                    </button><br><br>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des modalités</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form name="add_name" method="post" id="add_name">
                                        <div class="row">
                                            <!-- /.col -->
                                            <div class="col-sm-3">
                                                <!-- select -->
                                                <div class="form-group">
                                                    <label>CLASSE</label>
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
                                                <button type="submit" class="btn btn-primary" name="rech">Primary</button>
                                            </div>
                                        </div>

                                    </form>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>CATEGORIE</th>
                                                <th>MODALITE</th>
                                                <th>COUT MODALITE</th>
                                                <th>CLASSE</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if (isset($_POST['rech'])) {
                                            extract($_POST);
                                            $classe = $_POST['classe_id'];
                                        ?>
                                            <tbody>
                                                <?php
                                                include('../connexion/conn.php');
                                                $result2 = $bdd->prepare("SELECT paiement_add_modalite.id_mod_paie, 
                                            paiement_modalite_type.categorie_type,
                                            paiement_add_modalite.cout,
                                            paiement_add_modalite.classe_id,
                                            paiement_add_modalite.modalite,
                                            classe.classe_name,
                                            classe.classe_id,
                                             paiement_add_modalite.id_type_paiement, 
                                             paiement_modalite_type.id_type_paiement
                                              FROM ((paiement_add_modalite 
                                              INNER JOIN paiement_modalite_type ON paiement_add_modalite.id_type_paiement = paiement_modalite_type.id_type_paiement)
                                              INNER JOIN classe ON paiement_add_modalite.classe_id=classe.classe_id) WHERE classe.classe_id =?");
                                                $params_1 = array($classe);
                                                $result2->execute($params_1);
                                                //OUVERTURE DE LA BOUCLE FOR
                                                while ($row = $result2->fetch()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['categorie_type']; ?></td>
                                                        <td><?php echo $row['modalite']; ?></td>
                                                        <td><?php echo $row['cout']; ?></td>
                                                        <td><?php echo $row['classe_name']; ?></td>
                                                        <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $row['id_mod_paie']; ?>">Modifier</button></td>


                                                    </tr>
                                                    <!-- modal edit-->
                                                    <div class="modal fade" id="modalEdit<?php echo $row['id_mod_paie']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #0078d7; border-radius:5px 5px 0 0;">
                                                                    <h4 class="title-conditionned" style="display: inline;">Modifier categorie</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <form action="Save_edit_add_modalite.php" method="post">

                                                                    <div class="modal-body">

                                                                        <!-- SELECT CATEGORIE-->
                                                                        <div class="form-group">
                                                                            <label>CATEGORIE</label>
                                                                            <select class="form-control" name="categorie_type" id="category_classe">
                                                                                <?php echo '<option value=' . $row['id_type_paiement'] . '>'  . $row['categorie_type'] . '</option>'; ?>
                                                                                <?php
                                                                                include('../connexion/conn.php');
                                                                                $result = $bdd->prepare("SELECT * FROM paiement_modalite_type ORDER BY categorie_type ASC");

                                                                                $result->execute();
                                                                                for ($i = 0; $row1 = $result->fetch(); $i++) {

                                                                                    echo '<option value=' . $row1['id_type_paiement'] . '>'  . $row1['categorie_type'] . '</option>';
                                                                                ?>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">MODALITE</label>
                                                                            <input type="text" class="form-control" name="modalite" value="<?php echo $row['modalite']; ?>">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">COUT</label>
                                                                            <input type="text" class="form-control" name="cout" value="<?php echo $row['cout']; ?>">
                                                                        </div>

                                                                        <!--/ SELECT CLASSE -->
                                                                        <div class="form-group">
                                                                            <label>CLASSE</label>
                                                                            <select class="form-control" name="classe" id="category_classe">
                                                                                <?php echo '<option value=' . $row['classe_id'] . '>'  . $row['classe_name'] . '</option>'; ?>
                                                                                <?php
                                                                                include('../connexion/conn.php');
                                                                                $result = $bdd->prepare("SELECT * FROM classe ORDER BY classe_name ASC");

                                                                                $result->execute();
                                                                                for ($i = 0; $row2 = $result->fetch(); $i++) {

                                                                                    echo '<option value=' . $row2['classe_id'] . '>'  . $row2['classe_name'] . '</option>';
                                                                                ?>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <!--/FIN SELECT CLASSE -->



                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id_mod_paie" value="<?php echo $row['id_mod_paie']; ?>" />
                                                                        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-xs btn-primary" name="update_typ_p">Save</button>
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
                                                <th>CATEGORIE</th>
                                                <th>MODALITE</th>
                                                <th>COUT MODALITE</th>
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

                        <h4 class="title-conditionned" style="display: inline;">Add MODALITE</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <form action="save_modalite.php" method="post">

                        <div class="modal-body">
                            <!-- SELECT CATEGORIE-->
                            <div class="form-group">
                                <label>CATEGORIE</label>
                                <select class="form-control" name="categorie_type" id="category_classe">
                                    <option>-Select-</option>
                                    <?php
                                    include('../connexion/conn.php');
                                    $result = $bdd->prepare("SELECT * FROM paiement_modalite_type ORDER BY categorie_type ASC");

                                    $result->execute();
                                    for ($i = 0; $row2 = $result->fetch(); $i++) {

                                        echo '<option value=' . $row2['id_type_paiement'] . '>'  . $row2['categorie_type'] . '</option>';
                                    ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <!--/FIN SELECT CATEGORIE -->


                            <div class="form-group">
                                <label for="name">MODALITE</label>
                                <input type="text" class="form-control" name="modalite" placeholder="Enter ">
                            </div>

                            <div class="form-group">
                                <label for="name">COUT</label>
                                <input type="text" class="form-control" name="cout" placeholder="Enter ">
                            </div>

                            <!--/ SELECT CLASSE -->
                            <div class="form-group">
                                <label>CLASSE</label>
                                <select class="form-control" name="classe" id="category_classe">
                                    <option>-Select-</option>
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
                            <!--/FIN SELECT CLASSE -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-xs btn-primary" name="save">Save</button>
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

    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;

            $("#add").click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="categorie_type[]" onkeyup="this.value=this.value.toUpperCase()" placeholder="ENTER"  class="form-control name_list"/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

            $("#submit").on('click', function() {
                var formdata = $("#add_name").serialize();
                $.ajax({
                    url: "save_type_paiement.php",
                    type: "POST",
                    data: formdata,
                    cache: false,
                    success: function(result) {
                        alert(result);
                        $("#add_name")[0].reset();
                    }
                });
            });
        });
    </script>
</body>

</html>