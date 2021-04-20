<?php

class Annonce {

    public $titre;
    public $prix;
    public $categorie;
    public $adresse;
    public $ville;
    public $espace;
    public $description;

    public function __construct($titre, $prix, $categorie, $adresse, $ville, $espace, $description) {
        $this->titre = $titre;
        $this->prix = $prix;
        $this->categorie = $categorie;
        $this->ville = $ville;
        $this->adresse = $adresse;
        $this->espace = $espace;
        $this->description = $description;
    }

    public function __toString() {
        return "[" . $this->titre . "]" . $this->prix . " " . $this->espace . " " . $this->categorie . " situe a " . $this->adresse . " a " . $this->ville;
    }
   //inseret une annoce dans le base de donner
    public static function insererAnnonce($dbh, $titre, $prix, $categorie, $adresse, $ville, $espace, $description, $fileName, $fileName1, $fileName2) {
        $login = $_SESSION['login'];
        $user = Utilisateur ::getUtilisateur($dbh, $login);
        $id = $user->id;
        $query = "INSERT INTO `annonce` (`titre`,`id`, `prix`, `categorie`, `adresse`, `ville`,`espace`,`description`,`img`,`img1`,`img2`) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($titre, $id, $prix, $categorie, $adresse, $ville, $espace, $description, $fileName, $fileName1, $fileName2));
        return ($sth->rowCount() == 1);
    }
    //verifier si une ville est dans l'ensemble des villes proposer
    public static function isVille($data , $ville){
        if(in_array($ville, $data)){
            return true;
        }
        else return false;
    }
     //supprimer une annonce
    public static function supprimerAnnonce($dbh, $titre, $id1,$id ) {
        $query = "DELETE FROM `annonce` WHERE titre = ? AND id1 = ? AND id = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($titre, $id1,$id));
        return ($sth->rowCount() == 1);
    }
    public static function supprimerAnnonceAD($dbh, $titre, $id ) {
        $query = "DELETE FROM `annonce` WHERE titre = ? AND id1 = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($titre, $id));
        return ($sth->rowCount() == 1);
    }
   //supprimer tous les annonce d'un utilisateur
    public static function supprimerAnnonceT($dbh, $id) {
        $query = "DELETE FROM `annonce` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
        return ($sth->rowCount() == 1);
    }
    //updatePrix
    public function updatePrix($dbh, $titre, $id, $prix) {
        $query = "UPDATE `annonce` SET `prix` =?  WHERE `titre` = ? AND `id1`= ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($prix, $titre, $id));
        return ($sth->rowCount() == 1);
    }
  //afficher les annonce dans page d'accueill
    public static function afficheAnnonce($dbh) {
        $query = "SELECT * FROM `annonce`";
        $sth = $dbh->prepare($query);
        $sth->execute();
        echo"<div class='container-fluid' id = 'bas'>";
       

        while ($ann = $sth->fetch()) {
            //$annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
            echo"<div class='form-group col-sm-3 col-md-8-col-lg-12'>";
            $img = htmlspecialchars($ann['img']);
            $img1 = htmlspecialchars($ann['img1']);
            $img2 = htmlspecialchars($ann['img2']);
            $id = htmlspecialchars($ann['id1']);
            echo <<<CHAINE_DE_FIN
            <div id="carouselExampleControls$id" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
     
  CHAINE_DE_FIN;
            if ($ann['img'] != null) {
                echo <<<CHAINE_DE_FIN
    <div class="carousel-item active">
      <img src="images/$img" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
            }
            if ($ann['img1'] != null) {
                echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img1" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
            }
            if ($ann['img2'] != null) {
                echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img2" class="d-block w-100" alt="photo de la maison">
    </div>
 CHAINE_DE_FIN;
            }
            echo <<<CHAINE_DE_FIN
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls$id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls$id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
CHAINE_DE_FIN;


            echo'<br>';
            print_r("<span class='glyphicon glyphicon-text-width'></span> <strong>titre</strong> :" . htmlspecialchars($ann['titre']));
            echo'<br>';
            print_r("<span class='glyphicon glyphicon-usd'></span> <strong>prix</strong> :" . htmlspecialchars($ann['prix']) . " MRU");
            echo'<br>';
            print_r(" <span class='glyphicon glyphicon-map-marker'></span> <strong>adresse</strong> :" . htmlspecialchars($ann['adresse']));
            echo'<br>';
            $user = Utilisateur::getUtilisateurID($dbh, $ann['id']);
            $idannonce=$ann['id1'];
           
            echo<<<END
            <div class="zoneTexteAfficherMasquer">
            <span class="inviteClic"></span>
            END;
            echo"<div class='voirplus'>";
            print_r("<span class='glyphicon glyphicon-user'></span><strong> Nom du proprietere </strong> :" . htmlspecialchars($user->nom));
            echo'<br>';
            print_r("<span class='glyphicon glyphicon-phone'></span> <strong>telephone </strong> :" . htmlspecialchars($user->telephone));
            echo'<br>';
            print_r("<span class='glyphicon glyphicon-stop'></span> <strong>espace </strong>:" . htmlspecialchars($ann['espace']) . " m²");
            echo'<br>';
            print_r("<span class='glyphicon glyphicon-home'></span><strong> ville </strong>:" . htmlspecialchars($ann['ville']));
            echo'<br>';
            print_r("<span class='glyphicon glyphicon-tags'></span> <strong>categorie </strong>:" . htmlspecialchars($ann['categorie']));
            echo'<br>';
            print_r("<span class='glyphicon glyphicon-comment'></span><strong> description </strong>:" . htmlspecialchars($ann['description']));
            echo"</div>";
            echo"</div>";
           
           PrintCommentaire($idannonce);
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
             Commentaire :: afficheCommentaire($dbh,$idannonce);
            echo  "</div>";
            echo  "</div>";
            echo "</div>";
        }
       

        echo"</div>";
    }
  //afficher l'annonce pour admin
    public static function afficheAnnonceAD($dbh) {
        $query = "SELECT * FROM `annonce`";
        $sth = $dbh->prepare($query);
        $sth->execute();
       
        while ($ann = $sth->fetch()) {
            //$annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
            echo"<div>";
            print_r("<img alt = 'photo de la maison' src = 'images/" . $ann['img'] . "'>");
            echo'<br>';
            print_r("titre :" . htmlspecialchars($ann['titre']));
            echo'<br>';
            print_r("prix :" . htmlspecialchars($ann['prix']) . " MRU");
            echo'<br>';
            print_r("adresse :" . htmlspecialchars($ann['adresse']));
            echo'<br>';
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
              $idannonce=$ann['id1'];
             Commentaire :: afficheCommentaireAd($dbh,$idannonce);
            
            echo  "</div>";
            echo  "</div>";
            $ti = $ann['titre'];
            $id = $ann['id'];
            echo<<< CHAINE_DE_FIN
            <button class = 'btn btn-outline-danger' type = 'submit' role='link' onClick = "window.location='index.php?page=compte&&todo=SupannAD&&titre=$ti&&id=$id'">Supprimer annonce</button>
CHAINE_DE_FIN;
               echo' <br>';
           echo' <br>';
           echo' <br>';
            echo "</div>";
        }
       
    }
    //afficher les annonce de l'utilisateur dans son espace personnele
    public static function afficheAnnonceID($dbh, $id) {
        $query = "SELECT * FROM `annonce` WHERE `id`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
       
        while ($ann = $sth->fetch()) {
            //$annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
            echo"<div class='form-group col-sm-12 col-md-12-col-lg-12'>";
            print_r("<img alt = 'photo de la maison' src = 'images/" . $ann['img'] . "'>");
            echo'<br>';
            print_r("titre :" . htmlspecialchars($ann['titre']));
            echo'<br>';
            print_r("prix :" . htmlspecialchars($ann['prix']) . " MRU");
            echo'<br>';
            print_r("adresse :" . htmlspecialchars($ann['adresse']));
            echo'<br>';


            echo'<br>';
            $ti = $ann['titre'];
            $id = $ann['id1'];
            echo<<< CHAINE_DE_FIN
            <svg width="1em" height='1em' viewBox='0 0 16 16' class='bi bi-pencil-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
             <path fill-rule='evenodd' d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
              </svg><button class = 'btn btn-outline-success' type = 'submit' role='link' onClick = "window.location= 'index.php?page=compte&&todo=updatePrix&&titre=$ti&&id=$id'">Modifier annonce</button>
CHAINE_DE_FIN;
            echo<<< CHAINE_DE_FIN
<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z'/>
</svg><button class = 'btn btn-outline-danger' type = 'submit' role='link' onClick = "window.location='index.php?page=compte&&todo=Supann&&titre=$ti&&id=$id'">Supprimer annonce</button>
CHAINE_DE_FIN;
            echo "</div>";
        }
        
    }
   //afficher les annonce apres une recherche
    public static function search($dbh) {
        if (isset($_GET['prix']) && $_GET['prix'] != "" && isset($_GET['localisation']) && $_GET['localisation'] != "" && isset($_GET['categorie']) && $_GET['categorie'] != "") {
            $prix = $_GET['prix'];
            $loc = $_GET['localisation'];
            $cat = $_GET['categorie'];
            $query = "SELECT * FROM `annonce` where `prix` <= $prix AND `ville` LIKE '$loc%' AND `categorie` LIKE '$cat%'";
            $sth = $dbh->prepare($query);
            $sth->execute();
            echo"<div class='container' id = 'bas'>";
            echo"<div class='row'>";
            while ($ann = $sth->fetch()) {
                $annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
                echo"<div class='form-group col-sm-3 col-md-8-col-lg-12'>";
                $img = htmlspecialchars($ann['img']);
                $img1 = htmlspecialchars($ann['img1']);
                $img2 = htmlspecialchars($ann['img2']);
                $id = htmlspecialchars($ann['id1']);
                echo <<<CHAINE_DE_FIN
            <div id="carouselExampleControls$id" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
     
  CHAINE_DE_FIN;
                if ($ann['img'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item active">
      <img src="images/$img" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img1'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img1" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img2'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img2" class="d-block w-100" alt="photo de la maison">
    </div>
 CHAINE_DE_FIN;
                }
                echo <<<CHAINE_DE_FIN
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls$id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls$id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
CHAINE_DE_FIN;
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-text-width'></span><strong> titre</strong> :" . htmlspecialchars($ann['titre']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-usd'></span><strong> prix </strong>:" . htmlspecialchars($ann['prix']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-map-marker'></span><strong>adresse </strong>:" . htmlspecialchars($ann['adresse']));
                echo'<br>';
                $user = Utilisateur::getUtilisateurID($dbh, $ann['id']);
                echo<<<END
            <div class="zoneTexteAfficherMasquer">
            <span class="inviteClic"></span>
            END;
                echo"<div class='voirplus'>";
                print_r("<span class='glyphicon glyphicon-user'></span><strong> Nom du proprietere  </strong>:" . htmlspecialchars($user->nom));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-phone'></span><strong> telephone  </strong>:" . htmlspecialchars($user->telephone));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-stop'></span> <strong>espace</strong> :" . htmlspecialchars($ann['espace']) . " m²");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-home'></span> <strong>ville </strong>:" . htmlspecialchars($ann['ville']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-tags'></span> <strong>categorie </strong>:" . htmlspecialchars($ann['categorie']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-comment'></span><strong> description </strong>:" . htmlspecialchars($ann['description']));
                echo"</div>";
                echo"</div>";
                $idannonce=$ann['id1'];
           PrintCommentaire($idannonce);
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
             Commentaire :: afficheCommentaire($dbh,$idannonce);
            echo  "</div>";
            echo  "</div>";

                echo "</div>";
            }
            echo"</div>";

            echo"</div>";
        } elseif (isset($_GET['prix']) && $_GET['prix'] != "" && isset($_GET['localisation']) && $_GET['localisation'] != "" && isset($_GET['categorie']) && !($_GET['categorie'] != "")) {
            $prix = $_GET['prix'];
            $loc = $_GET['localisation'];
            $query = "SELECT * FROM `annonce` where `prix` <= $prix AND `ville` LIKE '%$loc%' ";
            $sth = $dbh->prepare($query);
            $sth->execute();
            echo"<div class='container' id = 'bas'>";
            echo"<div class='row'>";
            while ($ann = $sth->fetch()) {
                $annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
                echo"<div class='form-group col-sm-3 col-md-8-col-lg-12'>";
                $img = htmlspecialchars($ann['img']);
                $img1 = htmlspecialchars($ann['img1']);
                $img2 = htmlspecialchars($ann['img2']);
                $id = htmlspecialchars($ann['id1']);
                echo <<<CHAINE_DE_FIN
            <div id="carouselExampleControls$id" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
     
  CHAINE_DE_FIN;
                if ($ann['img'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item active">
      <img src="images/$img" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img1'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img1" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img2'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img2" class="d-block w-100" alt="photo de la maison">
    </div>
 CHAINE_DE_FIN;
                }
                echo <<<CHAINE_DE_FIN
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls$id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls$id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
CHAINE_DE_FIN;
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-text-width'></span> titre :" . htmlspecialchars($ann['titre']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-usd'></span> prix :" . htmlspecialchars($ann['prix']) . " Ougiya");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-map-marker'></span> adresse :" . htmlspecialchars($ann['adresse']));
                echo'<br>';
                $user = Utilisateur::getUtilisateurID($dbh, $ann['id']);
                echo<<<END
            <div class="zoneTexteAfficherMasquer">
            <span class="inviteClic"></span>
            END;
                echo"<div class='voirplus'>";
                print_r("<span class='glyphicon glyphicon-user'></span> Nom du proprietere  :" . htmlspecialchars($user->nom));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-phone'></span> telephone  :" . htmlspecialchars($user->telephone));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-stop'></span> espace :" . htmlspecialchars($ann['espace']) . " m²");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-home'></span> ville :" . htmlspecialchars($ann['ville']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-tags'></span> categorie :" . htmlspecialchars($ann['categorie']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-comment'></span> description :" . htmlspecialchars($ann['description']));
                echo"</div>";
                echo"</div>";
                $idannonce=$ann['id1'];
           PrintCommentaire($idannonce);
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
             Commentaire :: afficheCommentaire($dbh,$idannonce);
            echo  "</div>";
            echo  "</div>";

                echo "</div>";
            }
            echo"</div>";

            echo"</div>";
        } elseif (isset($_GET['prix']) && $_GET['prix'] != "" && isset($_GET['categorie']) && $_GET['categorie'] != "" && isset($_GET['localisation']) && !($_GET['localisation'] != "")) {
            $prix = $_GET['prix'];
            $cat = $_GET['categorie'];
            $query = "SELECT * FROM `annonce` where `prix` <= $prix AND `categorie` LIKE '%$cat%' ";
            $sth = $dbh->prepare($query);
            $sth->execute();
            echo"<div class='container' id = 'bas'>";
            echo"<div class='row'>";
            while ($ann = $sth->fetch()) {
                $annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
                echo"<div class='form-group col-sm-3 col-md-8-col-lg-12'>";
                $img = htmlspecialchars($ann['img']);
                $img1 = htmlspecialchars($ann['img1']);
                $img2 = htmlspecialchars($ann['img2']);
                $id = htmlspecialchars($ann['id1']);
                echo <<<CHAINE_DE_FIN
            <div id="carouselExampleControls$id" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
     
  CHAINE_DE_FIN;
                if ($ann['img'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item active">
      <img src="images/$img" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img1'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img1" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img2'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img2" class="d-block w-100" alt="photo de la maison">
    </div>
 CHAINE_DE_FIN;
                }
                echo <<<CHAINE_DE_FIN
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls$id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls$id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
CHAINE_DE_FIN;
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-text-width'></span> titre :" . htmlspecialchars($ann['titre']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-usd'></span> prix :" . htmlspecialchars($ann['prix']) . " MRU");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-map-marker'></span> adresse :" . htmlspecialchars($ann['adresse']));
                echo'<br>';
                $user = Utilisateur::getUtilisateurID($dbh, $ann['id']);
                echo<<<END
            <div class="zoneTexteAfficherMasquer">
            <span class="inviteClic"></span>
            END;
                echo"<div class='voirplus'>";
                print_r("<span class='glyphicon glyphicon-user'></span> Nom du proprietere  :" . htmlspecialchars($user->nom));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-phone'></span> telephone  :" . htmlspecialchars($user->telephone));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-stop'></span> espace :" . htmlspecialchars($ann['espace']) . " m²");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-home'></span> ville :" . htmlspecialchars($ann['ville']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-tags'></span> categorie :" . htmlspecialchars($ann['categorie']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-comment'></span> description :" . htmlspecialchars($ann['description']));
                echo"</div>";
                echo"</div>";
                 $idannonce=$ann['id1'];
           PrintCommentaire($idannonce);
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
             Commentaire :: afficheCommentaire($dbh,$idannonce);
            echo  "</div>";
            echo  "</div>";

                echo "</div>";
            }
            echo"</div>";

            echo"</div>";
        } elseif (isset($_GET['categorie']) && $_GET['categorie'] != "" && isset($_GET['localisation']) && $_GET['localisation'] != "" && isset($_GET['prix']) && !($_GET['prix'] != "")) {
            $cat = $_GET['categorie'];
            $loc = $_GET['localisation'];
            $query = "SELECT * FROM `annonce` where `categorie` LIKE '%$cat%' AND `ville` LIKE '%$loc%' ";
            $sth = $dbh->prepare($query);
            $sth->execute();
            echo"<div class='container' id = 'bas'>";
            echo"<div class='row'>";
            while ($ann = $sth->fetch()) {
                $annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
                echo"<div class='form-group col-sm-3 col-md-8-col-lg-12'>";
                $img = htmlspecialchars($ann['img']);
                $img1 = htmlspecialchars($ann['img1']);
                $img2 = htmlspecialchars($ann['img2']);
                $id = htmlspecialchars($ann['id1']);
                echo <<<CHAINE_DE_FIN
            <div id="carouselExampleControls$id" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
     
  CHAINE_DE_FIN;
                if ($ann['img'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item active">
      <img src="images/$img" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img1'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img1" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img2'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img2" class="d-block w-100" alt="photo de la maison">
    </div>
 CHAINE_DE_FIN;
                }
                echo <<<CHAINE_DE_FIN
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls$id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls$id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
CHAINE_DE_FIN;
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-text-width'></span> titre :" . htmlspecialchars($ann['titre']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-usd'></span> prix :" . htmlspecialchars($ann['prix']) . " MRU");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-map-marker'></span> adresse :" . htmlspecialchars($ann['adresse']));
                echo'<br>';
                $user = Utilisateur::getUtilisateurID($dbh, $ann['id']);
                echo<<<END
            <div class="zoneTexteAfficherMasquer">
            <span class="inviteClic"></span>
            END;
                echo"<div class='voirplus'>";
                print_r("<span class='glyphicon glyphicon-user'></span> Nom du proprietere  :" . htmlspecialchars($user->nom));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-phone'></span> telephone  :" . htmlspecialchars($user->telephone));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-stop'></span> espace :" . htmlspecialchars($ann['espace']) . " m²");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-home'></span> ville :" . htmlspecialchars($ann['ville']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-tags'></span> categorie :" . htmlspecialchars($ann['categorie']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-comment'></span> description :" . htmlspecialchars($ann['description']));
                echo"</div>";
                echo"</div>";
                $idannonce=$ann['id1'];
           PrintCommentaire($idannonce);
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
             Commentaire :: afficheCommentaire($dbh,$idannonce);
            echo  "</div>";
            echo  "</div>";

                echo "</div>";
            }
            echo"</div>";

            echo"</div>";
        } elseif (isset($_GET['prix']) && $_GET['prix'] != "" && isset($_GET['localisation']) && !($_GET['localisation'] != "") && isset($_GET['categorie']) && !($_GET['categorie'] != "")) {
            $prix = $_GET['prix'];
            $query = "SELECT * FROM `annonce` where `prix` <= $prix";
            $sth = $dbh->prepare($query);
            $sth->execute();
            echo"<div class='container' id = 'bas'>";
            echo"<div class='row'>";
            while ($ann = $sth->fetch()) {
                $annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
                echo"<div class='form-group col-sm-3 col-md-8-col-lg-12'>";
                $img = htmlspecialchars($ann['img']);
                $img1 = htmlspecialchars($ann['img1']);
                $img2 = htmlspecialchars($ann['img2']);
                $id = htmlspecialchars($ann['id1']);
                echo <<<CHAINE_DE_FIN
            <div id="carouselExampleControls$id" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
     
  CHAINE_DE_FIN;
                if ($ann['img'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item active">
      <img src="images/$img" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img1'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img1" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img2'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img2" class="d-block w-100" alt="photo de la maison">
    </div>
 CHAINE_DE_FIN;
                }
                echo <<<CHAINE_DE_FIN
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls$id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls$id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
CHAINE_DE_FIN;
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-text-width'></span> titre :" . htmlspecialchars($ann['titre']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-usd'></span> prix :" . htmlspecialchars($ann['prix']) . " MRU");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-map-marker'></span>adresse :" . htmlspecialchars($ann['adresse']));
                echo'<br>';
                $user = Utilisateur::getUtilisateurID($dbh, $ann['id']);
                echo<<<END
            <div class="zoneTexteAfficherMasquer">
            <span class="inviteClic"></span>
            END;
                echo"<div class='voirplus'>";
                print_r("<span class='glyphicon glyphicon-user'></span> Nom du proprietere  :" . htmlspecialchars($user->nom));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-phone'></span> telephone  :" . htmlspecialchars($user->telephone));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-stop'></span> espace :" . htmlspecialchars($ann['espace']) . " m²");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-home'></span> ville :" . htmlspecialchars($ann['ville']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-tags'></span> categorie :" . htmlspecialchars($ann['categorie']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-comment'></span> description :" . htmlspecialchars($ann['description']));
                echo"</div>";
                echo"</div>";
                  $idannonce=$ann['id1'];
           PrintCommentaire($idannonce);
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
             Commentaire :: afficheCommentaire($dbh,$idannonce);
            echo  "</div>";
            echo  "</div>";

                echo "</div>";
            }
            echo"</div>";

            echo"</div>";
        } elseif (isset($_GET['prix']) && !($_GET['prix'] != "") && isset($_GET['localisation']) && $_GET['localisation'] != "" && isset($_GET['categorie']) && !($_GET['categorie'] != "")) {

            $loc = $_GET['localisation'];

            $query = "SELECT * FROM `annonce` where `ville` LIKE '%$loc%' ";
            $sth = $dbh->prepare($query);
            $sth->execute();
            echo"<div class='container' id = 'bas'>";
            echo"<div class='row'>";
            while ($ann = $sth->fetch()) {
                $annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
                echo"<div class='form-group col-sm-3 col-md-8-col-lg-12'>";
                $img = htmlspecialchars($ann['img']);
                $img1 = htmlspecialchars($ann['img1']);
                $img2 = htmlspecialchars($ann['img2']);
                $id = htmlspecialchars($ann['id1']);
                echo <<<CHAINE_DE_FIN
            <div id="carouselExampleControls$id" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
     
  CHAINE_DE_FIN;
                if ($ann['img'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item active">
      <img src="images/$img" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img1'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img1" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img2'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img2" class="d-block w-100" alt="photo de la maison">
    </div>
 CHAINE_DE_FIN;
                }
                echo <<<CHAINE_DE_FIN
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls$id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls$id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
CHAINE_DE_FIN;
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-text-width'></span> titre :" . htmlspecialchars($ann['titre']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-usd'></span> prix :" . htmlspecialchars($ann['prix']) . " MRU");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-map-marker'></span>adresse :" . htmlspecialchars($ann['adresse']));
                echo'<br>';
                $user = Utilisateur::getUtilisateurID($dbh, $ann['id']);
                echo<<<END
            <div class="zoneTexteAfficherMasquer">
            <span class="inviteClic"></span>
            END;
                echo"<div class='voirplus'>";
                print_r("<span class='glyphicon glyphicon-user'></span> Nom du proprietere  :" . htmlspecialchars($user->nom));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-phone'></span> telephone  :" . htmlspecialchars($user->telephone));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-stop'></span> espace :" . htmlspecialchars($ann['espace']) . " m²");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-home'></span> ville :" . htmlspecialchars($ann['ville']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-tags'></span> categorie :" . htmlspecialchars($ann['categorie']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-comment'></span> description :" . htmlspecialchars($ann['description']));
                echo"</div>";
                echo"</div>";
                $idannonce=$ann['id1'];
           PrintCommentaire($idannonce);
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
             Commentaire :: afficheCommentaire($dbh,$idannonce);
            echo  "</div>";
            echo  "</div>";

                echo "</div>";
            }
            echo"</div>";

            echo"</div>";
        } elseif (isset($_GET['prix']) && !($_GET['prix'] != "") && isset($_GET['localisation']) && !($_GET['localisation'] != "") && isset($_GET['categorie']) && $_GET['categorie'] != "") {

            $cat = $_GET['categorie'];
            $query = "SELECT * FROM `annonce` where `categorie` LIKE '%$cat%'";
            $sth = $dbh->prepare($query);
            $sth->execute();
            echo"<div class='container' id = 'bas'>";
            echo"<div class='row'>";
            while ($ann = $sth->fetch()) {
                $annonce = new Annonce($ann['titre'], $ann['prix'], $ann['categorie'], $ann['adresse'], $ann['ville'], $ann['espace'], $ann['description']);
                echo"<div class='form-group col-sm-3 col-md-8-col-lg-12'>";
                $img = htmlspecialchars($ann['img']);
                $img1 = htmlspecialchars($ann['img1']);
                $img2 = htmlspecialchars($ann['img2']);
                $id = htmlspecialchars($ann['id1']);
                echo <<<CHAINE_DE_FIN
            <div id="carouselExampleControls$id" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
     
  CHAINE_DE_FIN;
                if ($ann['img'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item active">
      <img src="images/$img" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img1'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img1" class="d-block w-100" alt="photo de la maison">
    </div>
CHAINE_DE_FIN;
                }
                if ($ann['img2'] != null) {
                    echo <<<CHAINE_DE_FIN
    <div class="carousel-item">
      <img src="images/$img2" class="d-block w-100" alt="photo de la maison">
    </div>
 CHAINE_DE_FIN;
                }
                echo <<<CHAINE_DE_FIN
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls$id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls$id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
CHAINE_DE_FIN;
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-text-width'></span> titre :" . htmlspecialchars($ann['titre']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-usd'></span>prix :" . htmlspecialchars($ann['prix']) . " MRU");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-map-marker'></span>adresse :" . htmlspecialchars($ann['adresse']));
                echo'<br>';
                $user = Utilisateur::getUtilisateurID($dbh, $ann['id']);
                echo<<<END
            <div class="zoneTexteAfficherMasquer">
            <span class="inviteClic"></span>
            END;
                echo"<div class='voirplus'>";
                print_r("<span class='glyphicon glyphicon-user'></span> Nom du proprietere  :" . htmlspecialchars($user->nom));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-phone'></span> telephone  :" . htmlspecialchars($user->telephone));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-stop'></span> espace :" . htmlspecialchars($ann['espace']) . " m²");
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-home'></span> ville :" . htmlspecialchars($ann['ville']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-tags'></span> categorie :" . htmlspecialchars($ann['categorie']));
                echo'<br>';
                print_r("<span class='glyphicon glyphicon-comment'></span> description :" . htmlspecialchars($ann['description']));
                echo"</div>";
                echo"</div>";
                echo "</div>";
                $idannonce=$ann['id1'];
           PrintCommentaire($idannonce);
            echo<<<END
            <div class="zoneAfficheCommentaire">
            <span class="ClicComment"></span>
            END;
             echo"<div class='voircommentaire'>";
             Commentaire :: afficheCommentaire($dbh,$idannonce);
            echo  "</div>";
            echo  "</div>";
            }
            echo"</div>";

            echo"</div>";
        } else {
            Annonce::afficheAnnonce($dbh);
        }
    }
    //triater l'image avant l'inseret dans la base de donner
    public static function imageTrait($dbh, $fileName, $fileTmp, $filesiZe, $fileError) {
        $login = $_SESSION['login'];
        $user = Utilisateur ::getUtilisateur($dbh, $login);
        $id = $user->id;
        $filleExt = explode('.', $fileName);
        $fileAext = strtolower(end($filleExt));
        $allowedExtensions = array("jpeg", "png", "jpg");
        if (in_array($fileAext, $allowedExtensions)) {
            if ($fileError === 0) {
                if ($filesiZe < 1000000) {
                    $fileNamenew = "img-" . $id . "." . time() . $fileName;
                    $fileDestination = 'images/' . $fileNamenew;
                    $newWidth = 150;
                    list($widthOrig, $heightOrig) = getimagesize($fileTmp);
                    $ratio = $widthOrig / $newWidth;
                    $newHeight = 100;

                    if ($fileAext == 'jpeg') {
                        $image_petit = imagecreatefromjpeg($fileTmp);
                        $tmpPhotoLD = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($tmpPhotoLD, $image_petit, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);
                        imagejpeg($tmpPhotoLD, $fileDestination, 100);
                    }
                    if ($fileAext == 'png') {
                        $image_petit = imagecreatefrompng($fileTmp);
                        $tmpPhotoLD = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($tmpPhotoLD, $image_petit, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);
                        imagepng($tmpPhotoLD, $fileDestination, 5);
                    }
                    if ($fileAext == 'jpg') {
                        $image_petit = imagecreatefromjpeg($fileTmp);
                        $tmpPhotoLD = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($tmpPhotoLD, $image_petit, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);
                        imagejpeg($tmpPhotoLD, $fileDestination, 100);
                    }

                    return $fileNamenew;
                } else {
                    echo 'Fichier trop grand';
                }
            } else {
                echo "Une erreur s'est produite";
            }
        } else {
            echo 'Type incompatible';
        }
    }

}

?>