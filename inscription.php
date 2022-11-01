<?php
/* TRAITEMENT */

require_once('./inc/init.php');



if($_POST){

    /* Je rajoute des antislashs devant les caractères spéciaux */
    foreach($_POST as $key => $infos_membre){
        $_POST[$key] = htmlspecialchars(addslashes($infos_membre));
    }

    // VARIABLES
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];


    /* ----------------------------------------------------------------------------->>>>>>>> PSEUDO */
    // Définir que le pseudo doit contenir entre 3 et 20 caractères
    if(strlen($pseudo) <3 || strlen($pseudo) > 20){
        $error = "<div>
                    <p class=\"alert\"> ATTENTION, votre pseudo doit contenir entre 3 et 20 caractères</p>
                </div>";
    }

    // Vérification des caractères autorisés (regex)
    $regExPattern = '#^[a-zA-Z0-9._-]+$#';
    if(!preg_match($regExPattern, $pseudo)) {
        $error .= "<div>
                        <p class=\"alert\"> ATTENTION, votre pseudo ne doit contenir que des lettres ou des chiffres</p>
                    </div>";
    }

    // Vérification de la disponibilité du pseudo dans la BDD
    $r = $pdo->query("SELECT * FROM membre WHERE pseudo = '$pseudo'");
    if($r->rowCount() >= 1) {
        $error .= "<div>
                        <p class=\"alert\"> ATTENTION, ce pseudo est déjà utilisé</p>
                    </div>";
    }

    


    /* ----------------------------------------------------------------------------->>>>>>>> MOT DE PASSE */
    // Définir que le MDP doit contenir entre 3 et 20 caractères
    if(strlen($mdp) <3 || strlen($mdp) > 20){
        $error = "  <div>
                        <p class=\"alert\"> ATTENTION, votre mot de passe doit contenir entre 3 et 20 caractères</p>
                    </div>";
    }
    // Vérification des caractères autorisés (regex)
    if(!preg_match($regExPattern, $mdp)) {
        $error .= " <div>
                        <p class=\"alert\"> ATTENTION, votre pseudo ne doit contenir que des lettres ou des chiffres</p>
                    </div>";
    }
    /* Hashage du MdP */
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    
    /* ----------------------------------------------------------------------------->>>>>>>> PHOTO */

    if (!empty($_FILES['photo'])) {

        $nom_img = time().'_'.$_POST['pseudo'] . '_' . $_FILES['photo']['name'];

        define("BASE", $_SERVER['DOCUMENT_ROOT'] . '/phpflix/');
        $img_doc = BASE . "avatars/$nom_img";

        $img_bdd = "http://". URL . "avatars/$nom_img";

        if ($_FILES['photo']['size'] <= 8000000) {
            $data = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

            $tabExt =['jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF','Jpg','Png','Jpeg','Gif'];

            if (in_array($data, $tabExt)) {
                copy($_FILES['photo']['tmp_name'], $img_doc);
            } else {
                $error .= '<div class="alert" role="alert">Format non autorisé</div>';
            }
        } else {
            $error .= '<div class="alert" role="alert">Vérifier si votre image fait moins de 8Mo</div>';
        }
    }


    /* --------------------------------------------------------------------------------------------------------------------------- */
    /* ----------------------------------------------------------------------------->>>>>>>> INSERTION DANS LA BDD */
    /* --------------------------------------------------------------------------------------------------------------------------- */
    if(empty($error)){
        $pdo->query("INSERT INTO membre (civilite,nom,prenom,pseudo,photo,mdp,email,adresse,zip,ville) VALUES ('$_POST[civilite]','$_POST[nom]','$_POST[prenom]','$_POST[pseudo]','$img_bdd','$mdp','$_POST[mail]','$_POST[adresse]','$_POST[zip]', '$_POST[ville]')");

        $content = "<div>
                    <p class=\"success\"> Bravo, vous êtes inscrit, connectez-vous dès maintenant !</p>
                </div>";

                header('location:index.php');
    }else{
        $error = "<div>
                        <p class=\"alert\"> Erreur, remplissez correctement tous les champs correctement !</p>
                    </div>";
    }


        // $test = $pdo->query("SELECT * from membre");
        // echo print_r($test);




}

/* HEADER */
require_once('./inc/header.inc.php');
?>

    <div class="container">
        <img src="./img/phpflix-logo.svg" alt="phpflix logo" class="logo2">
        <h1>Inscrivez-vous !</h1>

        <div class="form-container form-container2">


            <?php echo $content;?>
            <?php echo $error;?>

            <!-- FORMULAIRE -->
            <form method="POST" action="" enctype="multipart/form-data" class="col2">


                <div class="left">
                       
                    <!-- genre -->
                    <div class="input-container">
                        <label for="civilite">Civilité</label>

                        <select name="civilite" id="civilite">
                            <option selected>Votre Civilité</option>
                            <option value="m">Mr</option>
                            <option value="f">Mme</option>
                            <option value="else">Non genré</option>
                        </select>
                    </div>


                    <!-- nom -->
                    <div class="input-container">
                        <label for="nom">Votre nom</label>
                        <input type="text" name="nom" id="nom" class="input">
                    </div>


                    <!-- prenom -->
                    <div class="input-container">
                        <label for="prenom">Votre prénom</label>
                        <input type="text" name="prenom" id="prenom" class="input">
                    </div>


                    <!-- pseudo -->
                    <div class="input-container">
                        <label for="pseudo">Votre pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" class="input">
                    </div>

                    <!-- mdp -->
                    <div class="input-container">
                        <label for="mdp">Votre mot de passe</label>
                        <input type="password" name="mdp" id="mdp" class="input">
                    </div>


                    
                </div>

                <div class="right">


                        <!-- email -->
                    <div class="input-container">
                        <label for="mail">Votre mail</label>
                        <input type="email" name="mail" id="mail" class="input">
                    </div>

                    <!-- photo -->
                    <div class="input-container">
                        <label for="photo" class="label-file">Votre photo de profil</label>
                        <input type="file" id="photo" name="photo" class="input-file">
                    </div>


                    <!-- adresse -->
                    <div class="input-container">
                        <label for="adresse">Votre adresse</label>
                        <input type="text" name="adresse" id="adresse" class="input">
                    </div>


                    <!-- code postal -->
                    <div class="input-container">
                        <label for="zip">Votre code postal</label>
                        <input type="text" name="zip" id="zip" class="input">
                    </div>


                    <!-- ville -->
                    <div class="input-container">
                        <label for="ville">Votre ville</label>
                        <input type="text" name="ville" id="ville" class="input">
                    </div>
                    
                </div>

                <!-- submit -->
                <div class="input-container" id="submit-container">
                    <input type="submit" id="submit" class="submit" value="S’INSCRIRE">
                </div>

            </form>
        </div>
        
    </div>

    <?php require_once('./inc/footer.inc.php'); ?>