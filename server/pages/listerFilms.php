<?php
$title = "Liste des membres";
$root = "../../";
//$lister = true;
include '../../includes/header.php';
require_once '../../db/connexion.inc.php';


if(isset($_GET["titre"])){
 
   
    $result= $crud->getMoviesTitre($_GET["titre"]);
    

}else{
$result = $crud->getMovies();
}
//$result = $result->fetchAll();
?>

<div id="contListMembre" class="container mt-5">
    <h1 class="h1 text-center">Liste des films</h2>
    <div class="input-group mb-3">
        <a id="btnAjouterFilm" class="btn btn-outline-success bg-gradient">Ajouter un film</a>        

    
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Titre</span>
            </div>   

            <form  action="./listerFilms.php" method="GET">
            <input type="sumbit" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="titre" value="">
          
            </form>
        

    </div>

        <table class="table table-striped table-hover table-borderless">
            <thead class="table-success">             
                <th scope="col">ID</th>
                <th scope="col">titre</th>
                <th scope="col">duree</th>
                <th scope="col">langue</th>
                <th scope="col">date</th>
                <th scope="col">montant</th>
                   <!-- <th scope="col">photo</th> -->
                <th scope="col">Actions

                </th>
            </thead>
            <tbody>
                <?php 
        while($r = $result->fetch(PDO::FETCH_ASSOC)) { 
           ?>
                <tr>
                    <td><?php echo $r['idFilm']?></td>
                    <td><?php echo $r['titre']?></td>
                    <td><?php echo $r['duree']?></td>
                    <td><?php echo $r['langue']?></td>
                    <td><?php echo $r['date']?></td>
                    <td><?php echo $r['montant']?></td>
                <!-- <td><?php echo $r['photo']?></td>-->
                    <td>
                        <div class="btn-group">
                            
                            <form  action="./updateFilmPage.php" method="GET">
                            <input type="hidden" name="idFilm" value="<?php echo $r['idFilm']?>">                
                            <input class="btn bg-gradient btn-outline-warning"  type="submit"value="Update"><br><br>
                          
                            </form>
                          
                            <a href='deleteFilm.php?idFilm=<?php echo $r['idFilm']?>' class="btn bg-gradient btn-outline-danger">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="container">
            <a id="btnRetour" class="btn btn-success bg-gradient" href="../../admin.php">Retour</a>
        </div>
</div>


<!-- Form ajouter un film-->
<div id="contAddFilm" class="container mt-5">
    <h1 class="h1 text-center">Ajouter un film</h1>
    <form id="formRegister" class="row" action="ajouterFilm.php" method="POST" onSubmit="return validerFilm()">

        <div class="col-md-6 mt-3">
            <div class="form-group">
                <label for="inputTitre" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="inputTitre" name="inputTitre" value="">
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="form-group">
                <label for="inputReal" class="form-label">Réalisateur :</label>
             
               
                <input list="brow">
                <datalist id="brow">
                <?php
                    $cat = $crud->getAllRealisateurs();                    
                    while($c = $cat->fetch(PDO::FETCH_ASSOC)){                        
                        $rep.="<option value='".$c["idRealisateur"]."'>".$c["nom"]."</option>";                         
                        
                    }?>   
                    <?php echo $rep?>
                </datalist>  
               


            </div>
        </div>

        <div class="col-6 mt-3">
            <div class="form-group">
                <label for="inputDate">Date de sortie :</label>
                <input type="text" class="form-control" id="inputDate" name="inputDate">
            </div>
        </div>

        <div class="col-6 mt-3">
            <div class="form-group">
                <label for="InputLangue">Langue :</label>
                <select class="form-control" id="InputLangue" name="langue">
                    <option value="1">Français</option>
                    <option value="2">Anglais</option>
                    <option value="3">Espagnol</option>
                    <?php //while($r = $results->fetch(PDO::FETCH_ASSOC)) {?>
                    <!-- <option value="<?php //echo $r['langue_id'] ?>"><?php //echo $r['name']; ?></option> -->
                    <?php //}?>

                </select>
            </div>
        </div>

        <div class="col-6 col-sm-4 mt-3">
            <div class="form-group">
                <label for="inputCout">Coût :</label>
                <input type="text" class="form-control" id="inputCout" name="inputCout">
            </div>
        </div>

        <div class="col-6 col-sm-4 mt-3">
            <div class="form-group">
                <label for="inputDure">Durée :</label>
                <input type="text" class="form-control" id="inputDure" name="inputDure">
            </div>
        </div>

        <div class="col-sm-4 mt-3">
            <div class="form-group">
                <label for="inputCat">Catégorie :</label>
                <select class="form-control" id="inputCat" name="inputCat">
                   <?php

                    $cat = $crud->getAllCategories();

                     while($c = $cat->fetch(PDO::FETCH_ASSOC)){ ?>

                        <option value="<?php echo $c['idCategorie'] ?>"><?php echo $c['nomCategorie']  ?></option>

                        <?php } ?>
                        
                </select>
            </div>
        </div>
        <div class="col-12 mt-3">
            <label for="formFile" class="form-label">Poster pour le film (image) :</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <br>
        <div class="col-12 mt-3">
            <label for="descriptionText" class="form-label">Description du film :</label>
            <textarea id="descriptionText" name="descriptionText" class="form-control" rows="3"></textarea>
        </div>
        <div class="col-12 mt-3">
            <button id="btnAddFilm" type="submit" class="btn btn-success bg-gradient">Ajouter</button>

        </div>
    </form>
    <button id="btnAnnulerAddFilm" class="btn btn-danger bg-gradient mt-2">Annuler</button>
</div>


<!-- MODAL -->

<!--FIn MODAL -->






<?php
function getStatut($statut)
{
if ($statut == 0) {
    return "inactif";
} else return "actif";
}
function getRole($role)
{

if ($role == 'A')
    return "Admin";
else if ($role == 'M')  return "Membre";
}

?>

<?php
include '../../includes/footer.php';
?>