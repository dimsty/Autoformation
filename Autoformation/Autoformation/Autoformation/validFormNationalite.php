<?php
include "header.php";

require_once('connectionDb.php');
$action = $_GET['action'];
$libelle = $_POST['libelle'];
$num=$_POST['num'];

if($action == 'Modifier'){
  $req = $myDb->prepare("update nationalite set libelle = :libelle where num = :num");
  $req->bindParam(':libelle', $libelle);
  $req->bindParam(':num', $num);
  echo "update nationalite set libelle = $libelle where num = $num";
}
else{
  $req = $myDb->prepare("insert into nationalite(libelle) values(:libelle)");
$req->bindParam(':libelle', $libelle);

}
$nb = $req->execute();

$message = $action == "Modifier" ? "modifiée" : "ajoutée";

echo "<div class=\"container mt-5\">";
echo "<div class=\"row\">
<div class=\"col\">";



if ($nb == 1) {
    echo "<div class=\"alert alert-success mt-5\" role=\"alert\">
    La nationalité a bien été $message
</div>";
} else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">
  La nationalité n'a pas bien été $message
</div>";
}
?>
</div>
</div>
<a href="listeNationalites.php" class="btn btn-primary"> Revenir à la liste des nationalités</a>

<?php
include "footer.php";


?>