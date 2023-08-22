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
          <div class="col-md-1">
            <a href="new_inscription.php" class="btn btn-primary btn-block mb-3">ADD</a>
          </div>


          <div class="row">
            <div class="col-12">

              <!-- start your code hear -->


              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Liste des elèves</h3>
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
                  <!-- /.card-body -->

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>CODE ELEVES</th>
                        <th>PHOTOS</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>SEXE</th>
                        <th>CLASSE</th>
                        <th>ANNEE ACA.</th>
                        <th>STATUT</th>
                        <th>DATE INSCRIP.</th>
                        <th>ACTION</th>
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
                        $result2 = $bdd->prepare("SELECT inscription.id_insc, inscription.code_eleve, inscription.nom, inscription.prenom, inscription.sexe, inscription.date_naissance, inscription.tel,inscription.statut, inscription.lieu_naissance, inscription.adresse,  inscription.email, inscription.dernier_etab, inscription.religion,
                           inscription.derniere_classe, inscription.piece_fournies,inscription.classe_id, inscription.id_acad,inscription.photo,inscription.date_insc,classe.classe_name,annee_acad.annee_acad
                  FROM ((inscription
                  INNER JOIN classe ON inscription.classe_id = classe.classe_id)
                INNER JOIN annee_acad ON inscription.id_acad = annee_acad.id_acad) WHERE classe.classe_id =?");
                        $params_1 = array($classe);
                        $result2->execute($params_1);
                        //OUVERTURE DE LA BOUCLE FOR
                        while ($row = $result2->fetch()) {
                        ?>
                          <tr>
                            <td><?php echo $row['code_eleve']; ?></td>
                            <td>
                              <img src="../img/<?php echo ($row['photo']) ?>" class="img-circle" width="60" height="60">
                            </td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['prenom']; ?></td>
                            <td><?php echo $row['sexe']; ?></td>
                            <td><?php echo $row['classe_name']; ?></td>
                            <td><?php echo $row['annee_acad']; ?></td>
                            <td><?php echo $row['statut']; ?></td>
                            <td><?php echo $row['date_insc']; ?></td>
                            <td><a href="form_edit.php?bd_eleve_id=<?php echo ($row['id_insc']) ?>" class="btn btn-xs btn-primary" title="">MODIFIER</a></td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    <?php
                    }
                    ?>
                    <tfoot>
                      <tr>
                        <th>CODE ELEVES</th>
                        <th>PHOTOS</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>SEXE</th>
                        <th>CLASSE</th>
                        <th>ANNEE ACA.</th>
                        <th>STATUT</th>
                        <th>DATE INSCRIP.</th>
                        <th>ACTION</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
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