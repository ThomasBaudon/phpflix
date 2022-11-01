<!-- ------------------------- TRAITEMENT ------------------------------- -->



<?php require_once './inc/init.php'; ?>


<?php 
    if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
        session_destroy();
        header('location:index.php');
    }

    if($_POST){


        if(!empty($_POST['pseudo'])){
            // si le pseudo n'est pas vide, je fais une requête pour récupérer les infos envoyées en POST
            // Vérification si le pseudo est enregistré dans la BDD
            $req = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

            // si le rowCount() supérieur à 1 alors il y'a un user qui a ce pseudo
            if($req->rowCount() >=1)
            {
                // $membre renvoie le résultat dans un tableau
                $membre = $req->fetch(PDO::FETCH_ASSOC); // Je fetch pour récupérér les infos dans un tableau

                // je vérifie si le mdp envoyé en POST correspond au mdp que j'ai dans mon tableau $membre qui contient les infos du membre
                if(password_verify($_POST['mdp'], $membre['mdp'])){

                    // Je créé une sessions que j'appelle 'membre' pour stocker les infos de l'user
                    $_SESSION['membre']['id_membre']= $membre['id_membre'];
                    $_SESSION['membre']['pseudo']= $membre['pseudo'];
                    $_SESSION['membre']['nom']= $membre['nom'];
                    $_SESSION['membre']['prenom']= $membre['prenom'];
                    $_SESSION['membre']['photo']= $membre['photo'];
                    $_SESSION['membre']['email']= $membre['email'];
                    $_SESSION['membre']['civilite']= $membre['civilite'];
                    $_SESSION['membre']['adresse']= $membre['adresse'];
                    $_SESSION['membre']['zip']= $membre['zip'];
                    $_SESSION['membre']['ville']= $membre['ville'];
                    $_SESSION['membre']['statut']= $membre['statut'];

                    header('location:profil.php');

                }
                else{
                    $error .= '<div class="alert alert-danger">Mot de passe incorrect</div>';
                }
            }
            else{
                $error .= '<div class="alert alert-danger">Identifiants incorrects</div>';
            }
            
        }

    }

?>

<?php require_once './inc/header.inc.php'; ?>
    <div class="container">
        <img src="./img/phpflix-logo.svg" alt="phpflix logo" class="logo">
        <h1>Regardez des futurs dev’ <br> se planter lamentablement !</h1>

        <div class="form-container">

            

            <!-- FORMULAIRE -->
            <form method="POST" action="">
                
                <div class="input-container">
                    <label for="pseudo">Votre pseudo ou adresse mail</label>
                    <input type="text" name="pseudo" id="pseudo" class="input">
                </div>
                <div class="input-container">
                    <label for="mdp">Votre mot de passe</label>
                    <input type="password" name="mdp" id="mdp" class="input">
                </div>
                <?php echo $content;?>
                <?php echo $error;?>
                <div class="input-container">
                    <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous</a></p> 
                </div>
                <div class="input-container">
                    <button type="submit" id="submit" class="submit">SE CONNECTER</button>
                </div>

            </form>
        </div>
        
    </div>

    <?php require_once('./inc/footer.inc.php'); ?>