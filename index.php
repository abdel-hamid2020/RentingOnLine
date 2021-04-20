<?php
session_name("nsession");
session_start();
$url='css/perso.css';
require ('classes/classannoce.php');
require ('Scripts/utils.php');
require ('classes/donner.php');
require ('classes/classuser.php');
require ('classes/classcomment.php');
require ('classes/classcontact.php');
require ('Scripts/logInOut.php');
require ('Scripts/commentaire.php');
require 'Scripts/printForms.php';
$dbh = Database::connect();
if (isset($_GET['page'])) {
    $askedPage = $_GET['page'];
} else {
    $askedPage = 'Accueil';
}
if(array_key_exists('todo',$_GET)&& $_GET['todo'] == 'login'){
    logIn($dbh);
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
        $askedPage = 'Accueil';
    }
}
if(array_key_exists('todo',$_GET)&& $_GET['todo'] == 'logout'){
   logOut();
}
if(array_key_exists('todo',$_GET)&& $_GET['todo'] == 'commentaire'){
   commentaire($dbh);
}


$authorized = chekPage($askedPage);
if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $pageTitle = "Accueil";
}
generateHTMLHeader($pageTitle);
generateMenu();
require "content/content_$askedPage.php";

if (isset($_GET['page'])) {
    if($askedPage == 'Accueil'){generateHTMLFooter();}
}
else {
generateHTMLFooter();}