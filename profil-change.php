<!-- ------------------------- TRAITEMENT ------------------------------- -->
<?php
require_once './inc/init.php';

if(!userConnected()){
    header('location:index.php');
    // exit() stoppe l'exécution du code
    exit();
}

$id_membre = $_SESSION['membre']['id_membre'];
$detailMembre = $pdo->query("SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]'");
$infoMembre = $detailMembre->fetch(PDO::FETCH_ASSOC);

if(isAdmin()){
    $content .= '<div class="success" role="alert">Vous êtes connecté en tant que <span class="red">ADMIN</span></div>';

    $id_membre = $infoMembre['id_membre'];
    $civilite = $infoMembre['id_membre'];
    $nom = $infoMembre['nom'];
    $prenom = $infoMembre['prenom'];
    $pseudo = $infoMembre['pseudo'];
    $mail = $infoMembre['email'];
    $adresse = $infoMembre['adresse'];
    $zip = $infoMembre['zip'];
    $ville = $infoMembre['ville'];
    $statut = $infoMembre['statut'];
    $photo = $infoMembre['photo'];

}else{
    $content = '<div class="success" role="alert">Vous êtes connecté en tant que <span class="green">MEMBRE</span></div>';

    $id_membre = $infoMembre['id_membre'];
    $civilite = $infoMembre['id_membre'];
    $nom = $infoMembre['nom'];
    $prenom = $infoMembre['prenom'];
    $pseudo = $infoMembre['pseudo'];
    $mail = $infoMembre['email'];
    $adresse = $infoMembre['adresse'];
    $zip = $infoMembre['zip'];
    $ville = $infoMembre['ville'];
    $statut = $infoMembre['statut'];
    $photo = $infoMembre['photo'];

}


if(!empty($_POST)){
    $pdo->query("UPDATE membre SET nom='$_POST[nom]',
                                prenom='$_POST[prenom]',
                                civilite='$_POST[civilite]',
                                pseudo='$_POST[pseudo]',
                                photo='$photo',
                                email='$_POST[mail]',
                                adresse='$_POST[adresse]',
                                zip='$_POST[zip]',
                                ville='$_POST[ville]'
                                WHERE id_membre = '$_GET[id_membre]'");

    header("location:profil.php");
}


?>


<!-- ------------------------- AFFICHAGE ------------------------------- -->
<?php
  require_once('./inc/header.inc.php');
?>

<div class="container">

    <div class="container-avatar">
        <img src="<?php echo $photo; ?>" alt="" width="100" class="roundedPhoto">
        <h1 class="profil-title">Bienvenue <?php echo $prenom; ?> !</h1>
    </div>

    <div class="profil-container">
        
            <?php echo $content; ?>

            <div class="profil-info-container">
                <div class="profil-form-container">
                <!-- FORMULAIRE -->
                    <form method="POST" action="" enctype="multipart/form-data" class="col2">
        
                        <div class="columns" value="<?php echo $id_membre; ?>">
                                
                            <!-- genre -->
                            <div class="input-container">
                                <input type="hidden">
                                <label for="civilite"><span class="info-title">Civilité</span></label>
        
                                <select name="civilite" id="civilite">
                                    

                                        <option <?php if($civilite == 'm') echo "selected";?> value="m">Mr</option>
                                        <option <?php if($civilite == 'f') echo "selected";?> value="f">Mme</option>
                                        <option <?php if($civilite == 'else') echo "selected";?> value="else">Non genré</option>
                                </select>
                            </div>
                
                            
                            <!-- nom -->
                            <div class="input-container">
                                <label for="nom">Votre nom</label>
                                <input type="text" name="nom" id="nom" class="input" value="<?php echo $nom; ?>">
                            </div>
        
                
                                    <!-- prenom -->
                                    <div class="input-container">
                                        <label for="prenom">Votre prénom</label>
                                        <input type="text" name="prenom" id="prenom" class="input" value="<?php echo $prenom; ?>">
                                    </div>
                
                
                                    <!-- pseudo -->
                                    <div class="input-container">
                                        <label for="pseudo">Votre pseudo</label>
                                        <input type="text" name="pseudo" id="pseudo" class="input" value="<?php echo $pseudo; ?>">
                                    </div>
                

                                </div>
                                <div class="columns">
                
                
                                        <!-- email -->
                                    <div class="input-container">
                                        <label for="mail">Votre mail</label>
                                        <input type="email" name="mail" id="mail" class="input" value="<?php echo $mail; ?>">
                                    </div>
                

                
                
                                    <!-- adresse -->
                                    <div class="input-container">
                                        <label for="adresse">Votre adresse</label>
                                        <input type="text" name="adresse" id="adresse" class="input" value="<?php echo $adresse; ?>">
                                    </div>
                
                
                                    <!-- code postal -->
                                    <div class="input-container">
                                        <label for="zip">Votre code postal</label>
                                        <input type="text" name="zip" id="zip" class="input" value="<?php echo $zip; ?>">
                                    </div>
                
                
                                    <!-- ville -->
                                    <div class="input-container">
                                        <label for="ville">Votre ville</label>
                                        <input type="text" name="ville" id="ville" class="input" value="<?php echo $ville; ?>">
                                    </div>
                                
                                </div>
                                <!-- photo -->
                                <div class="input-container profil-photo-container">
                                <!--<label for="photo" class="label-file">Votre photo de profil</label>-->

                                <?php
                                
                                if(!empty($photo)){
                                    echo "<input type=\"file\" id=\"photo\" name=\"photo\" class=\"input-file\" value=\"$photo\">";
                                    echo "<img src=\"$photo\" width='50'>";
                                }else{
                                    echo "<input type=\"hidden\" class=\"form-control\" name=\"photo\" value=\"$photo\">";
                                }
                                ?>

                                    
                                </div> <br>
                
                                <!-- submit -->
                                <div class="input-container" id="submit-container">
                                    <input type="submit" id="submit" class="submit" value="VALIDER LES MODIFICATIONS">
                                </div>
                
                            </form>
                        </div>
            </div>
    </div>
</div>



</div>


<?php
    require_once('./inc/footer.inc.php');
?>