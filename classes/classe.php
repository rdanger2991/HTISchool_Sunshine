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
            ADD CLASSES
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
                        <th> CODE </th>
                        <th> CATEGORIE </th>
                        <th>CLASSE</th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include('../connexion/conn.php');
                      $result = $bdd->prepare("SELECT * FROM classe ORDER BY classe_id ASC");
                      $result->execute();
                      //OUVERTURE DE LA BOUCLE FOR
                      for ($i = 0; $row = $result->fetch(); $i++) {
                      ?>
                        <tr>

                          <td><?php echo $row['code_classe']; ?></td>
                          <td><?php echo $row['cate_classe']; ?></td>
                          <td><?php echo $row['classe_name']; ?></td>
                          <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $row['classe_id']; ?>">Modifier</button></td>


                        </tr>
                        <!-- modal edit-->
                        <div class="modal fade" id="modalEdit<?php echo $row['classe_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color: #0078d7; border-radius:5px 5px 0 0;">
                                <h4 class="title-conditionned" style="display: inline;">Modifier CLASSE</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <form action="saveEditClasse.php" method="post">

                                <div class="modal-body">

                                  <div class="form-group">
                                    <label for="name">CODE</label>
                                    <input type="text" class="form-control" name="code_classe" value="<?php echo $row['code_classe']; ?>" readonly>
                                  </div>

                                  <div class="form-group">
                                    <label>CATEGORIE CLASSE </label>
                                    <select class="form-control" name="category_classe" id="category_classe">
                                      <?php echo '<option value=' . $row['cate_classe'] . '>'  . $row['cate_classe'] . '</option>'; ?>
                                      <option value="KINDERGARTEN">KINDERGARTEN</option>
                                      <option value="PRIMAIRE">PRIMAIRE</option>
                                      <option value="SECONDAIRE">SECONDAIRE</option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="name">CLASSE</label>
                                    <input type="text" class="form-control" name="name_classe" value="<?php echo $row['classe_name']; ?>">
                                  </div>

                                </div>

                                <div class="modal-footer">
                                  <input type="hidden" name="id" value="<?php echo $row['classe_id']; ?>" />
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
                        <th> CODE </th>
                        <th> CATEGORIE </th>
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

            <h4 class="title-conditionned" style="display: inline;">Add CLASSES</h4>

            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <form action="saveClasse.php" method="post">

            <div class="modal-body">

              <div class="form-group">
                <label>CATEGORIE CLASSE </label>
                <select class="form-control" name="cate_classe" id="category_classe">
                  <option value="KINDERGARTEN">KINDERGARTEN</option>
                  <option value="PRIMAIRE">PRIMAIRE</option>
                  <option value="SECONDAIRE">SECONDAIRE</option>
                </select>
              </div>

              <div class="form-group">
                <label for="name">CLASSE</label>
                <input type="text" class="form-control" name="classe_name" placeholder="Enter ">
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