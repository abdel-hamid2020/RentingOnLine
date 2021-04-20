
<?php

$valid = false;
$tantative = false;
if (isset($_POST["login"]) && $_POST["login"] != "" &&
        isset($_POST["telephone"]) && $_POST["telephone"] != "" &&
        isset($_POST["up1"]) && $_POST["up1"] != "" &&
        isset($_POST["up2"]) && $_POST["up2"] != "") {

    if ($_POST["up1"] === $_POST["up2"]) {
        $tantative = true;
        $valid = Utilisateur :: insererUtilisateur($dbh, $_POST["login"], $_POST["up1"], $_POST["Nom"], $_POST["Prenom"], $_POST["telephone"]);
    }
}
if ($valid)
    echo "<h3 style=' text-align: center ;color :green'>Inscription réussie</h3>";
// 
else {
    if ($tantative) {
        echo "<h3 style=' text-align: center ;color :red'><span style='border: rgb(252,217,218) 1px solide;background-color:rgb(252,217,218)' >Login existant</span></h3>";
    } else {
        if (isset($_POST["login"])) {
            echo "<h3 style=' text-align: center ;color :red'><span style='border: rgb(252,217,218) 1px solide;background-color:rgb(252,217,218)' >Mots de passes inconformes</span></h3>";
        }
    }
    echo<<< END
<div class="container" >
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
              <div style="background-color : rgb(237,237,237)">
                  <h3 class="text-center"><i>Register</i></h3>
                <form class="#logreg-forms" method="POST" action="index.php?page=register" id="fiabiliteMotdePasse">
                    
                    <fieldset>
                        <legend><i>Account Details</i></legend>
                         <div class="form-group col-md-6">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" name="login" id="login" placeholder="login" required>
                        </div>
                         <div class="form-group col-md-6">
                            <label for="telephone">telephone</label>
                            <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="telephone" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Nom">Nom</label>
                            <input type="text" class="form-control" name="Nom" id="Nom" placeholder="Nom" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Prenom">Prenom</label>
                            <input type="text" class="form-control" name="Prenom" id="Prenom" placeholder="Prenom" required>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="password">Password (8 characters minimum)</label>
                            <input type="password" class="form-control" name="up1" id="password" placeholder="Password"  minlength="8" required>
                             <span id="affichageMessage"></span>
                             <input type="checkbox" onclick="myFunction()"> voir mot de passe
                            <script>
                           function myFunction() {
                             var x = document.getElementById("password");
                             if (x.type === "password") {
                               x.type = "text";
                             } else {
                               x.type = "password";
                             }
                           }
                           </script>
                           </div>

                        <div class="form-group col-md-6">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="up2" id="confirm_password" placeholder="Confirm Password" required >
                            <input type="checkbox" onclick="mFunction()"> voir mot de passe
                            <script>
                           function mFunction() {
                             var x = document.getElementById("confirm_password");
                             if (x.type === "password") {
                               x.type = "text";
                             } else {
                               x.type = "password";
                             }
                           }
                           </script>
                        </div>


                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" required>
                                    J'accepte les <a href="index.php?page=condition">termes et conditions</a>.
                                </label>
                            </div>
                        
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                            <a href="index.php?page=connection">Avez vous déjà un compte?</a>
                        </div>
                    </div>
                 </fieldset>
                </form>
            </div>
           </div>
        </div>
    </div>

END;
}



