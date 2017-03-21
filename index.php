<?php
error_reporting(0);
require_once "includes/config.php";
require_once  "includes/db.php";

require_once 'classes/Login.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$login = new Login('users', 'id', 'email', 'wachtwoord', 'key');
if(!empty($_POST['registreren'])){
    $login->register($_POST['email'],$_POST['wachtwoord'], array("voornaam"=>$_POST['voornaam'], "achternaam"=>$_POST['achternaam'], "straatnaam"=>$_POST['straatnaam'], "huisnummer"=>$_POST['huisnummer'], "postcode"=>$_POST['postcode'], "plaatsnaam"=>$_POST['plaatsnaam'],"rank"=>0));
}
if(!empty($_POST['login'])){
    $login->login($_POST['email'],$_POST['wachtwoord']);
}
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


