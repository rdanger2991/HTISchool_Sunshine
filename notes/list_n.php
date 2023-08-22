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
            <?php
            include('../connexion/conn.php');
            $result = $bdd->prepare("SELECT * FROM frequence where statut='EN COURS' ");
            $result->execute();
            $row_1 = $result->fetch();
            $id_freq = $row_1['id_freq'];
            $freq = $row_1['frequence'];

            $ps_1 = $bdd->prepare("SELECT * FROM annee_acad where statut='EN COURS' ");
            $ps_1->execute();
            $row_1 = $ps_1->fetch();
            $id_acad = $row_1['id_acad'];
            $acad = $row_1['annee_acad'];
            ?>

            <?php
            $id_eleve = $_GET['eleve_id'];
            require_once("../connexion/conn.php");
            $result_3 = $bdd->prepare("SELECT inscription.id_insc, inscription.nom,inscription.prenom,inscription.code_eleve,
            classe.classe_id,classe.classe_name
FROM inscription
INNER JOIN classe
 on inscription.classe_id=classe.classe_id
 WHERE inscription.id_insc=  $id_eleve");
            $result_3->execute();
            $data = $result_3->fetch();
            $id_cl = $data['classe_id'];
            ?>
            <!-- Main content -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <h3><?php echo ($data['nom'] . '  ' . $data['prenom'] . '  (' . $data['code_eleve'] . ')');
                            ?></h3>
                        <h4><?php echo ($data['classe_name'] . '  ' . $freq . ' -' . '  (' . $acad . ')');
                            ?></h4>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>CODE MATIERE</th>
                                    <th>MATIERES</th>
                                    <th>COEFFICIENT</th>
                                    <th>NOTES</th>
                                    <th>OBSERVATIONS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                $id_eleve = $_GET['eleve_id'];
                                require_once("../connexion/conn.php");
                                $result1 = $bdd->prepare("SELECT inscription.id_insc, inscription.nom,inscription.prenom,inscription.code_eleve,
            classe.classe_id,classe.classe_name,matiere.id_matiere,matiere.matiere,
    matiere.code_matiere,matiere.coefficient,note.note
FROM note
INNER JOIN inscription
 ON note.id_insc = inscription.id_insc
 inner join matiere
 on note.id_matiere=matiere.id_matiere
 inner join classe
 on note.classe_id=classe.classe_id
 WHERE inscription.id_insc=  $id_eleve and note.id_acad=  $id_acad and note.id_freq=$id_freq ");
                                $result1->execute();
                                while ($row = $result1->fetch()) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['code_matiere']; ?></td>
                                        <td><?php echo $row['matiere']; ?></td>
                                        <td><?php echo $row['coefficient']; ?></td>
                                        <td><?php echo $row['note']; ?></td>
                                        <td><?php echo $row['code_matiere']; ?></td>
                                        <td>bbbb</td>
                                    </tr>
                                <?php
                                }

                                $result_mat = $bdd->prepare("SELECT COUNT(id_matiere) AS nbr_mat, SUM(coefficient) as sum_coef FROM matiere 
                                where classe_id=$id_cl");
                                $result_mat->execute();
                                $row_mat = $result_mat->fetch();
                                $a_mat = $row_mat['nbr_mat'];
                                $sum_coef= $row_mat['sum_coef'];

                                $result_note = $bdd->prepare("SELECT COUNT(id_matiere) AS nbr_mat_note, SUM(note) as sum_note FROM note 
                                where classe_id=$id_cl and id_insc=$id_eleve and id_freq=$id_freq and id_acad=$id_acad");
                                $result_note->execute();
                                $row_note = $result_note->fetch();
                                $a_note = $row_note['nbr_mat_note'];
                                $sum_note=$row_note['sum_note'];


                                if ($a_note < $a_mat) {
                                    $sum_notes = "";
                                    $sum_cofs="";
                                    $moy="";

echo            '<div class="col-md-9">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">IMPORTANT</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               IL A DES NOTES MANQUANTES POUR CET ELEVE CLIQUEZ POUR LES ENREGISTRES
              </div>
              <!-- /.card-body -->
               <div class="card-footer">
                      <button type="submit" class="btn btn-warning">OK</button>
              </div>
            </div>
            <!-- /.card -->
          </div>';
                                } else {
                                    $sum_notes = $sum_note;
                                    $sum_cofs = $sum_coef;
                                    $moy= $sum_notes*10/$sum_cofs;
                                }
                                ?>

                                
                                <tr>
                                    <th colspan="2"><strong style="font-size: 18px; color: #222222;">TOTAL:</strong></th>
                                    <td colspan="1"><strong style="font-size: 18px; color: #222222;"><?php echo $sum_cofs; ?></strong></td>
                                    <td colspan="1"><strong style="font-size: 18px; color: #222222;"><?php echo $sum_notes; ?></strong></td>
                                </tr>
                                <tr>
                                    <th colspan="2"><strong style="font-size: 18px; color: #222222;">MOYENNE:</strong></th>
                                    <td colspan="1"><strong style="font-size: 18px; color: #222222;"><?php echo $moy; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>

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
</body>