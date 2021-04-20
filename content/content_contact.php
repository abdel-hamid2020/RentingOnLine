<?php
if(array_key_exists('name', $_POST)&& array_key_exists('numero', $_POST)&& array_key_exists('sujet', $_POST)&&array_key_exists('message', $_POST)){
    $name=$_POST['name'];
    $telephone=$_POST['numero'];
    $sujet = $_POST['sujet'];
    $message= $_POST['message'];
    $datemessage= date("Y-m-d");
    $result=Contact::insertContact($dbh,$name,$telephone,$sujet,$message,$datemessage);
    if($result){
        echo"<p class ='successMessage'>Nous avons reçu votre message nous nous chargerons de vous répondre dans les meilleurs délais.</P>";
    }
    else{
        echo "<p class = 'errorMessage'>Erreur lors de l'envoi de message</p>";
    }
}
PrintFormConatct($askedPage);