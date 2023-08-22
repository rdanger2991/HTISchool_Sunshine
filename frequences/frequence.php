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
                            <h1>Gestion des classes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">Gestion des classes</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        NEW
                    </button><br><br>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des clasees</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th> CATEGORIE </th>
                                                <th>FREQUENCE</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('../connexion/conn.php');
                                            $result = $bdd->prepare("SELECT frequence.id_freq,frequence.frequence, frequence.id_cat_freq, cat_freq.cat_freq
                                            FROM (frequence INNER JOIN cat_freq ON frequence.id_cat_freq=cat_freq.id_cat_freq)");
                                            $result->execute();
                                            //OUVERTURE DE LA BOUCLE FOR
                                            for ($i = 0; $row = $result->fetch(); $i++) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['cat_freq']; ?></td>
                                                    <td><?php echo $row['frequence']; ?></td>
                                                    <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $row['id_freq']; ?>">Modifier</button></td>


                                                </tr>
                                                <!-- modal edit-->
                                                <div class="modal fade" id="modalEdit<?php echo $row['id_freq']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #0078d7; border-radius:5px 5px 0 0;">
                                                                <h4 class="title-conditionned" style="display: inline;">Modifier CLASSE</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form action="save_edit_freq.php" method="post">

                                                                <div class="modal-body">

                                                                    <!-- edit cate-->
                                                                    <div class="form-group">
                                                                        <label>CATEGORIE FREQUENCE </label>
                                                                        <select class="form-control" name="id_cat_freq" id="category_classe">
                                                                            <?php echo '<option value=' . $row['id_cat_freq'] . '>'  . $row['cat_freq'] . '</option>'; ?>
                                                                            <?php
                                                                            include('../connexion/conn.php');
                                                                            $result2 = $bdd->prepare("SELECT * FROM cat_freq");

                                                                            $result2->execute();
                                                                            for ($i = 0; $row2 = $result2->fetch(); $i++) {

                                                                                echo '<option value=' . $row2['id_cat_freq'] . '>'  . $row2['cat_freq'] . '</option>';
                                                                            ?>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="name">FREQUENCE</label>
                                                                        <input type="text" class="form-control" name="frequence" value="<?php echo $row['frequence']; ?>">
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="id_freq" value="<?php echo $row['id_freq']; ?>" />
                                                                    <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-xs btn-primary" name="updateClasse">Save</button>
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
                                                <th> CATEGORIE </th>
                                                <th>FREQUENCE</th>
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

                        <h4 class="title-conditionned" style="display: inline;">Add frequence</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <form action="save_freq.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>CATEGORIE FREQUENCE </label>
                                <select class="form-control" name="id_cat_freq" id="category_classe">
                                    <?php
                                    include('../connexion/conn.php');
                                    $result2 = $bdd->prepare("SELECT * FROM cat_freq ORDER BY cat_freq ASC");

                                    $result2->execute();
                                    for ($i = 0; $row2 = $result2->fetch(); $i++) {

                                        echo '<option value=' . $row2['id_cat_freq'] . '>'  . $row2['cat_freq'] . '</option>';
                                    ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="name">FREQUENCE</label>
                                <input type="text" class="form-control" name="frequence" placeholder="Enter ">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-xs btn-primary">Save</button>
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
</body>

</html>