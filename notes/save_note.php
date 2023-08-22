<?php
require_once("../connexion/conn.php");
//$bd_classe_id1 = $_GET['bd_classe_id'];

$userData = count($_POST["note"]);
$result = $bdd->prepare("SELECT * from moyenne");
$result->execute();
$row = $result->fetch();
$a = $row['id_insc'];
$b = $row['id_freq'];
$c = $row['id_acad'];



$result_note = $bdd->prepare("select inscription.id_insc, moyenne.total_note 
from moyenne
right join inscription on inscription.id_insc=moyenne.id_insc");
$result_note->execute();
$row_note = $result_note->fetch();
$a_note = $row_note['total_note'];

   if ($userData > 0) {
    $j=0;
	    for ($i=0; $i < $userData; $i++) {
   
        $frequence   = $_POST["id_freq"];
        $note   = $_POST["note"][$i];
        $i_acad   = $_POST["id_acad"];
        $classe_id   = $_POST["classe_id"];
        $id_insc   = $_POST["id_insc"][$i];
        $id_matiere   = $_POST["id_matiere"];
        $coef = $_POST["coef"];

if($note<$coef || $note=""){
require_once("../connexion/conn.php");
$ps=$bdd->prepare("INSERT INTO note(note,id_insc,id_freq,classe_id,id_matiere,id_acad) VALUES(?,?,?,?,?,?)");
$params=array( $note, $id_insc, $frequence,  $classe_id, $id_matiere, $i_acad );
$ps->execute($params);

          
    }

    else{
      $j++;  
    }

    if ($a == "" || $b == "" || $c == "" || $a_note="" ) {
      $a1 = $_POST["id_insc"][$i];;
      $note_moy   = $_POST["note"][$i];
      $moy = $note_moy * 10 / $coef;
      $ps1 = $bdd->prepare("INSERT INTO moyenne(total_coef,total_note,moyenne,id_freq,id_acad,id_insc) VALUES(?,?,?,?,?,?)");
      $params1 = array($coef, $note_moy, $moy, $frequence, $i_acad, $a1);
      $ps1->execute($params1);
    }

    else{
     
      $tot_coef = $row['total_coef'];
      $tot_note = $row['total_note'];

      //$moy_update = $row['moyenne'];
      $a_up = $_POST["id_insc"][$i];
      $note_moy_up  = $_POST["note"][$i];

    
      $sql = "UPDATE moyenne 
        SET total_coef=total_coef + $coef,total_note=total_note + $note_moy_up
         WHERE id_freq=$frequence and id_acad=$i_acad and id_insc=$a_up";
      $q = $bdd->prepare($sql);
      $q->execute();

      $result_00 = $bdd->prepare("SELECT * from moyenne WHERE id_freq=$frequence and id_acad=$i_acad and id_insc=$id_insc");
      $result_00->execute();
      while($row_00= $result_00->fetch()){
      $tot_coef_00 = $row_00['total_coef'];
      $tot_note_00 = $row_00['total_note'];

      $update_moyenne= $tot_note_00*10/ $tot_coef_00;
        //echo $update_moyenne;

        $sql_00 = "UPDATE moyenne 
        SET moyenne=$update_moyenne
         WHERE id_freq=$frequence and id_acad=$i_acad and id_insc=$a_up";
        $q_00 = $bdd->prepare($sql_00);
        $q_00->execute();
      }
    }

 
}

if($j>0){
    echo '<script>
   if (confirm("Press a button!") == true) {
 url: ../notes/note_form.php",
}
    </script>';
  
}

  header("location: ../notes/note_form.php");
         }
	    
       
