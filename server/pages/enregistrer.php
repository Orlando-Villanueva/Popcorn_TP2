<?php  
    $prenom = $_POST['inputPrenom'];
    $title = "Bienvenue, $prenom!";
    //$pageEnregistrer
    
    include '../../includes/header-new.php';
 
?>

<!-- to do -->
<div class="container mt-3">
    <?php

require_once '../../db/connexion.inc.php';

$nom = $_POST['inputNom'];
$prenom = $_POST['inputPrenom'];
$email = $_POST['inputEmail'];
$sexe = $_POST['inputSexe'];
$date = $_POST['inputDate'];
$photo = "";
$motDePasse = $_POST['inputPassword'];


$membre  = new Membre(0,$nom,$prenom,$email,$sexe,$date,$photo,$motDePasse,1,"M");

$crudMembre->ajouterMembre($membre);
$membre->idMembre = $pdo->lastInsertId();
$crudMembre->ajouterConnexion($membre);

echo ("Bienvenue sur PopcornTV.ca, $prenom ($email) ".$membre->idMembre);
           
            ?>
</div>

<?php  include '../../includes/footer-membre.php'?>