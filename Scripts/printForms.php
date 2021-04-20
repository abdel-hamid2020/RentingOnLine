
<?php
function printLoginForm($askedPage) {
    echo<<<CHAINE_DE_FIN
     
     <div id="logreg-forms">
        <form action='index.php?page=$askedPage&todo=login' method='post' class='form-signin' >
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Bonjour!</h1>
            <p style="text-align:center">
Connectez-vous pour découvrir toutes nos fonctionnalités. </p>
            <input type='text' id='inputLogin' class='form-control' placeholder='login' name = 'login' required='' autofocus=''>
            <input type='password' id='inputPassword' class='form-control' placeholder='Password' name = 'mdp' required=''>
            <input type="checkbox" onclick="miFunction()"> voir mot de passe
            <script>
           function miFunction() {
             var x = document.getElementById("inputPassword");
             if (x.type === "password") {
               x.type = "text";
             } else {
               x.type = "password";
             }
           }
           </script>
            <button class='btn btn-success btn-block' type='submit'><i class='fas fa-sign-in-alt'></i> Connection</button>
            
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <button class="btn btn-primary btn-block" type="button" id="btn-signup" role="link" onClick = "window.location='index.php?page=register'"><b class="fas fa-user-plus" >cree un compte</b></button>
            </form>
            </div>
CHAINE_DE_FIN;
}
function printUpdateMdp($askedPage) {
    echo<<<CHAINE_DE_FIN
     <div id="logreg-forms">
        <form action='index.php?page=$askedPage&todo=update' method='post' class='form-signin'>
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Mettre votre mot de passe à jour!</h1>
           <input type='password' id='inputPassword' class='form-control' placeholder='Mot de passe actuel' name = 'mdp' required=''>
            <input type='password'  class='form-control' placeholder='mot de pass' name = 'mdp1' required=''>
            <input type='password'  class='form-control' placeholder='confirmer mot de pass' name = 'mdp2' required=''>
            <button class='btn btn-success btn-block' type='submit'><i class='fas fa-sign-in-alt'></i> Valider</button>
            </form>
            </div>
CHAINE_DE_FIN;
}
 function PrintupdatePrix($askedPage) {
     $ti = $_GET['titre'];
     $id= $_GET['id'];
         echo<<<CHAINE_DE_FIN
     <div id="logreg-forms">
        <form action='index.php?page=$askedPage&&todo=updatePrix&&titre=$ti&&id=$id' method='post' class='form-signin'>
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Modiffier le prix de votre annonce!</h1>
           <input type='number' id='inputPassword' class='form-control' placeholder='nouvelle prix' name = 'prix' required=''>
                 
           <button class='btn btn-success btn-block' type='submit'><i class='fas fa-sign-in-alt'></i> Valider</button>
            </form>
           </div>
    CHAINE_DE_FIN;
    }

    function PrintupdateNum($askedPage) {
         echo<<<CHAINE_DE_FIN
     <div id="logreg-forms">
        <form action='index.php?page=$askedPage&&todo=updatetel' method='post' class='form-signin'>
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Mettre à jour votre numero!</h1>
           <input type='number' class='form-control' placeholder='nouvelle numero' name = 'telephone' required=''>
                 
           <button class='btn btn-success btn-block' type='submit'><i class='fas fa-sign-in-alt'></i> Valider</button>
            </form>
           </div>
    CHAINE_DE_FIN;
    }
    
    function PrintCommentaire($id){
         echo<<<END
            <div class="zonecommentaireMasquer">
            <span class="Clic"></span>
            <div class='deposercommentaire'>
            <form  method="POST" action="index.php?page=Accueil&&todo=commentaire&&id=$id">
            <label for="auteur=$id">Auteur</label>
            <input type="text" class="form-control" name="auteur" id="auteur=$id" placeholder="nom de l'auteur" required>
            <label for="commentaire=$id">Commentaire</label>
            <textarea name="commentaire" id = "commentaire=$id" rows="3" cols="45" class="form-control" required>
            </textarea><br>
            <button type="submit" class="btn btn-primary">
                                Envoyer
            </button>
            </form>
            </div>
            </div>
            END;
    }
    function PrintFormConatct($askedPage) {
        echo<<<END
        <div id="box">
		  <form id="form" action="index.php?page=$askedPage" onsubmit="return validate()" method="post">
		    <h3>Formulaire de contact</h3>
		   
		    <input type="text" id="name" name="name" placeholder="Nom"/>
		    <input type="number" id="numero" name="numero" placeholder="Numero"/>
		    <input type="text" id="subject" name="sujet" placeholder="Demande de renseignement"/>
		    <textarea id="message" name="message" placeholder="Message..."></textarea>
		    <input type="submit" value="Envoyer le message"/>
END;   
		 echo"</form>";
           echo"</div>";
}
   