<?php 

/* APPEL DE LA BDD */
$pdo = new PDO(
    "mysql:host=localhost;dbname=phpflix", "root", "root",
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    )
);

// APPEL FUNCTIONS
require_once('functions.php');

// VARIABLES GLOBALES
$content ='';
$error ='';

// Démarrage de la session
session_start();

// define('URL', 'localhost:8080/phpflix/');
define('URL', 'localhost/phpflix/');


?>