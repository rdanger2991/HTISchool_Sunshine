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
                            <h1>Paiements</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
                                <li class="breadcrumb-item active">Paiements</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">

                            <!-- start your code hear -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Entrer code de l'Eleve</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form name="add_name" method="post">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">CODE ELEVE</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-border" name="code_eleve" value="" placeholder="entrer le code">
                                            </div><button type="submit" class="btn btn-primary" name="rech">Ok</button>
                                        </div>
                                    </div>
                                </form>
                            </div>



                            <!--/ end code -->

                        </div>

                        <?php
                        if (isset($_POST['rech'])) {
                            extract($_POST);
                            $code_eleve = $_POST['code_eleve'];
                        ?>
                            <?php
                            include('../connexion/conn.php');
                            $result2 = $bdd->prepare("SELECT inscription.id_insc, inscription.code_eleve, inscription.nom, inscription.prenom,  
                               inscription.classe_id,inscription.photo,
                              classe.classe_name,bourse.reduction,bourse_type.type_bourse,paiement_add_modalite.modalite,classe.classe_id,bourse.id_bourse
                  FROM bourse
                  INNER JOIN inscription ON bourse.id_ins = inscription.id_insc
                  INNER JOIN classe ON bourse.classe_id = classe.classe_id
                  inner join bourse_type on bourse.id_type_bourse=bourse_type.id_type_bourse
                  inner join paiement_add_modalite on paiement_add_modalite.id_mod_paie=bourse.id_mod_paie
                  WHERE inscription.code_eleve =?");
                            $params_1 = array($code_eleve);
                            $result2->execute($params_1);
                            ?>
                            <div class="col-6">
                                <?php
                                while ($row = $result2->fetch()) {
                                ?>
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Information Etudiants(e)</h3>
                                        </div>
                                        <!-- form start -->
                                        <div class="card-body">
                                            <div class="form-group row"></div>

                                            <!-- title row -->

                                            <!-- info row -->
                                            <div class="row invoice-info">
                                                <div class="col-sm-4 invoice-col">
                                                    <address>
                                                        <strong> Code Eleve</strong><br> <strong>
                                                            Nom Eleve</strong><br> <strong> Prenom</strong><br> <strong>
                                                            Classe</strong><br>
                                                    </address>
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4 invoice-col">

                                                    <address>
                                                        <strong><?php echo $row['code_eleve']; ?></strong><br> <strong text=""><?php echo $row['nom']; ?></strong><br> <strong text=""><?php echo $row['prenom']; ?></strong><br> <strong text=""><?php echo $row['classe_name']; ?></strong><br>
                                                        <strong></strong><br> <strong></strong>
                                                    </address>
                                                </div>
                                                <div class="col-sm-4 invoice-col">
                                                    <img class="img-circle" src="../img/<?php echo ($row['photo']) ?>" width="100" height="100" />
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                            </div>

                            <!-- ..... -->

                            <div class="col-md-12">
                                <!-- Horizontal Form -->
                                <div th:if="${eleves}">
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <!-- /.card -->
                                            <!-- </div>
                 </div> -->


                                            <div class="card card-primary card-tabs">
                                                <div class="card-header p-0 pt-1">
                                                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                        <li class="pt-2 px-3">
                                                            <h3 class="card-title">Paiement</h3>
                                                        </li>
                                                        <li class="nav-item"><a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">N.
                                                                Paiement</a></li>
                                                        <li class="nav-item"><a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Acquitter balance</a></li>
                                                        <li class="nav-item"><a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Liste transaction</a></li>
                                                    </ul>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content row h-100 justify-content-center align-items-center" id="custom-tabs-two-tabContent">
                                                        <div class="tab-pane fade show active col-md-9" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                                            <form action="save_paiement.php" method="post">
                                                                <div class="form-group">
                                                                    <label>TY_TRX</label> <input type="text" value="<?php echo $_GET['id']; ?>" name="cash" class="form-control" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label></label> <input type="hidden" value="<?php echo $row['classe_id']; ?>" name="classe_id" class="form-control" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label></label> <input type="hidden" value="<?php echo $row['code_eleve']; ?>" name="code_eleve" class="form-control" readonly>
                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>CODE PAIEMENT</label> <input type="text" value="<?php echo $_GET['trx_number']; ?>" name="trx_number" class="form-control" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>NOM ELEVE</label> <input type="text" value="<?php echo $row['nom'] . ' ' . $row['prenom']; ?>" class="form-control" readonly>
                                                                            <input type="hidden" value="<?php echo $row['id_insc']; ?>" name="id_insc" class="form-control" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                    $id_classe = $row['classe_id'];
                                                                    //echo $id_classe;
                                                                    ?>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>MODALITE</label> <select name="modalite" required class="form-control" id="sel_state">
                                                                                <option value="">-select mode de paiement-</option>
                                                                                <?php
                                                                                ## Fetch countries
                                                                                $stmt = $bdd->prepare("SELECT * FROM paiement_add_modalite where classe_id= $id_classe");
                                                                                $stmt->execute();
                                                                                $countriesList = $stmt->fetchAll();
                                                                                foreach ($countriesList as $country) {
                                                                                    echo "<option value='" . $country['id_mod_paie'] . "'>" . $country['modalite'] . "</option>";
                                                                                }


                                                                                ?>

                                                                            </select>


                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>COUT</label> <input type="text" class="form-control" name="coutModalite" id="cout" data-cout="" readonly />
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <!-- text input -->
                                                                        <div class="form-group">
                                                                            <label>QUANTITE VERSE:</label> <input type="text" class="form-control" name="quantiteVerser" onkeyup="myFunction(this.value);" id="qte" required pattern="^[0-9]+[,.]?[0-9]+$" />
                                                                            <div class="invalid-feedback"></div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>BALANCE</label> <input type="text" id="bal" class="form-control" name="balance" readonly />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
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
                                                                <div class="row">
                                                                    <div class="col-sm-6" id="bourseOption">
                                                                        <div class="form-group">
                                                                            <div class="form-check">
                                                                                <input disabled class="form-check-input typeB" id="bourseCout" type="radio" name="b" text="" value="" data-cout="<?php echo $row['reduction']; ?>" />
                                                                                <label class="form-check-label"><?php echo $row['type_bourse'] . '/' . $row['modalite'] . ' -> ' . $row['reduction']; ?></label>
                                                                                <input type="hidden" value="<?php echo ($row['id_bourse']) ?>" class="form-control" name="id_bourse" readonly />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>

                                                                <!--  -->


                                                                <button type="submit" class="btn btn-info">Submit</button>


                                                            </form>

                                                        <?php
                                                    }
                                                        ?>
                                                        </div>


                                                        <div class="tab-pane fade col-md-9" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                                            <div class="card-body">
                                                                <form th:action="@{/saveBal}" method="post" th:object="${lPaie}">
                                                                    <div class="col-sm-6">
                                                                        <!-- text input -->
                                                                        <div class="form-group">
                                                                            <input type="hidden" class="form-control" name="codePaiement" th:value="${genererCode1}" id="codeP" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <!-- text input -->
                                                                        <div class="form-group">
                                                                            <input type="hidden" class="form-control" th:value="${eleves.classe.classeName}" readonly>
                                                                            <input type="hidden" th:value="${eleves.classe.idClasse}" name="classe" class="form-control" readonly>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label>NOM ELEVE</label> <input type="text" th:value="|${eleves.nom} ${eleves.prenom}|" class="form-control" readonly> <input type="hidden" th:value="${eleves.idPerson}" name="eleves" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label>ANCIEN BALANCE</label> <input type="text" id="balAncien" th:value="${paiement.balance}" class="form-control" readonly />
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <!-- text input -->
                                                                            <div class="form-group">
                                                                                <label>QUANTITE VERSE:</label> <input type="text" class="form-control" name="quantiteVerser" onkeyup="myFunctionBal(this.value);" id="qte" required pattern="^[0-9]+[,.]?[0-9]+$" />
                                                                                <div class="invalid-feedback"></div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label>NEW BALANCE</label> <input type="text" id="balNouv" class="form-control" name="balance" readonly />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--  -->
                                                                    <div class="col-sm-6">
                                                                        <!-- select -->
                                                                        <div class="form-group">
                                                                            <select class="form-control" th:field="*{anneeAcad}" required style="visibility:hidden;">
                                                                                <th:block th:each="a:${annee}">
                                                                                    <option th:text="${a.anneeAC}" th:value="${a.idAcad}"></option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-footer">
                                                                        <button type="submit" class="btn btn-info">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade " id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">

                                                            <!-- Tables Data -->


                                                            <table id="example1" class="table table-bordered table-striped ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Code paiement</th>
                                                                        <th>ELEVES</th>
                                                                        <th>Modalité/Balance</th>
                                                                        <th>Cout</th>
                                                                        <th>Quantité verser</th>
                                                                        <th>BALANCE</th>
                                                                        <th>Date</th>
                                                                        <th>Classe</th>
                                                                        <th>Année Acad.</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr th:each="p:${lignePaiement}">
                                                                        <td th:text="${p.codePaiement}"></td>
                                                                        <td th:text="|${p.eleves.nom} ${p.eleves.prenom}|"></td>
                                                                        <td th:text="${p.modalite}"></td>
                                                                        <td th:text="${p.coutModalite}"></td>
                                                                        <td th:text="${p.quantiteVerser}"></td>
                                                                        <td th:text="${p.balance}"></td>
                                                                        <td th:text="${p.datePaie}"></td>
                                                                        <td th:text="${p.classe.classeName}"></td>
                                                                        <td th:text="${p.anneeAcad.anneeAC}"></td>

                                                                    </tr>

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Code paiement</th>
                                                                        <th>ELEVES</th>
                                                                        <th>Modalité/Balance</th>
                                                                        <th>Cout</th>
                                                                        <th>Quantité verser</th>
                                                                        <th>BALANCE</th>
                                                                        <th>Date</th>
                                                                        <th>Classe</th>
                                                                        <th>Année Acad.</th>

                                                                    </tr>
                                                                </tfoot>
                                                            </table>



                                                        </div>

                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="card">
                        <!--Table paiement-->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>CODE PAIEMENT</th>
                                        <th>CODE ELEVE</th>
                                        <th>NOM ELEVE </th>
                                        <th>CLASSE </th>
                                        <th> MODALITE</th>
                                        <th>PRIX MODALITE</th>
                                        <th> QUANTITE VERSE </th>
                                        <th> BALANCE </th>
                                        <th> DATE PAIEMENT </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_GET['trx_number'];
                                    include('../connexion/conn.php');
                                    $result = $bdd->prepare("SELECT inscription.id_insc, inscription.code_eleve, inscription.nom, inscription.prenom,  
                               inscription.classe_id, info_paiement.code_paiement, info_paiement.montant_verse, info_paiement.balance, info_paiement.date_paiement
                               ,classe.classe_name,bourse.reduction,paiement_add_modalite.modalite,paiement_add_modalite.cout,classe.classe_id,
                               paiement_add_modalite.id_mod_paie, info_paiement.id_paie,info_paiement.balance
                              FROM  info_paiement
                              inner join inscription on inscription.id_insc=info_paiement.id_insc
							  inner join classe on classe.classe_id=info_paiement.classe_id
							   inner join bourse on bourse.id_bourse=info_paiement.id_bourse
							   inner join paiement_add_modalite on paiement_add_modalite.id_mod_paie=info_paiement.id_mod_paie
                              WHERE info_paiement.code_paiement= :userid");
                                    $result->bindParam(':userid', $id);
                                    $result->execute();
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                    ?>

                                        <tr class="record">
                                            <th><?php echo $row['code_paiement']; ?> </th>
                                            <th><?php echo $row['code_eleve']; ?> </th>
                                            <th><?php echo $row['nom'] . ' ' . $row['prenom']; ?> </th>
                                            <th><?php echo $row['classe_name']; ?> </th>
                                            <th><?php echo $row['modalite']; ?> </th>
                                            <th><?php echo $row['cout']; ?> </th>
                                            <th><?php echo $row['montant_verse']; ?> </th>
                                            <th><?php echo $row['balance']; ?> </th>
                                            <th><?php echo $row['date_paiement']; ?> </th>
                                            <td width="90"><a href="delete_from_info_paiement.php?id=<?php echo $row['id_paie']; ?>&trx_number=<?php echo $_GET['trx_number']; ?>&id_trx=<?php echo $_GET['id']; ?>"><button class="btn btn-mini btn-danger"><i class="icon icon-remove"></i> Cancel </button></a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <th colspan="6"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                                        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                                                <?php
                                                function formatMoney($number, $fractional = false)
                                                {
                                                    if ($fractional) {
                                                        $number = sprintf('%.2f', $number);
                                                    }
                                                    while (true) {
                                                        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                                                        if ($replaced != $number) {
                                                            $number = $replaced;
                                                        } else {
                                                            break;
                                                        }
                                                    }
                                                    return $number;
                                                }
                                                $sdsd = $_GET['trx_number'];
                                                $resultas = $bdd->prepare("SELECT sum(montant_verse) as somme FROM info_paiement WHERE code_paiement= :a");
                                                $resultas->bindParam(':a', $sdsd);
                                                $resultas->execute();
                                                for ($i = 0; $rowas = $resultas->fetch(); $i++) {
                                                    $fgfg = $rowas['somme'];
                                                    echo formatMoney($fgfg, true);
                                                }
                                                ?>
                                            </strong>

                                        </td>

                                        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                                                <?php
                                                $resulta = $bdd->prepare("SELECT sum(balance) as bal FROM info_paiement WHERE code_paiement= :b");
                                                $resulta->bindParam(':b', $sdsd);
                                                $resulta->execute();
                                                for ($i = 0; $qwe = $resulta->fetch(); $i++) {
                                                    $asd = $qwe['bal'];
                                                    echo formatMoney($asd, true);
                                                }
                                                ?>

                                        </td>
                                        <th></th>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               
                <div class="clearfix"></div>
                <!--/ end code -->

                <!-- code_paiement, montant_verse, balance, date_paiement, id_insc, id_acad, id_mod_paie, classe_id,id_bourse -->
            <?php
                        }
            ?>

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

    <!-- Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            // State
            $('#sel_state').change(function() {
                var stateid = $(this).val();
                $.ajax({
                    url: 'action_paie.php',
                    type: 'post',
                    data: {
                        request: 1,
                        stateid: stateid
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = response.length;
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id'];


                            $("#cout").val(id);
                        }
                    }
                });
            });

        });


        function myFunction(value) {
            var res;
            var coutMod = document.getElementById('cout').value
            res = coutMod - value;
            document.getElementById('bal').value = res;
        }


        //contrainte pour paiement mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
        $(document).ready(function() {
            var qteVers = document.getElementById("qte");


            //hide all errors div
            $(".invalid-feedback").hide();

            //Function in order to check input classes
            function checkClasses(inputElement) {
                if (!inputElement.checkValidity()) {
                    inputElement.classList.remove("is-valid");
                    inputElement.classList.add("is-invalid");
                    inputElement.nextElementSibling.innerHTML = inputElement.validationMessage;
                    inputElement.nextElementSibling.style.display = "block";
                } else {
                    inputElement.classList.remove("is-invalid")
                    inputElement.classList.add("is-valid");
                    inputElement.nextElementSibling.style.display = "none";
                }
            }

            //Function in order to valide input with two events blur and keyup
            function validate(inputElement) {
                if (!inputElement.getAttribute("readonly")) {
                    inputElement.addEventListener("blur", function() {
                        checkClasses(inputElement);
                    })
                }
                inputElement.addEventListener("keyup", function() {
                    checkClasses(inputElement);
                });
            }

            //Call validate function in order to check each user form  input   
            //validate(qteVers)

            //second validatiooioo
            function checkVers(val) {
                var str = val;
                var patt = new RegExp("^[0-9]+[,.]?[0-9]+$");
                return patt.test(str);
            }
            $("#qte").on("input", function(e) {
                let qte = Number(e.target.value);
                let cout = Number($("#cout").val());

                $(".btn").attr("disabled", true)

                $(".invalid-feedback").hide()
                $("#qte").removeClass("is-invalid");
                $("#qte").removeClass("is-valid");

                if (checkVers(qte)) {
                    $(".invalid-feedback").hide()
                    $("#qte").removeClass("is-invalid");
                    $("#qte").addClass("is-valid");
                } else {
                    $(".invalid-feedback").show()
                    $("#qte").removeClass("is-valid");
                    $("#qte").addClass("is-invalid");
                }
                //
                if (cout > 0) {
                    if (qte > cout) {
                        $("#qte").removeClass("is-valid");
                        $(".invalid-feedback").show()
                        //document.querySelector(".invalid-feedback").style.display = "block";
                        $("#qte").addClass("is-invalid");
                        $(".btn").attr("disabled", true)
                    } else {
                        $(".btn").attr("disabled", false)
                    }
                }
            });



        });


        var btnLoad;
        var modalitePaiemnt;
        var coutModalite;
        var el;


        $(document).ready(function() {

            btnLoad = $("#btnLoadDept");
            modalitePaiemnt = $("#sel_state");
            coutModalite = $("#cout");
            el = $("#elev");

            //
            var bourseBloc = $("#bourseOption").html();
            modalitePaiemnt.on("change", function() {
                //
                $("#bourseOption").html(bourseBloc)
                //
                $("#qte").val("");
                $("#bal").val("")
                //remove a disabled attribute when user select..
                $("#bourseOption .typeB").removeAttr("disabled")

                //loadCout();

                //event in order to ..
                $("#bourseOption .typeB").change(function(e) {
                    //
                    $("#qte").val("");
                    $("#bal").val("")
                    let cout = Number(coutModalite.val());
                    var coutBourse = e.target.getAttribute("data-cout");
                    coutModalite.val(cout - coutBourse)

                })
            });

        });
    </script>
</body>