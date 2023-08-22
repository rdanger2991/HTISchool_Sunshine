<?php require_once("../header/header.php"); ?>

<?php
$bd_eleve_id = $_GET['bd_note_id'];
require_once("../connexion/conn.php");
$ps = $bdd->prepare("SELECT inscription.code_eleve, inscription.nom, inscription.prenom, inscription.id_insc, frequence.frequence,frequence.id_freq,classe.classe_name,classe.classe_id,
matiere.matiere,matiere.id_matiere,annee_acad.annee_acad,annee_acad.id_acad,note.note,note.id_note
from note
inner join inscription on inscription.id_insc=note.id_insc
inner join frequence on frequence.id_freq=note.id_freq
inner join classe on classe.classe_id=note.classe_id
inner join matiere on matiere.id_matiere=note.id_matiere
inner join annee_acad on annee_acad.id_acad=note.id_acad
	WHERE note.id_note = ?");
$params = array($bd_eleve_id);
$ps->execute($params);
$note = $ps->fetch();
?>


<?php
$bd_eleve_id1 = $_GET['bd_note_id'];
require_once("../connexion/conn.php");
$ps1 = $bdd->prepare("SELECT inscription.code_eleve, inscription.nom, inscription.prenom, inscription.id_insc, frequence.frequence,frequence.id_freq,classe.classe_name,classe.classe_id,
matiere.matiere,matiere.id_matiere,annee_acad.annee_acad,annee_acad.id_acad,note.note,note.id_note
from note
inner join inscription on inscription.id_insc=note.id_insc
inner join frequence on frequence.id_freq=note.id_freq
inner join classe on classe.classe_id=note.classe_id
inner join matiere on matiere.id_matiere=note.id_matiere
inner join annee_acad on annee_acad.id_acad=note.id_acad
	WHERE note.id_note = ?");
$params1 = array($bd_eleve_id1);
$ps1->execute($params1);
$data_1 = $ps1->fetchAll();
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
                            <h1>MODIFICATION</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">MODIFICATION</li>
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

                            <!-- start your code hear -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">MODIFIER NOTES</h3>
                                </div>
                                <form role="form" method="post" action="update_note.php" enctype="multipart/form-data" id="quickForm">
                                    <div class="card-body">
                                        <center>
                                            <div class="col-3">
                                                <label for="exampleInputEmail1"><?php echo ($note['nom'] . '  ' . $note['prenom'] . '  (' . $note['code_eleve'] . ')     ANNEE ACADEMIQUE:  ' . $note['annee_acad']) . '     CLASSE:  ' . $note['classe_name'] ?></label>

                                            </div>
                                        </center>
                                        <br><br>
                                        <div class="container" style="width: 30%;">
                                            <div class="">

                                                <label for="exampleInputEmail1">FREQUENCE</label>
                                                <select class="col-sm-12 col-form-label" name="freq" required>
                                                    <?php echo '<option value=' . $note['id_freq'] . '>'  . $note['frequence'] . '</option>';
                                                    ?>
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

                                                <?php
                                                $id_classe = $note['classe_id'];
                                                foreach ($data_1 as $row_note) {
                                                ?>

                                                    <div class="form-group">
                                                        <label>MATIERE </label>
                                                        <input name="matiere" class="form-control" value="<?php echo ($row_note['matiere']) ?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>NOTE </label>
                                                        <input name="note" class="form-control" value="<?php echo ($row_note['note']) ?>">
                                                    </div>
                                                    <input type="hidden" name="id_note" class="form-control" value="<?php echo ($row_note['id_note']) ?>">
                                                <?php
                                                }
                                                ?>

                                            </div>

                                            <br>
                                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                        </div>
                                        <!-- /.card-body -->
                                </form>
                            </div>
                            <!-- /.card -->

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