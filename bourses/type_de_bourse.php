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
                            <h1>Gestion des types de bourses</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">Gestion des types de bourses</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        ADD CLASSES
                    </button><br><br>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des types</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>TYPE DE BOURSE</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('../connexion/conn.php');
                                            $result = $bdd->prepare("SELECT * FROM bourse_type ORDER BY id_type_bourse ASC");
                                            $result->execute();
                                            //OUVERTURE DE LA BOUCLE FOR
                                            for ($i = 0; $row = $result->fetch(); $i++) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['type_bourse']; ?></td>
                                                    <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $row['id_type_bourse']; ?>">Modifier</button></td>


                                                </tr>
                                                <!-- modal edit-->
                                                <div class="modal fade" id="modalEdit<?php echo $row['id_type_bourse']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #0078d7; border-radius:5px 5px 0 0;">
                                                                <h4 class="title-conditionned" style="display: inline;">Modifier CLASSE</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form action="Save_edit_type_bourse.php" method="post">

                                                                <div class="modal-body">

                                                                    <div class="form-group">
                                                                        <label for="name">TYPE DE BOURSE</label>
                                                                        <input type="text" class="form-control" name="type_bourse" value="<?php echo $row['type_bourse']; ?>">
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="id_type_bourse" value="<?php echo $row['id_type_bourse']; ?>" />
                                                                    <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-xs btn-primary" name="update_typ_b">Save</button>
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
                                        <tfoot>
                                            <tr>
                                                <th>TYPE DE BOURSE</th>
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

                        <h4 class="title-conditionned" style="display: inline;">TYPE DE BOURSE</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="form-group">
                        <form name="add_name" id="add_name">
                            <table class="table table-bordered table-hover" id="dynamic_field">
                                <tr>
                                    <td><input type="text" name="type_bourse[]" onkeyup="this.value=this.value.toUpperCase()" placeholder="ENTER" class="form-control name_email" /></td>
                                    <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>
                                </tr>
                            </table>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-xs btn-primary" name="submit" id="submit">Save</button>
                            </div>
                        </form>
                    </div>
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
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="type_bourse[]" onkeyup="this.value=this.value.toUpperCase()" placeholder="ENTER"  class="form-control name_list"/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

            $("#submit").on('click', function() {
                var formdata = $("#add_name").serialize();
                $.ajax({
                    url: "save_type_bourse.php",
                    type: "POST",
                    data: formdata,
                    cache: false,
                    success: function(result) {
                        $("#add_name")[0].reset();
                    }
                });
            });
        });
    </script>
</body>

</html>