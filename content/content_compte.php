<?php 
if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])){
     echo <<<END
        <div class="container">
             <div class="row">
              <div class='form-group'>
                       <div style="border: rgb(247,247,247) 5px inset;padding: 5px; background-color : rgb(248,248,248)">
                        <h3  class ="h3 mb-3 ">Bonjour !</h3><br>
                        <p>Connectez-vous ou créez un compte </p><br>
                        <button class = "btn btn-outline-success" type = "button"> <a class = "nav-link" href = "index.php?page=connection">se connecter</a></button>
                        <button class = "btn btn-outline-success" type = "button"><a <a class = "nav-link" href = "index.php?page=register">crée ton compte</a></button>
                     </div>
                 </div>
             </div>
        </div>
        
END;
}
else{
$suc = false;
$pr = false;
$tell=false;
if(array_key_exists('mdp', $_POST)&&array_key_exists('mdp1', $_POST)&&array_key_exists('mdp2', $_POST)&&$_POST['mdp1']!=''&&$_POST['mdp1']==$_POST['mdp2']){
    $user = Utilisateur::getUtilisateur($dbh, $_SESSION['login']);
    if(!$user == null){
        if($user->testerMdp($dbh, $_SESSION['login'], $_POST['mdp'])){
            $suc = $user->chngerMdp($dbh, $_SESSION['login'],$_POST['mdp1']);
            echo "<h3 style=' text-align: center ;color :green'>Votre mot de passe a été mis à jour </h3>";
        }
    }
}
if(array_key_exists('prix', $_POST)&&$_POST['prix']!=''){
    $pr = Annonce::updatePrix($dbh ,$_GET['titre'],$_GET['id'], $_POST['prix']) ;
    echo "<h3 style=' text-align: center ;color :green'>Le prix a été mis à jour</h3>";
}
if(array_key_exists('telephone', $_POST)&&$_POST['telephone']!=''){
    $tell = Utilisateur::changernum($dbh, $_SESSION["login"],$_POST['telephone']);
    echo "<h3 style=' text-align: center ;color :green'>Votre numero a été mis à jour</h3>";
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'update' && $suc==false){
    printUpdateMdp($askedPage);
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'tel' && $tell==false){
    PrintupdateNum($askedPage);
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'updatePrix' && $pr==false){
   PrintupdatePrix($askedPage);
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'Supcmp'&&!isset($_GET['login'])){
    $user=Utilisateur::getUtilisateur($dbh, $_SESSION["login"]);
     Annonce::supprimerAnnonceT($dbh,$user->id);
    Utilisateur::deletUtilisateur($dbh, $_SESSION["login"]);
    logOut();
    echo "<h3 style=' text-align: center ;color :green'>Votre compte a été supprimé! Au revoir! </h3>";
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'Supcmp' &&isset($_GET['login'])){
    $user=Utilisateur::getUtilisateur($dbh, $_GET['login']);
     Annonce::supprimerAnnonceT($dbh,$user->id);
    Utilisateur::deletUtilisateur($dbh,$_GET['login']);
    echo "<h3 style=' text-align: center ;color :green'>Ce compte a été supprimé </h3>";
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'Supcmt'){
    $id = $_GET['id'];
    Commentaire::deleteCommentaire($dbh , $id);
    echo "<h3 style=' text-align: center ;color :green'>Ce commentaire a eté supprimer</h3>";
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'Supann'){
     $user=Utilisateur::getUtilisateur($dbh, $_SESSION['login']);
    Annonce::supprimerAnnonce($dbh, $_GET['titre'],$_GET['id'],$user->id);
    echo "<h3 style=' text-align: center ;color :green'>Votre annonce a été supprimée</h3>";
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'SupannAD'){
    Annonce::supprimerAnnonceAD($dbh, $_GET['titre'],$_GET['id']);
    echo "<h3 style=' text-align: center ;color :green'>Cette annonce a été supprimée</h3>";
}
if(isset($_GET['todo'])&& $_GET['todo'] == 'admine'){
    
   $user = Utilisateur :: getUtilisateur($dbh ,$_SESSION["login"]);
   if($user->admin==1){
       if(array_key_exists('id',$_POST)){
           Contact::etatmessage($dbh , $_POST['id']);
       }
     echo<<<END
       <div class="container-fluid">
    <div class="row">
END;
        echo"<div class='col-md-4'>";
         echo<<<END
            <div class="CentreMessage">
            <span class="messageClic"></span>
END;
            echo"<div class='voirplusMessage'>";
        Contact::affichemessage($dbh) ;
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo"<div class='col-md-4'>";
        echo<<<END
            <div class="LesAnnonces">
            <span class="annonceClic"></span>
END;
            echo"<div class='voirplusAnnonce'>";
       
       Annonce::afficheAnnonceAD($dbh);
       echo '</div>';
        echo '</div>';
         echo '</div>';
       echo"<div class='col-md-4 '>";
       echo<<<END
            <div class="LesCompte">
            <span class="compteClic"></span>
            END;
            echo"<div class='voirplusCompte'>";
       
       Utilisateur:: afficheCompte($dbh);
       echo '</div>';
        echo '</div>';
         echo '</div>';
          echo '</div>';
           echo '</div>';
   }
   else{
       echo <<<END
       <div class="not_authorized" id="content"><div id="column-txt"><h1 style="font-size: 160px; font-weight: 600; line-height: 130px;color: #00a34d; margin: 0;">403</h1><h2>Accès refusé</h2><p class="h1">Désolé, vous n'êtes pas autorisé à afficher cette page ,cette page est reservée aux admins. </p></div></div>
       END;
   }
}
if(!isset($_GET['todo'])){
      
echo<<<End
       
       <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="col-sm-4 col-md-4 col-4 col-lg-4">
            <h4><i><strong> Mon Profile</strong></i></h4>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-lock2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM7 6a1 1 0 0 1 2 0v1H7V6zm3 0v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V8.3c0-.627.46-1.058 1-1.224V6a2 2 0 1 1 4 0z"/>
</svg><button  class = "btn btn-success" type = "submit" role="link" onClick = "window.location='index.php?page=compte&&todo=update'"><i>changer mon mot de pass</i></button><br><br>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
</svg><button  class = "btn btn-success" type = "submit" role="link" onClick = "window.location='index.php?page=compte&&todo=tel'"><i>  changer mon numero</i></button><br><br>
           <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
</svg> <button  class = "btn btn-danger" type = "submit" role="link" onClick = "window.location='index.php?page=compte&&todo=Supcmp'"><i>Supprimer mon Compte</i></button><br><br>
             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 .5c-.662 0-1.77.249-2.813.525a61.11 61.11 0 0 0-2.772.815 1.454 1.454 0 0 0-1.003 1.184c-.573 4.197.756 7.307 2.368 9.365a11.192 11.192 0 0 0 2.417 2.3c.371.256.715.451 1.007.586.27.124.558.225.796.225s.527-.101.796-.225c.292-.135.636-.33 1.007-.586a11.191 11.191 0 0 0 2.418-2.3c1.611-2.058 2.94-5.168 2.367-9.365a1.454 1.454 0 0 0-1.003-1.184 61.09 61.09 0 0 0-2.772-.815C9.77.749 8.663.5 8 .5zm.5 7.415a1.5 1.5 0 1 0-1 0l-.385 1.99a.5.5 0 0 0 .491.595h.788a.5.5 0 0 0 .49-.595L8.5 7.915z"/>
</svg><button  class = "btn btn-warning" type = "submit" role="link" onClick = "window.location='index.php?page=compte&&todo=admine'"><i>Etes vous admin ?</i></button>
     
    </div>
End;
$user = Utilisateur :: getUtilisateur($dbh ,$_SESSION["login"]);
echo<<<End

        <div class="col-sm-8 col-md-8 col-8 col-lg-8" >
        <button class = 'button'><i><strong>Mes Annoces</strong></i></button>
            
End;
       $user = Utilisateur :: getUtilisateur($dbh ,$_SESSION['login']);
        Annonce :: afficheAnnonceID($dbh , $user->id);
        
          echo ' </div>';
        echo ' </div>';
        echo ' </div>';
echo ' </div>';}
}