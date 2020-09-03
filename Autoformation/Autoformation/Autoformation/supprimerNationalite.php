<?php
include "header.php";

require_once('connectionDb.php');
$num = $_GET['num'];



  $req = $myDb->prepare("delete from nationalite where num = :num");
  $req->bindParam(':num', $num);

$nb = $req->execute();

echo "<div class=\"container mt-5\">";
echo "<div class=\"row\">
<div class=\"col\">";



if ($nb == 1) {
    echo "<div class=\"alert alert-success mt-5\" role=\"alert\">
    La nationalité a bien été supprimée
</div>";
} else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">
  La nationalité n'a pas bien été supprimée
</div>";
}
?>
</div>
</div>
<a href="listeNationalites.php" class="btn btn-primary"> Revenir à la liste des nationalités</a>

<?php
include "footer.php";


?>