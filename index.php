<?php
//require_once 'classes/Login.php';
$action = isset($_GET['page']) ? $_GET['page'] : '';
//$login = new Login('users', 'id', 'email', 'wachtwoord', 'key');
//if(!empty($_POST['registreren'])){
//    $login->register($_POST['voornaam'], $_POST['achternaam'], $_POST['wachtwoord'],$_POST['telefoon'], $_POST['e-mail'], $_POST['naam-organisatie'], $_POST['website'], $_POST['type'], $_POST['plaats']);
//}
//if (isset($_GET['logout'])){
//    $login->logout();
//}
//define('LOGGED_IN', $login->loggedin());
if($action != ''){
if(file_exists('views/'. $action . '.php')){
include_once 'views/'. $action . '.php';
}else{
include_once 'views/404.php';
}
}else{
    include_once 'views/home.php';
}
include_once "views/footer.php";