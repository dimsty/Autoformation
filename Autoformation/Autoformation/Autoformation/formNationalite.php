<?php 
include "header.php";


$libelle= filter_input(INPUT_GET, 'libelle');
$action = $_GET['action']; // soit ajouter ou modifier
if($action == 'Modifier'){
    require_once('connectionDb.php');
$num=$_GET['num'];
$req = $myDb->prepare("select * from nationalite where num=:num");
$req->setFetchMode(PDO::FETCH_OBJ);
$req->bindParam(':num', $num);

$req->execute();
$laNationalite=$req->fetch();
}

?>

<div class="container mt-5">
<h2 class="pt-3 text-center"><?= $action ?> une nationalité</h2>

<form action="validFormNationalite.php?action=<?=$action?>" method="post" class="col-md-6 offset-md-3 border border-primary p-3 rounded">
<div class="form-group">
    <label for="libelle">Libellé</label>
    <input type="texte" class="form-control" id="libelle" placeholder="Saisir le libellé" name="libelle" value="<?php if($action == 'Modifier'){echo $laNationalite->libelle;}?>">
</div>
<input type="hidden" id="num" name="num" value="<?php if($action == 'Modifier'){echo $laNationalite->num;}?>">
<div class="row">
    <div class="col"><a href="listeNationalites.php" class="btn btn-warning btn-block">Revenir a la liste</a></div>
    <div class="col">
        <button type="input" class="btn btn-success btn-block"><?= $action?></button></div>
</div>
</form>
</div>
<?php 
include "footer.php";

?>
