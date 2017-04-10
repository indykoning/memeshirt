<?php
error_reporting(0);
$expire = 365*24*3600;
ini_set('session.gc_maxlifetime', $expire);
require_once "includes/config.php";
require_once  "includes/db.php";
require_once 'classes/Login.php';
require_once "includes/Mollie/API/Autoloader.php";
$sql = "SELECT * FROM `prijzen` WHERE id=1";
$result = $mysqli->query($sql);
$prijzen = $result->fetch_assoc();
define('PRIJS_XS', $prijzen['XS']);
define('PRIJS_S', $prijzen['S']);
define('PRIJS_M', $prijzen['M']);
define('PRIJS_L', $prijzen['L']);
define('PRIJS_XL', $prijzen['XL']);
define('PRIJS_XXL', $prijzen['XXL']);

//var_dump(PRIJS_XXL, PRIJS_XL, PRIJS_L, PRIJS_M, PRIJS_S, PRIJS_XS);
$mollie = new Mollie_API_Client;
$mollie->setApiKey('test_xH9fTegKwsMPtQzvc9z7x9fspJeJSx');

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$login = new Login('users', 'id', 'email', 'wachtwoord', 'key');
if(isset($_POST['register'])){
    if ($_POST['wachtwoord']===$_POST['wachtwoord_hh']) {
        if(!$login->register($_POST['email'], $_POST['wachtwoord'], array("voornaam" => $_POST['voornaam'], "achternaam" => $_POST['achternaam'], "straatnaam" => $_POST['straatnaam'], "huisnummer" => $_POST['huisnummer'], "postcode" => $_POST['postcode'], "plaatsnaam" => $_POST['plaatsnaam'], "rank" => 0))){
            echo "<h1 style='color: red'>Er is iets fout gegaan met het registreren, als dit vaker voorkomt neem contact op</h1>";
        }
    }else{
        echo "<h1 style='color: red'>De wachtwoorden komen niet overeen</h1>";
    }
}
if(isset($_POST['login'])){
    if(!$login->login($_POST['email'],$_POST['wachtwoord'])){
        echo "<h1 style='color: red; margin-top: 60px'>Gebruikersnaam of wachtwoord incorrect</h1>";
    }else{
        header('Location:home');
    }}
if (isset($_GET['logout'])){
    $login->logout();
}
define('LOGGED_IN', $login->loggedin(['rank']));
//var_dump($login->getArray());
define('rank', $login->getArray()['rank']);



include_once "views/private/head.php";
include_once "views/private/header.php";
include_once "views/private/nav.php";
if(file_exists('views/'. $action . '.php')){
    include_once 'views/'. $action . '.php';
} else
{
    include_once 'views/private/404.php';
}
include_once "views/private/footer.php";


