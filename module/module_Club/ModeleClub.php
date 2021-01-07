<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('./ConnexionBD.php');

class ModeleClub extends ConnexionBD{


	public function __construct(){
		parent::initConnexion();
	}

    public function rejoindreClub($id) {
            if (isset($_SESSION['idUtilisateur'])){
                $req = self::$bdd->prepare("INSERT INTO possede VALUES (?,?)");
/*                var_dump($id);
                var_dump($_SESSION['idUtilisateur']);*/
                $req->execute(array($_SESSION['idUtilisateur'], $id));
                return $req->fetchAll();
        }
    }

    public function quitterClub($id) {
        if (isset($_SESSION['idUtilisateur'])){
                $req = self::$bdd->prepare("DELETE FROM possede WHERE idUtilisateur = ? AND idClub = ?");
                $req->execute(array($_SESSION['idUtilisateur'], $id));
                return $req->fetchAll();
        }
    }

/*    public function incrementNbUtilisateur($id) {
        $nbAdherent = $this->getNbAdherent($id);
        $nbAdherent++;
        $this->setNbAdherent($nbAdherent, $id);
    }

    public function decrementNbUtilisateur($id) {
        $nbAdherent = $this->getNbAdherent($id);
        $nbAdherent--;
/*        $newNbAdherent = $this->setNbAdherent($nbAdherent);*/
    
   // }

    public function getNbAdherent($id) {
        $req = self::$bdd->prepare("SELECT count('idUtilisateur') AS nbUtilisateur FROM possede where idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }

/*    public function setNbAdherent($nbAdherent, $id) {
        $req = self::$bdd->prepare("UPDATE Club SET nbUtilisateur = ? WHERE idClub = ?");
        var_dump($nbAdherent);
        var_dump($id);
        $req->execute(array($nbAdherent, $id)); 
        return $req->fetchAll();
    }*/

	public function posterCommentaire($id){
        $req = self::$bdd->prepare("INSERT INTO Commentaire VALUES (default, ?, ?, ?, ?, ?, ?)");
        $result=$req->execute(array($_SESSION['idUtilisateur'], NULL, $id, $_POST['Commentaires'],NULL,NULL));
        return $result;
    }

    public function retirerCommentaire($id){
        $req = self::$bdd->prepare("DELETE FROM Commentaire WHERE idCommentaire LIKE ?");
        $result = $req->execute(array($id));
        return $result;
    }

    public function getCommentaire($id) {
        $req = self::$bdd->prepare("SELECT * FROM Commentaire NATURAL JOIN possede NATURAL JOIN Utilisateur WHERE Commentaire.idClub = ?");
        $req->execute(array($id));
        return $req->fetchAll();
    }

/*    public function adherentDansUnAutreClub() {
        $req = self::$bdd->prepare("SELECT idClub FROM Utilisateur WHERE idClub = ? AND idUtilisateur = ?");
        if($req == NULL) {
            return false;
        }
        else {
            return true;
        }
    }*/

        public function dejaAdherentDuClub($id) {
        $req = self::$bdd->prepare("SELECT idClub FROM Utilisateur WHERE idClub = ? AND idUtilisateur = ?");
        if($req == NULL) {
            return false;
        }
        else {
            return true;
        }
    }

    public function getIdClub($id) {
        $req = self::$bdd->prepare("SELECT idClub FROM Club where idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }
}

?>