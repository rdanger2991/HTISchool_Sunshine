<?php require_once("../header/header.php"); ?>
<?php
//lister eleves par classe
require_once("../connexion/conn.php");
$bd_classe_id1 = $_GET['bd_classe_id'];
$result1 = $bdd->prepare("SELECT id_insc, nom,prenom,classe.classe_id
FROM Classe
INNER JOIN inscription
 ON classe.classe_id = inscription.classe_id
 WHERE classe.classe_id=? and NOT EXISTS
 (SELECT * FROM note
                  INNER JOIN frequence
                   ON frequence.id_freq = note.id_freq
                  INNER JOIN matiere
                   ON matiere.id_matiere =note.id_matiere
                  WHERE note.id_matiere = 7 AND  note.id_freq=1
                    AND note.id_insc = inscription.id_insc)");
$params1 = array($bd_classe_id1);
$result1->execute($params1);
$data = $result1->fetchAll();

//lister matiere par classe
$bd_classe_id_1 = $_GET['bd_classe_id'];
$result_1 = $bdd->prepare("SELECT  matiere.classe_id, matiere.id_matiere, matiere.matiere, matiere.coefficient
                FROM (matiere
                INNER JOIN classe ON matiere.classe_id = classe.classe_id)  WHERE classe.classe_id =?");
$params_1 = array($bd_classe_id_1);
$result_1->execute($params_1);
$data_1 = $result_1->fetchAll();

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
                                            <a href="saisi_note.php?bd_classe_id=<?php echo ($row['classe_id']) ?>" class="nav-link">
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

                    <div class="col-md-9">
                        <div class="card card-primary card-primary">
                            <div class="card-header">
                                <h3 class="card-title">PALMARES</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="save_note.php" method="post" id="quickForm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <!-- select frequence -->
                                            <div class="form-group">
                                                <label>FREQUENCE:</label>
                                                <select class="form-control" name="id_freq">
                                                    <option>-Select-</option>
                                                    <?php
                                                    include('../connexion/conn.php');
                                                    $result = $bdd->prepare("SELECT * FROM frequence ORDER BY frequence ASC");

                                                    $result->execute();
                                                    for ($i = 0; $row = $result->fetch(); $i++) {

                                                        echo '<option value=' . $row['id_freq'] . '>'  . $row['frequence'] . '</option>';
                                                    ?>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-sm-3">
                                            <!-- select matiere-->
                                            <div class="form-group">
                                                <label>MATIERE</label>
                                                <select class="custom-select" name="id_matiere" id="matiere">
                                                    <option value="">-SELECT-</option>
                                                    <?php
                                                    foreach ($data_1 as $row_4) {
                                                        echo '<option value=' . $row_4['id_matiere'] . '>'  . $row_4['matiere'] . '/' . $row_4['coefficient'] .  '</option>';
                                                    ?>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                            <input type="hidden" name="coef" id="coefficient2" />
                                        </div>


                                        <div class="col-sm-3">
                                            <!-- input classe-->
                                            <div class="form-group">
                                                <label>CLASSE</label>
                                                <?php
                                                include('../connexion/conn.php');
                                                $bd_classe_id = $_GET['bd_classe_id'];
                                                $ps = $bdd->prepare("SELECT * FROM classe WHERE classe_id=?");
                                                $params = array($bd_classe_id);
                                                $ps->execute($params);
                                                $row3 = $ps->fetch();
                                                ?>
                                                <input name="classe_name" value="<?php echo ($row3['classe_name']) ?>" class="form-control" readonly>
                                                <input type="hidden" value="<?php echo ($row3['classe_id']) ?>" name="classe_id">

                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <!-- select annee academique-->
                                            <div class="form-group">
                                                <label>ANNEE ACADEMIQUE</label>
                                                <?php
                                                $ps_1 = $bdd->prepare("SELECT * FROM annee_acad where id_acad in (select max(id_acad) from annee_acad)");
                                                $ps_1->execute();
                                                $row_1 = $ps_1->fetch();
                                                ?>
                                                <input name="annee_acad" value="<?php echo ($row_1['annee_acad']) ?>" class="form-control" readonly>
                                                <input type="hidden" value="<?php echo ($row_1['id_acad']) ?>" name="id_acad">
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    foreach ($data as $row4) {
                                    ?>
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo ($row4['nom'] . ' ' . $row4['prenom']) ?></label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" value="<?php echo ($row4['id_insc']) ?>" name="id_insc[]" class="form-control">

                                                </div>

                                                <div class="col-sm-5">
                                                    <input name="note[]" class="form-control" id="note[]" onchange="ss()">
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>
                            <!-- /.card-body -->
                            <!-- /.card-footer -->
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
    ?>

    <script type=text/javascript>
        $('#matiere').change(function() {
            var id_matiere = $(this).val();
            if (id_matiere) {
                $.ajax({
                    type: "GET",
                    url: "load_coefficient.php",
                    data: 'id_matiere=' + id_matiere,
                    success: function(res) {
                        if (res) {
                            $("#coefficient").empty();
                            $("#coefficient").append('<option>Select State</option>');
                            var dataObj = jQuery.parseJSON(res);
                            if (dataObj) {
                                $(dataObj).each(function() {
                                    $("#coefficient").append('<option value="' + this.id_matiere + '">' + this.coefficient + '</option>');
                                    coef = $("#coefficient2").val(this.coefficient);
                                    note = $("#inputEmail3").val()


                                });
                            } else {
                                $("#coefficient").empty();
                            }
                        } else {
                            $("#coefficient").empty();
                        }
                    }
                });
            }
        });
    </script>


    <script type="text/javascript">
        /*  function ss() {
            var not_exa = document.getElementById('note[]');
            var coef_mat = document.getElementById('coefficient2');
            // var annees = document.getElementById('anneeAC');
            var ss = count();
            for (var i = 0; i < count(ss); i++) {

                if (not_exa[i].value > coef_mat.value) {
                    not_exa[].value = '';
                    $.notify("incorrect ");
                    //alert('incorrect')

                }
            }

        }*/
    </script>

</body>