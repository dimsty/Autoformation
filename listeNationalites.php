<?php
include "header.php";

require_once('connectionDb.php');
$libelle ="";
$continentSel="Tous";
//Construction de la requete
$texteReq="select n.num, n.libelle as 'libNation', c.libelle as 'libContinent'  from nationalite n, continent c where n.numContinent=c.num";
if(!empty($_GET)){
    $libelle=$_GET['libelle'];
    $continentSel=$_GET['continent'];
    if( $libelle != "") { $texteReq.= " and n.libelle like '%" .$libelle."%'";}
    if( $continentSel != "Tous") { $texteReq.= " and c.num =" .$continentSel;}
}
$texteReq.= " order by n.libelle";
var_dump($_GET);
$req = $myDb->prepare($texteReq);
$req->setFetchMode(PDO::FETCH_OBJ);

$req->execute();
$lesNationalites = $req->fetchAll();
//liste des continents
$reqContinent = $myDb->prepare("select * from continent");
$reqContinent->setFetchMode(PDO::FETCH_OBJ);
$reqContinent->execute();
$lescontinents=$reqContinent->fetchAll();
if (!empty($_SESSION['message'])) {
    $mesMessages = $_SESSION['message'];
    foreach ($mesMessages as $key => $message) {
        echo '<div class="container pt-5">
        <div class="alert alert-' . $key . ' alert-dismissible fade show" role="alert">' . $message . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      </div>';
    }

    $_SESSION['message'] = [];
}

?>

<div class="container mt-5">
    <div class="row pt-3">
            <div class="col-9"><h2>Liste des nationalités</h2></div>
            <div class="col-3"><a href="formNationalite.php?action=Ajouter" class="btn btn-success"><i class="fas fa-plus-circle"></i> Créer une nationalité</a></div>
        </div>




    <form action="#" method="get" class="border border-primary rounded p-3 mt-3 mb-3">
<div class="row">
    <div class="col">
    <input type="text" class="form-control" id="libelle" placeholder="Saisir le libellé" name="libelle" value="<?php echo $libelle; ?>">
    </div>
    <div class="col">
    <select name="continent" class="form-control">
        <?php 
        echo "<option value=\"Tous\">Tous les continents</option>";
        foreach($lescontinents as $continent){
            $selection=$continent->num == $continentSel ? 'selected' : '';
            echo "<option value=\"$continent->num\" $selection>$continent->libelle</option>";
        }
        ?>
    </select>
    </div>
    <div class="col">
        <button type="submit" class="btn btn-success btn-block">Rechercher</button>
    </div>
</div>
</form>


    <table class="table table-hover table-striped table-dark">
        <thead>
            <tr class="d-flex">
                <th scope="col" class="col-md-2">Numéro</th>
                <th scope="col" class="col-md-5">Libellé</th>
                <th scope="col" class="col-md-3">Continent</th>
                <th scope="col" class="col-md-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($lesNationalites as $nationalite) {
                echo "<tr class=\"d-flex\">";
                echo "<td class=\"col-md-2\">$nationalite->num</td>";
                echo "<td class=\"col-md-5\">$nationalite->libNation</td>";
                echo "<td class=\"col-md-3\">$nationalite->libContinent</td>";
                echo "<td class=\"col-md-1\">
    <a href=\"formNationalite.php?action=Modifier&num=$nationalite->num\" class=\"btn btn-primary\"><i class=\"fas fa-pen\"></i></a>
    </td>
    <td class=\"col-md-0\">
    <a href=\"#modalSuppression\" data-toggle=\"modal\" data-message=\"Voulez vous supprimer cette nationalité ?\"data-suppression=\"supprimerNationalite.php?num=$nationalite->num\" class=\"btn btn-danger\"><i class=\"far fa-trash-alt\"></i></a>
    </td>";
                echo "<tr>";
            }
            ?>

        </tbody>
    </table>

</div>

<?php
include "footer.php";


?>