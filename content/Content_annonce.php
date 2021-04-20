<?php
$data = ['Nouakchott' , 'Nouadhibou','Kiffa','Néma','Aioune','Zouerat','Kaédi','Rosso','Aleg','Atar','Adel Bagrou','Akjoujt','Aioun El Atrouss','Bababé','Bareina','Boghé','Bennechab','Boutilimit','Chinguetti','Choum','Djiguenni','Fassale','Mbahé','Noubaghiya','Oualata','Sélibabi','Tichitt','Tidjikdja','Timbedra','Tintane'];
$valid = false;
$essay = false;
if (isset($_POST["titre"]) && $_POST["titre"] != "" &&
        isset($_POST["prix"]) && $_POST["prix"] != "" &&
        isset($_POST["adresse"]) && $_POST["adresse"] != "" &&
        isset($_POST["ville"]) && $_POST["ville"] != "") {
          $essay = true; 
        $isvalideVille = Annonce::isVille($data, $_POST["ville"]);
        if($isvalideVille){
    if (isset($_FILES["file"]) && $_FILES['file']['size']>0) {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileNamenew = Annonce::imageTrait($dbh, $fileName, $fileTmp, $fileSize, $fileError);
    } else {
        $fileNamenew = null;
    }
    if (isset($_FILES["file1"])&&$_FILES['file1']['size']>0)  {
        $file1 = $_FILES['file1'];
        $fileName1 = $_FILES['file1']['name'];
        $fileTmp1 = $_FILES['file1']['tmp_name'];
        $fileType1 = $_FILES['file1']['type'];
        $fileSize1 = $_FILES['file1']['size'];
        $fileError1 = $_FILES['file1']['error'];
        $fileNamenew1 = Annonce::imageTrait($dbh, $fileName1, $fileTmp1, $fileSize1, $fileError1);
    } else {
        $fileNamenew1 = null;
    }
    if (isset($_FILES["file2"])&&$_FILES['file2']['size']>0) {
        $file2 = $_FILES['file2'];
        $fileName2 = $_FILES['file2']['name'];
        $fileTmp2 = $_FILES['file2']['tmp_name'];
        $fileType2 = $_FILES['file2']['type'];
        $fileSize2 = $_FILES['file2']['size'];
        $fileError2 = $_FILES['file2']['error'];
        $fileNamenew2 = Annonce::imageTrait($dbh, $fileName2, $fileTmp2, $fileSize2, $fileError2);
    } else {
        $fileNamenew2 = null;
    }
     
    $valid = Annonce:: insererAnnonce($dbh, $_POST["titre"], $_POST["prix"], $_POST["categorie"], $_POST["adresse"], $_POST["ville"], $_POST["espace"], $_POST["description"], $fileNamenew, $fileNamenew1, $fileNamenew2);
}
        }



if ($valid)
    echo "<h3 style=' text-align: center ;color :green'>Votre annonce a été deposé</h3>";

// 
if ($valid == false) {
    if($essay==true){ echo "<h3 style=' text-align: center ;color :red'> une erreur c'est produite, assurer vous que la ville existe parmis les villes proposer</h3>";}
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        echo <<<END
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
           <div style="background-color : rgb(237,237,237)">
            <form method="POST" action="index.php?page=annonce" enctype="multipart/form-data">
                <h3 class="text-center"><i>Annonce</i></h3>

                <fieldset>
                    <legend>Deposer votre annonce</legend>
                    <div class="form-group col-md-6">
                        <label for="titre">Titre<span style= "color:red">*</span></label>
                        <input type="text" class="form-control" name="titre" id="titre" placeholder="titre" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prix">Prix<span style= "color:red">*</span></label>
                        <input type="number" class="form-control" name="prix" id="prix" placeholder="prix" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ville">Ville<span style= "color:red">*</span></label>
                        <input list="Villes" type="text" name="ville" class="form-control" id="ville" required>
                            <datalist id="Villes">
END;
                             for ($list = 0; !empty($data[$list]); $list++){
                                   echo '<option value="' .$data[$list]. '" >';
                             }
                           
                       echo<<<END
                           </datalist>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="adresse">Adresse<span style= "color:red">*</span></label>
                        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="adresse" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="categorie">categorie<span style= "color:red">*</span></label>
                        <select name="categorie" id="categorie" class="form-control" required>
                            <option value="">--chosir une categorie--</option>
                            <option value="Maison">Maison</option>
                            <option value="Appartemment">Appartemment</option>
                            <option value="Bureau">Bureau</option>
                            <option value="Boutique">Boutique</option>
                            <option value="Hotel">Hotel</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="espace">Espace<span style= "color:red">*</span></label>
                        <input type="number" class="form-control" name="espace" id="espace" placeholder="espace" required>
                    </div>
                   


                    <div class="form-group col-md-12">
                        <label for="description">Description<span style= "color:red">*</span></label>
                        <textarea name="description" id = "description" rows="8" cols="45" class="form-control" required>
                        </textarea>
                    </div>


              
                    Ajouter des photos
        <div class="form-group col-md-6">
          <label for="photo">Ajouter la photo principale <span style= "color:red">*</span></label>
                <input type="file"  id="photo" name="file" required/>
        </div>
        <div class="form-group col-md-6">
                <input type="file" name="file1"/>
        </div>
        <div class="form-group col-md-6">
                <input type="file" name="file2"/>
        </div>
        <p style= "color:red" > Tous les champs en  (*) sont obligatoires </p>
         </fieldset>
        
                <div class="form-group">
                    <div class="col-md-12" style="background-color : rgb(237,237,237)">
                        <button type="submit" class="btn btn-primary">
                            valider
                        </button>
                    </div>
                    
                </div>

            </form>
        </div>
       </div>
    </div>
</div>
END;
    } else {
        echo <<<END
        <div class="container">
             <div class="row">
                 <div class="col-md-6 col-md-offset-2">
                     <div style="border: rgb(247,247,247) 5px inset;padding: 5px; background-color : rgb(248,248,248)">
                        <h3  class ="h3 mb-3"><i>Bonjour !</i></h3><br>
                        <p><i>Connectez-vous ou créez un compte pour deposer votre annonce</i> </p><br>
                        <button class = "btn btn-outline-success" type = "button" role="link" onClick = "window.location='index.php?page=connection'">se connecter</button>
                        <button class = "btn btn-outline-success" type = "button" role="link" onClick = "window.location='index.php?page=register'">créer un compte</button>
                     </div>
                 </div>
             </div>
        </div>
        
END;
    }
}
