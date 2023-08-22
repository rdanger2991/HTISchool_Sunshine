<?php
include('../connexion/conn.php');
$query = "SELECT  * FROM classe ORDER BY classe_name ASC";

$statement = $bdd->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>

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
              <h1>GESTION DES MATIERES</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                <li class="breadcrumb-item active">GESTION DES MATIERES</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            AJOUTER MATIERE
          </button><br><br>


          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">La liste des matières</h3>
                </div>

                <!-- start your code hear -->
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
                            $result_classe = $bdd->prepare("SELECT * FROM classe ORDER BY classe_name ASC");

                            $result_classe->execute();
                            for ($i = 0; $row_classe = $result_classe->fetch(); $i++) {

                              echo '<option value=' . $row_classe['classe_id'] . '>'  . $row_classe['classe_name'] . '</option>';
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
                        <th>CODE MATIERE</th>
                        <th>CATEGORIE</th>
                        <th>COEFFICIENT</th>
                        <th>MATIERE</th>
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
                        $result2 = $bdd->prepare("SELECT cate_matiere.cat_mat_id, classe.classe_id, classe.classe_name, 
                        cate_matiere.cate_matiere,matiere.id_matiere, matiere.code_matiere,matiere.matiere,matiere.coefficient
                FROM ((matiere
                INNER JOIN cate_matiere ON matiere.id_cat_mat = cate_matiere.cat_mat_id) 
                 INNER JOIN classe ON matiere.classe_id = classe.classe_id) 
                 WHERE classe.classe_id = ? ");
                        $params_1 = array($classe1);
                        $result2->execute($params_1);
                        //OUVERTURE DE LA BOUCLE
                        while ($row1 = $result2->fetch()) {
                        ?>
                          <tr>
                            <td><?php echo $row1['code_matiere']; ?></td>
                            <td><?php echo $row1['cate_matiere']; ?></td>
                            <td><?php echo $row1['coefficient']; ?></td>
                            <td><?php echo $row1['matiere']; ?></td>
                            <td><?php echo $row1['classe_name']; ?></td>
                            <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $row1['id_matiere']; ?>">Modifier</button></td>
                          </tr>

                          <!-- modal edit-->
                          <div class="modal fade" id="modalEdit<?php echo $row1['id_matiere']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: #0078d7; border-radius:5px 5px 0 0;">
                                  <h4 class="title-conditionned" style="display: inline;">Modifier MATIERE</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="save_edit_matiere.php" method="post">

                                  <div class="modal-body">

                                    <div class="form-group">
                                      <label for="name">CODE</label>
                                      <input type="text" class="form-control" name="code_matiere" value="<?php echo $row1['code_matiere']; ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                      <label for="name">COEFFICIENT</label>
                                      <input type="text" class="form-control" name="coefficient" value="<?php echo $row1['coefficient']; ?>">
                                    </div>


                                    <!-- edit categorie classe-->
                                    <div class="form-group">
                                      <label>CATEGORIE </label>
                                      <select class="form-control" name="cate_matiere" id="category_classe">
                                        <?php echo '<option value=' . $row1['cat_mat_id'] . '>'  . $row1['cate_matiere'] . '</option>'; ?>


                                        <?php
                                        include('../connexion/conn.php');
                                        $result1 = $bdd->prepare("SELECT * FROM cate_matiere ORDER BY cate_matiere ASC");

                                        $result1->execute();
                                        for ($i = 0; $row3 = $result1->fetch(); $i++) {

                                          echo '<option value=' . $row3['cat_mat_id'] . '>'  . $row3['cate_matiere'] . '</option>';
                                        ?>
                                        <?php
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <!-- /edit categorie classe-->

                                    <!-- edit classe-->
                                    <div class="form-group">
                                      <label>CLASSE </label>
                                      <select class="form-control" name="classe_name" id="category_classe">
                                        <?php echo '<option value=' . $row1['classe_id'] . '>'  . $row1['classe_name'] . '</option>'; ?>
                                        <?php
                                        include('../connexion/conn.php');
                                        $result_cl = $bdd->prepare("SELECT * FROM classe ORDER BY classe_name ASC");

                                        $result_cl->execute();
                                        for ($i = 0; $row2 = $result_cl->fetch(); $i++) {

                                          echo '<option value=' . $row2['classe_id'] . '>'  . $row2['classe_name'] . '</option>';
                                        ?>
                                        <?php
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <!-- /edit classe-->

                                    <div class="form-group">
                                      <label for="name">MATIERE</label>
                                      <input type="text" class="form-control" name="matiere" value="<?php echo $row1['matiere']; ?>">
                                    </div>

                                  </div>

                                  <div class="modal-footer">
                                    <input type="hidden" name="id_matiere" value="<?php echo $row1['id_matiere']; ?>" />
                                    <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-xs btn-primary" name="updateMatiere">Save</button>
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
                        <th>CODE MATIERE</th>
                        <th>CATEGORIE</th>
                        <th>COEFFICIENT</th>
                        <th>MATIERE</th>
                        <th>CLASSE</th>
                        <th> Action </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>

                <!--/ end code -->
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

            <h4 class="title-conditionned" style="display: inline;">Add CLASSES</h4>

            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <form action="save_matiere.php" method="post">

            <div class="modal-body">



              <div class="form-group">
                <label for="name">COEFFICIENT</label>
                <input type="text" class="form-control" name="coefficient">
              </div>

              <!-- SELECT CATEGORIE-->
              <div class="form-group">
                <label>CATEGORIE</label>
                <select class="form-control" name="cate_matiere" id="category_classe">
                  <option>-Select-</option>
                  <?php
                  include('../connexion/conn.php');
                  $result = $bdd->prepare("SELECT * FROM cate_matiere ORDER BY cate_matiere ASC");

                  $result->execute();
                  for ($i = 0; $row = $result->fetch(); $i++) {

                    echo '<option value=' . $row['cat_mat_id'] . '>'  . $row['cate_matiere'] . '</option>';
                  ?>
                  <?php
                  }
                  ?>
                </select>
              </div>

              <!--/FIN SELECT CATEGORIE -->


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


              <div class="form-group">
                <label for="name">MATIERE</label>
                <input type="text" class="form-control" name="matiere_name" placeholder="Enter ">
              </div>



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


</body>