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
              <h1>Catégorie Matières</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                <li class="breadcrumb-item active">Catégorie Matières</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            AJOUTER CATEGORIE
          </button><br><br>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Liste des catégories matières</h3>
                </div>

                <!-- start your code hear -->
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>CATEGORIE MATIERE</th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include('../connexion/conn.php');
                      $result = $bdd->prepare("SELECT * FROM cate_matiere ORDER BY cat_mat_id ASC");
                      $result->execute();
                      //OUVERTURE DE LA BOUCLE FOR
                      for ($i = 0; $row = $result->fetch(); $i++) {
                      ?>
                        <tr>
                          <td><?php echo $row['cate_matiere']; ?></td>
                          <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $row['cat_mat_id']; ?>">Modifier</button></td>
                        </tr>

                        <!-- modal edit-->
                        <div class="modal fade" id="modalEdit<?php echo $row['cat_mat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color: #0078d7; border-radius:5px 5px 0 0;">
                                <h4 class="title-conditionned" style="display: inline;">Modifier CLASSE</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <form action="SaveEdit_cat_mat.php" method="post">

                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="name">CLASSE</label>
                                    <input type="text" class="form-control" name="cate_matiere" value="<?php echo $row['cate_matiere']; ?>">
                                  </div>

                                </div>

                                <div class="modal-footer">
                                  <input type="hidden" name="cat_mat_id" value="<?php echo $row['cat_mat_id']; ?>" />
                                  <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-xs btn-primary" name="update_cat_mat">Save</button>
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
                        <th>CATEGORIE MATIERE</th>
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

            <h4 class="title-conditionned" style="display: inline;">CATEGORIE MATIERE</h4>

            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="form-group">
            <form name="add_name" id="add_name">
              <table class="table table-bordered table-hover" id="dynamic_field">
                <tr>
                  <td><input type="text" name="cate_matiere[]" onkeyup="this.value=this.value.toUpperCase()" placeholder="ENTER" class="form-control name_email" /></td>
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
        $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="cate_matiere[]" onkeyup="this.value=this.value.toUpperCase()" placeholder="ENTER"  class="form-control name_list"/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
      });

      $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
      });

      $("#submit").on('click', function() {
        var formdata = $("#add_name").serialize();
        $.ajax({
          url: "save_cat_matiere.php",
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