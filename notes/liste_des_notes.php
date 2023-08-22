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
                            <h1>GESTION DES NOTES</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">DataTables</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <?php
            include('../connexion/conn.php');
            ## Fetch countries
            $stmt = $bdd->prepare("SELECT * FROM classe ORDER BY classe_name");
            $stmt->execute();
            $countriesList = $stmt->fetchAll();
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">LISTE DES CLASSES</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <?php
                                foreach ($countriesList as $country) {
                                    $nbr_insc = $country['classe_id'];


                                    $result = $bdd->prepare("SELECT COUNT(id_insc) AS nbr FROM inscription where classe_id=$nbr_insc");
                                    $result->execute();
                                    $row = $result->fetch();
                                    $a = $row['nbr'];
                                ?>
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item active">
                                            <a href="liste_des_notes.php?bd_classe_id=<?php echo ($country['classe_id']) ?>" class="nav-link">
                                                <i class="fas fa-inbox"></i> <?php echo $country['classe_name']; ?>
                                                <span class="badge bg-primary float-right"><?php echo $a ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                <?php
                                }
                                ?>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">LISTE DES ELEVES</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>CODE ELEVES</th>
                                            <th>NOM</th>
                                            <th>PRENOM</th>
                                            <th>CLASSES</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($_GET['bd_classe_id'])) {
                                        extract($_GET);
                                        $id_classe = $_GET['bd_classe_id'];

                                    ?>
                                        <tbody>
                                            <?php
                                            include('../connexion/conn.php');
                                            $result2 = $bdd->prepare("SELECT inscription.id_insc, inscription.code_eleve, inscription.nom, inscription.prenom, inscription.sexe, inscription.date_naissance, inscription.tel,inscription.statut, inscription.lieu_naissance, inscription.adresse,  inscription.email, inscription.dernier_etab, inscription.religion,
                           inscription.derniere_classe, inscription.piece_fournies,inscription.classe_id, inscription.id_acad,inscription.photo,inscription.date_insc,classe.classe_name,annee_acad.annee_acad
                  FROM ((inscription
                  INNER JOIN classe ON inscription.classe_id = classe.classe_id)
                INNER JOIN annee_acad ON inscription.id_acad = annee_acad.id_acad) WHERE classe.classe_id =? ORDER BY inscription.nom ASC");
                                            $params_1 = array($id_classe);
                                            $result2->execute($params_1);
                                            //OUVERTURE DE LA BOUCLE
                                            while ($row1 = $result2->fetch()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row1['code_eleve']; ?></td>
                                                    <td><?php echo $row1['nom']; ?></td>
                                                    <td><?php echo $row1['prenom']; ?></td>
                                                    <td><?php echo $row1['classe_name']; ?></td>
                                                    <td><a href="list_n.php?eleve_id=<?php echo ($row1['id_insc']) ?>" class="btn btn-xs btn-primary" title="">LISTER</a></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
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
    </div>

</body>

</html>