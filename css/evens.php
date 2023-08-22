<?php 
include('../connexion/conn.php');
$query = "SELECT  * FROM classe ORDER BY classe_name ASC";

$statement = $bdd->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
//var_dump($_FILES);
if(!empty($_FILES)){
  $file_name =$_FILES['file']['name'];
  $file_extention= strrchr($file_name,".");
  $file_tmp_name =$_FILES['file']['tmp_name'];
  $file_dest='../files/'.$file_name;
   $classe_id = $_POST['classe_id'];

  $extentions_autorisees=array('.pdf','PDF');
  if(in_array($file_extention,$extentions_autorisees)){
    if(move_uploaded_file($file_tmp_name,$file_dest)){
      $req=$bdd->prepare('INSERT INTO document(name,file,classe_id)VALUE(?,?,?)');
      $req->execute(array($file_name,$file_dest,$classe_id));
     // echo' suuuuuu';
    }
    //else{
     // echo 'ddddddddd';
   // }
  }else{
    echo'Seuls les fichiers pdf sont autorises';
  }
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sushine Academic | Gestion des classes</title>
  <?php require_once("../css/css.php"); ?>
</head>

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
              <h1>Gestion des document</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                <li class="breadcrumb-item active">Gestion des document</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <section class="content">
        <div class="container-fluid">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            ADD DOCUMENT
          </button><br><br>          

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Liste des document</h3>
                </div>
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
                        
                        <th> Document </th>
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
                     
                $result2 = $bdd->query("SELECT document.classe_id 
                FROM document
                INNER JOIN classe ON document.classe_id = classe.classe_id
                WHERE classe.classe_id = ? ");
                $params_1 = array($classe1);
                $result2->execute($params_1);
                      //OUVERTURE DE LA BOUCLE FOR
                      while($data=$result2->fetch()) {
                      ?>
                        <tr>
                        
                          <td><?php echo $data['name']; ?></td>                          
                          <td><?php echo $data['classe_name']; ?></td>
                          <td style="text-align:center;">
								               <button type="button"  class="btn btn-flat  btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                               Selectionnez
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div style="min-width:120px;" class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="download.php?file=<?php echo $data['file'] ?>"  data-toggle="tooltip"><span class="fa fa-trash text-danger"></span> Download</a>
				                    
				                    <a onclick="return confirm('etes vous sure...');" class="dropdown-item delete_data" href="deleteDoc.php?id_document=<?php echo($data['id_document'])?>" ><span class="fa fa-trash text-danger"></span> Supprimer</a>
				                  </div>
						         	</td>

                        </tr>
                       

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
                        
                        <th> Document </th>
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
      <div class="modal-dialog" style="padding:60px;" role="document">
        <div class="modal-content">
         
          <div class="modal-header" style="background-color: #0078d7; padding:6px; border-radius:5px 5px 0 0;">
                                <h4 class="title-conditionned" style="display: inline;">Add DOCUMENT</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>          
          <form action="" method="post" enctype="multipart/form-data">

            <div class="modal-body">

            <div class="form-group">
                <label for="name">FILES</label>
                <input type="file" class="form-control" name="file" placeholder="Enter " required>
              </div>

              <div class="form-group">
                <label for="name">CLASSE</label>
                <select class="form-control" name="classe_id" id="category_classe">
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



            </div>
            <div class="modal-footer">              
              <button type="submit" class="btn btn-xs btn-primary">Sauvegarder</button>
              <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Fermer</button>
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