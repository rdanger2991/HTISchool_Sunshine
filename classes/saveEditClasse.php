

<?php
// configuration
include('../connexion/conn.php');
// new data
if(isset($_POST['updateClasse'])){

$id = $_POST['id'];
$a = $_POST['code_classe'];
$b = $_POST['category_classe'];
$c = $_POST['name_classe'];
// query
$sql = "UPDATE classe 
        SET code_classe=?,cate_classe=?,classe_name=? WHERE classe_id=?";
$q = $bdd->prepare($sql);
$q -> execute(array($a,$b,$c,$id));   
header("location: ../classes/classe.php");

}
?>