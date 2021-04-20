<?php
function commentaire($dbh){
if(array_key_exists('auteur', $_POST) && array_key_exists('commentaire', $_POST)){
    $auteur =$_POST['auteur'];
    $commentaire =$_POST['commentaire'];
    $dateCommentaire =  date("Y-m-d"); 
    $id=$_GET['id'];
Commentaire ::insertCommentaire($dbh , $id,$auteur,$commentaire,$dateCommentaire);}
}
