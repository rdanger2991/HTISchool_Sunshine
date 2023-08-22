<?php require_once("../header/header.php"); ?>

<?php
include('../connexion/conn.php');
$tab[] = null;
$rec = 0;
//lister matiere par classe
$bd_classe_id_mat = $_GET['bd_classe_id'];
$result_mat = $bdd->prepare("SELECT  matiere.classe_id, matiere.id_matiere, matiere.matiere, matiere.coefficient
                                             FROM (matiere
                                             INNER JOIN classe ON matiere.classe_id = classe.classe_id)  WHERE classe.classe_id =?");
$params_mat = array($bd_classe_id_mat);
$result_mat->execute($params_mat);
while ($row_mat = $result_mat->fetch()) {
    $tab[$rec++] = $row_mat['id_matiere'];
}

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
                    <div class="col-md-3">


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste des classes</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <?php
                                    include('../connexion/conn.php');
                                    $result = $bdd->prepare("SELECT * FROM classe ORDER BY classe_name ASC");
                                    $result->execute();
                                    //OUVERTURE DE LA BOUCLE FOR
                                    for ($i = 0; $row = $result->fetch(); $i++) {
                                    ?>
                                        <li class="nav-item active">
                                            <a href="recupere_note_info.php?bd_classe_id=<?php echo ($row['classe_id']) ?>" class="nav-link">
                                                <i class="fas fa-inbox"></i> <?php echo $row['classe_name']; ?>

                                            </a>
                                        </li>
                                        <!-- FERMETURE DE LA BOUCLE FOR -->
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="card card-default">

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> CODE ELEVE </th>
                                            <th> NOM COMPLET </th>
                                            <th colspan="20" class="text-center table-active">MATIERE</th>
                                        </tr>

                                        <tr>
                                            <th> </th>
                                            <th> </th>
                                            <?php
                                            include('../connexion/conn.php');
                                            //$tab[] = null;
                                            //$rec = 0;
                                            //lister matiere par classe
                                            $bd_classe_id_1 = $_GET['bd_classe_id'];
                                            $result_1 = $bdd->prepare("SELECT  matiere.classe_id, matiere.id_matiere, matiere.matiere, matiere.coefficient
                                             FROM (matiere
                                             INNER JOIN classe ON matiere.classe_id = classe.classe_id)  WHERE classe.classe_id =?");
                                            $params_1 = array($bd_classe_id_1);
                                            $result_1->execute($params_1);
                                            $data_1 = $result_1->fetchAll();
                                            //OUVERTURE DE LA BOUCLE FOR
                                            foreach ($data_1 as $row_4) {


                                            ?>
                                                <th><?php echo $row_4['matiere'] . '/' . $row_4['coefficient']; ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once("../connexion/conn.php");
                                        $bd_classe_id1 = $_GET['bd_classe_id'];
                                        $result1 = $bdd->prepare("SELECT inscription.id_insc, inscription.code_eleve, inscription.nom, inscription.prenom, inscription.classe_id, classe.classe_id
                                        FROM (inscription
                                        INNER JOIN classe ON inscription.classe_id = classe.classe_id) WHERE classe.classe_id =?");
                                        $params1 = array($bd_classe_id1);
                                        $result1->execute($params1);
                                        $data = $result1->fetchAll();
                                        foreach ($data as $row4) {
                                        ?>
                                            <tr>
                                                <td><?php echo ($row4['code_eleve']) ?> </td>
                                                <td><?php echo ($row4['nom'] . ' ' . $row4['prenom']) ?> </td>

                                                <?php
                                                for ($j = 0; $j < $rec; $j++) {
                                                ?>
                                                    <td>
                                                        <?php
                                                        $notes_list = $bdd->prepare("SELECT * from note where   id_insc= " . $row4['id_insc'] . "  AND id_matiere= " . $tab[$j] . " ");
                                                        $notes_list->execute();

                                                        if ($resul_list = $notes_list->fetch()) {

                                                            echo $resul_list['note'];
                                                        }
                                                        ?>


                                                    </td>

                                                <?php }  ?>
                                                
                                            </tr>
                                        <?php }  ?>
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
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
    require_once("../js/js_data.php");
    ?>
</body>