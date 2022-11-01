<!-- ------------------------- TRAITEMENT ------------------------------- -->
<?php
require_once './inc/init.php';

if(!userConnected()){
    header('location:index.php');
    // exit() stoppe l'exécution du code
    exit();
}

// $id_membre = $_SESSION['membre']['id_membre'];
// $detailMembre = $pdo->query("SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]'");
// $infoMembre = $detailMembre->fetch(PDO::FETCH_ASSOC);

if(isAdmin()){
    $content .= '<div class="success" role="alert">Vous êtes connecté en tant que <span class="red">ADMIN</span></div>';

    $id_membre = $_SESSION['membre']['id_membre'];
    $civilite = $_SESSION['membre']['civilite'];
    $nom = $_SESSION['membre']['nom'];
    $prenom = $_SESSION['membre']['prenom'];
    $pseudo = $_SESSION['membre']['pseudo'];
    $imageProfil = $_SESSION['membre']['photo'];
    $mail = $_SESSION['membre']['email'];
    $adresse = $_SESSION['membre']['adresse'];
    $zip = $_SESSION['membre']['zip'];
    $ville = $_SESSION['membre']['ville'];
    $statut = $_SESSION['membre']['statut'];
    $photo = $_SESSION['membre']['photo'];

}else{
    $content = '<div class="success" role="alert">Vous êtes connecté en tant que <span class="green">MEMBRE</span></div>';

    $id_membre = $_SESSION['membre']['id_membre'];
    $civilite = $_SESSION['membre']['civilite'];
    $nom = $_SESSION['membre']['nom'];
    $prenom = $_SESSION['membre']['prenom'];
    $pseudo = $_SESSION['membre']['pseudo'];
    $imageProfil = $_SESSION['membre']['photo'];
    $mail = $_SESSION['membre']['email'];
    $adresse = $_SESSION['membre']['adresse'];
    $zip = $_SESSION['membre']['zip'];
    $ville = $_SESSION['membre']['ville'];
    $statut = $_SESSION['membre']['statut'];
    $photo = $_SESSION['membre']['photo'];
}

if (isset($_GET['action']) && $_GET['action'] == 'modification') {
    header("location:profil-change.php?action=modification&id_membre=$id_membre");
}

?>

<!-- ------------------------- AFFICHAGE ------------------------------- -->
<?php
  require_once('./inc/header.inc.php');
?>

<div class="container">

    <div class="container-avatar">
        <img src="<?php echo $imageProfil; ?>" alt="" width="100" class="roundedPhoto">
        <h1 class="profil-title">Bienvenue <?php echo $prenom; ?> !</h1>
    </div>
   

    <div class="profil-container">
        
            <?php echo $content; ?>

                <div class="profil-info-container">
                    <div class="profil-form-container">
                        <div class="columns">
                            <p class="hidden"> <span class="info-title">Id :</span> <br><?php echo $id_membre;?></p>
                            <p> <span class="info-title">Nom :</span> <br><?php echo $nom;?></p>
                            <p> <span class="info-title">Prénom :</span> <br><?php echo $prenom;?></p>
                            <p> <span class="info-title">Civilité :</span> <br>
    
                            <?php  // $civilite
                                switch($civilite){
                                    case($civilite == 'm') : echo 'Homme';
                                    break;
                                    case($civilite == 'f') : echo 'Femme';
                                    break;
                                    case($civilite == 'else') : echo 'Non défini';
                                    break;
                            };?>

                            </p>
                            <p> <span class="info-title">Mail :</span> <br><?php echo $mail;?></p>
                        </div>


                        <span class="sepo"></span>
                        <div class="columns">
                            <p> <span class="info-title">Adresse :</span> <br><?php echo $adresse;?></p>
                            <p> <span class="info-title">Code postal :</span> <br><?php echo $zip;?></p>
                            <p> <span class="info-title">Ville :</span> <br><?php echo $ville;?></p>
                            <p> <span class="info-title">Statut :</span> <br>
                            <?php
                                // $statut
                                if(isset($statut) && $statut == 1){
                                    echo "Administrateur";
                                }else{
                                    echo "Membre";
                                };?>
                            </p>
                        </div>
                </div>
                <hr> 
                <a class="change-profil-button" type="button" href="?action=modification&id_membre=<?php echo $id_membre;?>">Modifier mon profil</a> 

        <div class="profil-info-container">
        </div>
        </div>
    </div>
</div>

<?php
    require_once('./inc/footer.inc.php');
?>
