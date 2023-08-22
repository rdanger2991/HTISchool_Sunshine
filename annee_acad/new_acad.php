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
							<h1>Gestion des années academiques</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="../index.php">ACCUEIL</a></li>
								<li class="breadcrumb-item active">Gestion des années academiques</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<section class="content">
				<div class="container-fluid">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
						NEW
					</button><br><br>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Liste des années academiques</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th> ANNEE ACADEMIQUE </th>
												<th> Action </th>
											</tr>
										</thead>
										<tbody>
											<?php
											include('../connexion/conn.php');
											$result = $bdd->prepare("SELECT * FROM annee_acad ORDER BY annee_acad ASC");
											$result->execute();
											//OUVERTURE DE LA BOUCLE FOR
											for ($i = 0; $row = $result->fetch(); $i++) {
											?>
												<tr>

													<td><?php echo $row['annee_acad']; ?></td>
													<td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $row['id_acad']; ?>">Modifier</button></td>


													<!-- FERMETURE DE LA BOUCLE FOR -->
												<?php
											}
												?>
										</tbody>
										<tfoot>
											<tr>
												<th> ANNEE ACADEMIQUE </th>
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



		<!-- /.modal new Annee Academique -->

		<div class="modal fade" id="modal-default">

			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Nouvelle Année academique</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="col-12">
						<!-- <div class="col-5">

<input type="number" id="date1" name=""class="form-control">
</div>
<div class="col-5" style="float:right">
<input type="number" id="date2" name=""class="form-control">
</div> -->

						<div class="row">
							<div class="col-12  col-sm-6">
								<div class="form-group">
									<input type="number" id="date1" class="form-control">
								</div>
							</div>

							<div class="col-12  col-sm-6">
								<div class="form-group">
									<input type="number" id="date2" class="form-control">
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-primary" onclick="cont()">Verifier</button>
					</div>

					<form action="save_new_acad.php" method="post">

						<div class="modal-body">
							<div class="col-12 col-sm-12">

								<div class="form-group">

									<input type="text" name="annee_acad" id="anneeAC" class="form-control" placeholder="Nouvelle année (Ex: YYYY-YYYY)" readonly />
								</div>
								<!-- /.form-group -->
							</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
					<script type="text/javascript">
						function cont() {
							var date1 = document.getElementById('date1');
							var date2 = document.getElementById('date2');
							var annees = document.getElementById('anneeAC');

							var dateS = new Date();
							if (date1.value > dateS.getFullYear() + 1 && date2.value > dateS.getFullYear()) {
								date1.value = '';
								date2.value = '';
								$.notify("incorrect ");


							} else {
								var dd = date2.value - date1.value;
								if (dd == 1) {
									annees.value = date1.value + '-' + date2.value;
									$.notify("success la date est correcte", "success");

								} else {
									date1.value = '';
									date2.value = '';

									$.notify("incorrect ");

								}
							}

						}
					</script>

				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<?php
		require_once("../footer.php");
		?>
	</div>
	<?php
	require_once("../js/js.php");
	
    // require_once("../js/js_data_tables.php");
     
	?>
</body>

</html>