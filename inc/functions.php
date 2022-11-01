<?php 

function userConnected(){
    if(isset($_SESSION['membre'])){
        return true;
    }else{
        return false;
    }
}

function isAdmin(){
    if(userConnected() && $_SESSION['membre']['statut'] == 1){
        return true;
    }else{
        return false;
    }
}

?>