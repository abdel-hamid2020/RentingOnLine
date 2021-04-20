<?php
class Contact{
public $name;
public $telephone;
public $sujet;
public $message;
public $datemessage;
public $etat;
public function insertContact($dbh,$name,$telephone,$sujet,$message,$datemessage) {
    $query = "INSERT INTO `contact`(`name`,`numero` , `sujet`,`message`,`datemessage`) VALUES(?,?,?,?,?)";
    $sth = $dbh->prepare($query);
    $sth->execute(array($name,$telephone,$sujet,$message ,$datemessage));
    return($sth->rowCount()==1);
}
public function affichemessage($dbh) {
     $query = "SELECT * FROM `contact` ORDER BY `etat` ASC ,`id` DESC ";
        $sth = $dbh->prepare($query);
        $sth->execute();
        while ($cmm = $sth->fetch()) {
            echo "<strong></strong>";
            print_r("<strong>Nom: </strong>:" . htmlspecialchars($cmm['name']));
            echo'<br>';
            print_r("<strong>Numero: </strong>:" . htmlspecialchars($cmm['numero']));
            echo '<br>';
            print_r(" <strong>Sujet: </strong>:" . htmlspecialchars($cmm['sujet']));
             echo"<div class='bubble'>";
            print_r(" <strong>Message </strong>:" . htmlspecialchars($cmm['message']));
           echo'</div>';
            print_r(" <strong>date du message </strong>:" . htmlspecialchars($cmm['datemessage']));
            $id = $cmm['id'];
            if($cmm['etat']==0){
                echo<<<END
                <form action="index.php?page=compte&&todo=admine" method="POST"><input type="hidden" value ="$id" name="id">
                        <input type="submit" value="Marquer comme lu">
                </form>
            <p style="color:blue"> message non lu</p>
            END;
           }
            else{
                 echo<<<END
            <p style="color:red"> message déja lu</p>
            END; 
            }
           echo' <br>';
           echo' <br>';
           echo' <br>';
           echo' <br>';
        }
    }
    public function etatmessage($dbh , $id) {
        $query = "UPDATE `contact` SET `etat` =?  WHERE `id` = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array(1 , $id));
        return ($sth->rowCount() == 1);
    }
}
