<?php

//fetch.php
include('../connexion/conn.php');

if ($_POST["query"] != '') {
	$search_array = explode(",", $_POST["query"]);
	$search_text = "'" . implode("', '", $search_array) . "'";
	$query = "
	SELECT matiere.id_cat_mat, matiere.classe_id, classe.classe_name, cate_matiere.cate_matiere,matiere.id_matiere, matiere.code_matiere,matiere.matiere,matiere.coefficient
                FROM ((matiere
                INNER JOIN classe ON matiere.classe_id = classe.classe_id)
                INNER JOIN cate_matiere ON matiere.id_cat_mat = cate_matiere.cat_mat_id)
	WHERE matiere.classe_id IN (" . $search_text . ") 
	";
} else {
	$query = "SELECT matiere.id_cat_mat, matiere.classe_id, classe.classe_name, cate_matiere.cate_matiere,matiere.id_matiere, matiere.code_matiere,matiere.matiere,matiere.coefficient
                FROM ((matiere
                INNER JOIN classe ON matiere.classe_id = classe.classe_id)
                INNER JOIN cate_matiere ON matiere.id_cat_mat = cate_matiere.cat_mat_id)";
}

$statement = $bdd->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '';

if ($total_row > 0) {
	foreach ($result as $row) {
		$output .= '
		<tr>
		<td>' . $row["code_matiere"] . '</td>
		<td>' . $row["cate_matiere"] . '</td>
		<td>' . $row["coefficient"] . '</td>
		<td>' . $row["matiere"] . '</td>
		<td>' . $row["classe_name"] . '</td>
		
	 <td><button type="button" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#modalEdit' . $row["id_matiere"] . '">Modifier</button></td>
		</tr>

		';

	}
} else {
	$output .= '
	<tr>
		<td colspan="5" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

require_once("../js/js_data_tables.php");
?>


<?php

?>