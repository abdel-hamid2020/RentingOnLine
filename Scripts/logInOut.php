<?php

function logIn($dbh) {
    if (array_key_exists('login', $_POST) && array_key_exists('mdp', $_POST)) {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $user = Utilisateur :: getUtilisateur($dbh, $login);
        if ((!$user == null) && $user->testerMdp($dbh, $login, $mdp)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['login'] = $login;
        }
        else{ 
            echo"<h3 style='text-align: center ;color :red'> <span style='border: rgb(252,217,218) 1px solide;background-color:rgb(252,217,218)' >login ou mot de pass incorrecte</span></h3>";
        }
    } 
}

function logOut() {
    $_SESSION['loggedIn'] = false;
    unset($_SESSION['login']);
}
