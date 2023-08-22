<?php require_once("header.php"); ?>

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
              <h1>DataTables</h1>
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
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DataTable with minimal features & hover style</h3>
                </div>

                <!-- start your code hear -->


                <!--/ end code -->
              </div>
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
              <h1>DataTables</h1>
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
              <?php
              include('../connexion/conn.php');
              ## Fetch countries
              $stmt = $bdd->prepare("SELECT * FROM classe ORDER BY classe_name");
              $stmt->execute();
              $countriesList = $stmt->fetchAll();
              foreach ($countriesList as $country) {
                $nbr_insc = $country['classe_id'];


                $result = $bdd->prepare("SELECT COUNT(id_insc) AS nbr FROM inscription where classe_id=$nbr_insc");
                $result->execute();
                $row = $result->fetch();
                $a = $row['nbr'];
              ?>

                <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                      <a href="liste_des_notes.php?bd_classe_id=<?php echo ($country['classe_id']) ?>" class="nav-link">
                        <i class="fas fa-inbox"></i> <?php echo $country['classe_name']; ?>
                        <span class="badge bg-primary float-right"><?php echo $a ?></span>
                      </a>
                    </li>
                  <?php
                }
                  ?>
                  </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


          <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Striped Full Width Table</h3>
              </div>
              <?php
              // if (isset($_GET['bd_classe_id'])) {
              // extract($_GET);
              ?>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-success" style="width: 90%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-success">90%</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.card -->

          <?php
          //   } 
          ?>
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