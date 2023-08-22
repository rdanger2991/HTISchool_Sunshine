<!DOCTYPE html>
<html>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/adminlte.min.css">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Invoice Print</title>
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice  p-3 mb-3">
                                    <h2 class="page-header">
                                        <center><img src="../dist/img/a.png" width="70" height="70">
                                            <h2>SUNSHY ACADEMY</h2>
                                            <h4>486,Santo 15 Route de la Croix-des-Bouquets</h4>
                                            <h5>Tel:3316-4495/34467232</h5>
                                        </center>
                                        <hr class="bg-primary" style="border:2px solid blue;">
                                        <small class="float-right"><?php echo $_GET['trx_number']; ?></small>
                                    </h2>
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <table class="table" style="border:0px solid white;">
                                        <tr style="border:0px solid white;">
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px">Code Eleve</td>
                                            <td class="text-bold " text="" style="border:0px solid white; font-size: 24px"><?php echo $_GET['code_eleve']; ?></td>
                                        </tr>
                                        <tr style="border:0px solid white;">
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px">Eleve</td>
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px"></td>
                                        </tr>

                                        <tr style="border:0px solid white;">
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px">Classe</td>
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px"></td>
                                        </tr>

                                        <tr style="border:0px solid white;">
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px">Versement</td>
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px"></td>
                                        </tr>

                                        <tr style="border:0px solid white;">
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px">Quantite Versé</td>
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px"></td>
                                        </tr>

                                        <tr style="border:0px solid white; ">
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px">Balance</td>
                                            <td class="text-bold " style="border:0px solid white; font-size: 24px;"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-2">

                                    <img class="img-circle" style="margin-right: 700px; margin-top: 60px;" th:src="@{/getPhotoEl(idPerson=${paiementInfo.eleves.idPerson})}" width="250" height="250" />

                                </div>
                            </div>
                            <p></p>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>


    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>