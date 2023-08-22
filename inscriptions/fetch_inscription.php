 <?php

     //fetch.php
     include('../connexion/conn.php');

     if ($_POST["query"] != '') {
          $search_array = explode(",", $_POST["query"]);
          $search_text = "'" . implode("', '", $search_array) . "'";
          $query = "
	SELECT inscription.id_insc, inscription.code_eleve, inscription.nom, inscription.prenom, inscription.sexe, inscription.date_naissance, inscription.tel, inscription.lieu_naissance, inscription.adresse,  inscription.email, inscription.dernier_etab, inscription.religion,
     inscription.derniere_classe, inscription.piece_fournies,inscription.classe_id, inscription.id_acad,inscription.photo,inscription.date_insc,classe.classe_name,annee_acad.annee_acad
                FROM ((inscription
                INNER JOIN classe ON inscription.classe_id = classe.classe_id)
                INNER JOIN annee_acad ON inscription.id_acad = annee_acad.id_acad)
	WHERE inscription.classe_id IN (" . $search_text . ") 
	";
     } else {
          $query = "SELECT inscription.id_insc, inscription.code_eleve, inscription.nom, inscription.prenom, inscription.sexe, inscription.date_naissance, inscription.tel, inscription.lieu_naissance, inscription.adresse,  inscription.email, inscription.dernier_etab, inscription.religion,
     inscription.derniere_classe, inscription.piece_fournies,inscription.classe_id, inscription.id_acad,inscription.photo,inscription.date_insc,classe.classe_name,annee_acad.annee_acad
                FROM ((inscription
                INNER JOIN classe ON inscription.classe_id = classe.classe_id)
                INNER JOIN annee_acad ON inscription.id_acad = annee_acad.id_acad)";
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
		  <td> ' . $row['code_eleve'] . '</td>
                          <td><img src="../img/' . ($row['photo']) . '" width="80" height="100"></td>
                          <td>' . $row['nom'] . '</td>
                          <td>' . $row['prenom'] . '</td>
                          <td>' . $row['sexe'] . '</td>
                          <td>' . $row['date_naissance'] . '</td>
                          <td>' . $row['tel'] . '</td>
                          <td>' . $row['lieu_naissance'] . '</td>
                          <td>' . $row['adresse'] . '</td>
                          <td>' . $row['email'] . '</td>
                          <td>' . $row['dernier_etab'] . '</td>
                          <td>' . $row['religion'] . '</td>
                          <td>' . $row['derniere_classe'] . '</td>
                          <td>' . $row['piece_fournies'] . '</td>
                          <td>' . $row['classe_name'] . '</td>
                          <td>' . $row['annee_acad'] . '</td>
                          <td>' . $row['date_insc'] . '</td>
	  <td><a href="form_edit.php?id_inscrip= (' . $row['id_insc'] . ')">
                              <button type="button" class="btn btn-xs btn-primary">Modifier</button></a>
                              <a href="form_edit.php?id_inscrip= (' . $row['id_insc'] . ')">
                              <button type="button" class="btn btn-xs btn-info">Voir Plus</button></a>
                          </td>
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


     ?>
 <?php
     require_once("../js/js_data_tables.php");
     ?>