<?php

class Commentaire {

    public $auteur;
    public $commentaire;
    public $dateCommentaire;

    public function afficheCommentaire($dbh, $id) {
        $query = "SELECT * FROM `commentaire` WHERE `id1`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
        while ($cmm = $sth->fetch()) {

            print_r("<strong>auteur </strong>:" . htmlspecialchars($cmm['auteur']));
            echo'<br>';
            echo"<div class='bubble'>";
            print_r("<strong>Commentaire </strong>:" . htmlspecialchars($cmm['commentaire']));
            echo'</div>';
            print_r(" <strong>date du Commentaire </strong>:" . htmlspecialchars($cmm['dateCommentaire']));
           echo' <br>';
        }
    }

    public function insertCommentaire($dbh, $id, $auteur, $commentaire, $dateCommentaire) {
        $query = "INSERT INTO `commentaire`(`id1`,`auteur` , `commentaire`,`dateCommentaire`) VALUES(?,?,?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id, $auteur, $commentaire, $dateCommentaire));
        return ($sth->rowCount() == 1);
    }

    public function deleteCommentaire($dbh, $id) {

        $query = "DELETE  FROM `commentaire` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
        return ($sth->rowCount() == 1);
    }

    public function afficheCommentaireAd($dbh, $id) {
        $query = "SELECT * FROM `commentaire` WHERE `id1`=? ";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
        while ($cmm = $sth->fetch()) {

            print_r("<strong>auteur </strong>:" . htmlspecialchars($cmm['auteur']));
            echo'<br>';
            echo"<div class='bubble'>";
            print_r("<strong>Commentaire </strong>:" . htmlspecialchars($cmm['commentaire']));
            echo'</div>';
            print_r(" <strong>date du Commentaire </strong>:" . htmlspecialchars($cmm['dateCommentaire'])); echo' <br>';
            $idannonce = $cmm['id'];
            echo<<< CHAINE_DE_FIN
            <button class = 'btn btn-outline-danger' type = 'submit' role='link' onClick = "window.location='index.php?page=compte&&todo=Supcmt&&id=$idannonce'">Supprimer ce commentaire</button>
CHAINE_DE_FIN;
        }
    }

}
