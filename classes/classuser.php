<?php

class Utilisateur {
    public $id;
    public $login;
    public $nom;
    public $prenom;
    public $mdp;
    public $telephone;
    public $admin;
    public function __toString() {
        return "[" . $this->login . "]" . $this->prenom . " " . $this->nom . " numero telphone " . $this->telephone;
    }

    public static function getUtilisateur($dbh, $login) {
        $query = "SELECT * FROM `utilisateurs`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute();
        while ($user = $sth->fetch()) {
            if ($user->login === $login) {
                $sth->closeCursor();
                return $user;
            }
        } return NULL;
    }
    public static function getUtilisateurID($dbh, $id) {
        $query = "SELECT * FROM `utilisateurs`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute();
        while ($user = $sth->fetch()) {
            if ($user->id === $id) {
                $sth->closeCursor();
                return $user;
            }
        } return NULL;
    }

    public static function insererUtilisateur($dbh, $login, $mdp, $nom, $prenom, $telephone) {
        if (Utilisateur::getUtilisateur($dbh, $login) == null) {
            $query = "INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `telephone`) VALUES(?,?,?,?,?)";
            $sth = $dbh->prepare($query);
            $sth->execute(array($login, sha1($mdp), $nom, $prenom, $telephone));
            return ($sth->rowCount() == 1);
        }
        return false;
    }
    public static function afficheCompte($dbh){
        $query = "SELECT * FROM `utilisateurs`";
        $sth = $dbh->prepare($query);
        $sth->execute();
        echo"<div class='container'>";
        echo"<div class='row'>";

        while ($ann = $sth->fetch()) {
            echo"<div class='col-md-8'>";
            print_r("<img alt='image de profile' src = 'images/"."prf.jpg"."'>");
            echo'<br>';
            print_r("nom :" . htmlspecialchars($ann['nom']));
            echo'<br>';
            print_r("prenom :" . htmlspecialchars($ann['prenom']));
            echo'<br>';
            print_r("tel :" . htmlspecialchars($ann['telephone']));
            echo'<br>';
            $lg = $ann['login'];
            echo<<< CHAINE_DE_FIN
            <button class = 'btn btn-outline-danger' type = 'submit' role='link' onClick = "window.location='index.php?page=compte&&todo=Supcmp&&login=$lg'">Supprimer compte</button>
CHAINE_DE_FIN; 
             echo' <br>';
           echo' <br>';
           echo' <br>';
   echo "</div>";
        }
        echo"</div>";

        echo"</div>";
    }
    public static function testerMdp($dbh, $login, $mdp) {
        $query = "SELECT * FROM `utilisateurs` WHERE login= ? AND mdp = ? ";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login, sha1($mdp)));
        return ($sth->rowCount() == 1);
    }

    public static function deletUtilisateur($dbh, $login) {
        $user = Utilisateur::getUtilisateur($dbh, $login);
        $query = "DELETE FROM `utilisateurs` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($user->id));
        return ($sth->rowCount() == 1);
    }

    public function chngerMdp($dbh, $login,$mdp) {
        $user = Utilisateur:: getUtilisateur($dbh, $login);
        $query = "UPDATE `utilisateurs` SET `mdp` =?  WHERE `login` = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array(sha1($mdp) , $login));
        return ($sth->rowCount() == 1);
    }
    public function changernum($dbh, $login,$telephone) {
        $user = Utilisateur:: getUtilisateur($dbh, $login);
        $query = "UPDATE `utilisateurs` SET `telephone` =?  WHERE `login` = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($telephone , $login));
        return ($sth->rowCount() == 1);
    }
}
















    


