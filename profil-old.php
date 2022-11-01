<!-- ------------------------- TRAITEMENT ------------------------------- -->
<?php
require_once './inc/init.php';

if(!userConnected()){
    header('location:index.php');
    // exit() stoppe l'exécution du code
    exit();
}

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

?>

<!-- ------------------------- AFFICHAGE ------------------------------- -->
<?php
  require_once('./inc/header.inc.php');
?>



<div class="container">

    <h1 class="profil-title">Bonjour <?php echo $prenom; ?> !</h1>

    <div class="profil-container">
        <img src="<?php echo $imageProfil; ?>" alt="" width="100" class="roundedPhoto">
        <?php echo $content; ?>

        <div class="profil-info-container">


            <?php

            if(isset($_GET['action']) && $_GET['action'] == 'update'){
                if(!empty($_POST)){
                    $pdo->query("UPDATE membre SET nom='$_POST[nom]',
                                                prenom='$_POST[prenom]',
                                                civilite=$_POST[civilite]',
                                                pseudo='$_POST[pseudo]',
                                                photo='$_POST[photo]',
                                                email='$_POST[email]',
                                                adresse='$_POST[adresse]',
                                                zip='$_POST[zip]',
                                                ville='$_POST[ville]' WHERE id_membre = '$_GET[id_membre]'");

                    header("location:profil.php");
                }

            }
            
            
            if (isset($_GET['action']) && $_GET['action'] == 'modification') {
                        $r = $pdo->query("SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]'");
                        $membre_actuel = $r->fetch(PDO::FETCH_ASSOC);
                        


                echo "
                <div class=\"profil-form-container\">
                <!-- FORMULAIRE -->
                            <form method=\"POST\" action=\"\" enctype=\"multipart/form-data\" class=\"col2\">
                
                                <div class=\"columns\">
                                       
                                    <!-- genre -->
                                    <div class=\"input-container\">
                                        <label for=\"civilite\">Civilité</label>
                
                                        <select name=\"civilite\" id=\"civilite\">

                                                <option"; if ($civilite == 'm') echo " selected"; echo ">Mr</option>
                                                <option"; if ($civilite == 'f') echo " selected"; echo ">Mme</option>
                                                <option"; if ($civilite == 'else') echo " selected"; echo ">Non genré</option>
                                        </select>
                                    </div>
                
                
                                    <!-- nom -->
                                    <div class=\"input-container\">
                                        <label for=\"nom\">Votre nom</label>
                                        <input type=\"text\" name=\"nom\" id=\"nom\" class=\"input\" value=\"$nom\">
                                    </div>
                
                
                                    <!-- prenom -->
                                    <div class=\"input-container\">
                                        <label for=\"prenom\">Votre prénom</label>
                                        <input type=\"text\" name=\"prenom\" id=\"prenom\" class=\"input\" value=\"$prenom\">
                                    </div>
                
                
                                    <!-- pseudo -->
                                    <div class=\"input-container\">
                                        <label for=\"pseudo\">Votre pseudo</label>
                                        <input type=\"text\" name=\"pseudo\" id=\"pseudo\" class=\"input\" value=\"$pseudo\">
                                    </div>
                
                                    <!-- mdp -->
                                    <!--<div class=\"input-container\">
                                        <label for=\"mdp\">Votre mot de passe</label>
                                        <input type=\"password\" name=\"mdp\" id=\"mdp\" class=\"input\" value=\"mot de passe\">
                                    </div>-->

                                </div>
                                <div class=\"columns\">
                
                
                                        <!-- email -->
                                    <div class=\"input-container\">
                                        <label for=\"mail\">Votre mail</label>
                                        <input type=\"email\" name=\"mail\" id=\"mail\" class=\"input\" value=\"$mail\">
                                    </div>
                

                
                
                                    <!-- adresse -->
                                    <div class=\"input-container\">
                                        <label for=\"adresse\">Votre adresse</label>
                                        <input type=\"text\" name=\"adresse\" id=\"adresse\" class=\"input\" value=\"$adresse\">
                                    </div>
                
                
                                    <!-- code postal -->
                                    <div class=\"input-container\">
                                        <label for=\"zip\">Votre code postal</label>
                                        <input type=\"text\" name=\"zip\" id=\"zip\" class=\"input\" value=\"$zip\">
                                    </div>
                
                
                                    <!-- ville -->
                                    <div class=\"input-container\">
                                        <label for=\"ville\">Votre ville</label>
                                        <input type=\"text\" name=\"ville\" id=\"ville\" class=\"input\" value=\"$ville\">
                                    </div>
                                
                                </div>
                                <!-- photo -->
                                <div class=\"input-container\ profil-photo-container\">
                                <!--<label for=\"photo\" class=\"label-file\">Votre photo de profil</label>-->";

                                    if(!empty($photo)){
                                        echo "<input type=\"file\" id=\"photo\" name=\"photo\" class=\"input-file\" value=\"$photo\">";
                                        echo "<img src=\"$photo\" width='32'>";
                                    } else{
                                        echo "<input type=\"hidden\" class=\"form-control\" name=\"photo\" value=\"$photo\">";
                                    }
                                echo "</div> <br>
                
                                <!-- submit -->
                                <div class=\"input-container\" id=\"submit-container\">
                                    <a id=\"submit\" class=\"submit\" href=\"?action=update&id_membre=$id_membre\">VALIDER MODIFICATIONS</a>
                                </div>
                
                            </form>
                        </div>
                
                
                ";


                // ================>>>>>>>>> INSERT INTO BDD // UPDATE BDD
                    
                }
                else
                {
                echo "
                    <hr>
                    <div class=\"profil-form-container\">
                        <div class=\"columns\">
                            <p class=\"hidden\"> <span class=\"info-title\">Id :</span> <br>$id_membre</p>
                            <p> <span class=\"info-title\">Nom :</span> <br>$nom</p>
                            <p> <span class=\"info-title\">Prénom :</span> <br>$prenom</p>
                            <p> <span class=\"info-title\">Civilité :</span> <br>";
                            // $civilite
                            switch($civilite){
                                case($civilite == 'm') : echo 'Homme';
                                break;
                                case($civilite == 'f') : echo 'Femme';
                                break;
                                case($civilite == 'else') : echo 'Non défini';
                                break;
                            }
                            echo "</p>
                            <p> <span class=\"info-title\">Mail :</span> <br>$mail</p>
                        </div>
                        <span class=\"sepo\"></span>
                        <div class=\"columns\">
                            <p> <span class=\"info-title\">Adresse :</span> <br>$adresse</p>
                            <p> <span class=\"info-title\">Code postal :</span> <br>$zip</p>
                            <p> <span class=\"info-title\">Ville :</span> <br>$ville</p>
                            <p> <span class=\"info-title\">Statut :</span> <br>";
                            // $statut
                            if(isset($statut) && $statut == 1){
                                echo "Administrateur";
                            }else{
                                echo "Membre";
                            }
                           echo "</p>
                        </div>
                    </div>
                        <hr>
                        <a class=\"change-profil-button\" type=\"button\" href=\"?action=modification&id_membre=$id_membre\">Modifier mon profil</a> 
                    
                    ";
            }?>

        </div>
   
    </div>

</div>
    
    
<?php
    require_once('./inc/footer.inc.php');
?>