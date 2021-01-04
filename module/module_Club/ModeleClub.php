<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('./ConnexionBD.php');

class ModeleClub extends ConnexionBD{


	public function __construct(){
		parent::initConnexion();
	}

    public function rejoindreClub($id) {
            if (isset($_SESSION['idUtilisateur'])){
                $req = self::$bdd->prepare("UPDATE Utilisateur SET idClub = :id WHERE idUtilisateur = ?");
                $req->execute(array($id,$_SESSION['idUtilisateur']));
                return $req->fetchAll();
        }
    }

    public function quitterClub($id) {
        if (isset($_SESSION['idUtilisateur'])){
                $req = self::$bdd->prepare("UPDATE Utilisateur SET idClub = NULL WHERE idUtilisateur = ? AND idClub = :id");
                $req->execute(array($id,$_SESSION['idUtilisateur']));
                return $req->fetchAll();
        }
    }

    public function incrementNbUtilisateur($id) {
        $nbAdherent = getNbAdherent($id);
        $nbAdherent++;
        $newNbAdherent = setNbAdherent($nbAdherent);
    }

    public function decrementNbUtilisateur($id) {
        $nbAdherent = getNbAdherent($id);
        $nbAdherent--;
        $newNbAdherent = setNbAdherent($nbAdherent);
    }

    public function getNbAdherent($id) {
        $req = self::$bdd->prepare("SELECT nbUtilisateur FROM Club WHERE idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();

    }

        public function setNbAdherent($id) {
        $req = self::$bdd->prepare("UPDATE Club SET idClub = :id WHERE idClub = :id");
        $req->execute(array($id)); 
        $nbAdherent = $req->fetchAll();
        return $nbAdherent;
    }

	public function posterCommentaire($id){
        $req = self::$bdd->prepare("INSERT INTO Commentaire VALUES (default, ?, NULL, ?, ?, ?, ?)");
        $result=$req->execute(array($id));
        return $result;
    }

    public function retirerCommentaire($id){
        $req = self::$bdd->prepare("DELETE FROM Commentaire WHERE idCommentaire LIKE ?");
        $result = $req->execute(array($id));
        return $result;
    }

    public function getCommentaire($id) {
        $req = self::$bdd->prepare("SELECT * FROM Commentaire INNER JOIN Utilisateur ON Commentaire.idClub = Utilisateur.idClub WHERE Commentaire.idClub = ?");
        $req->execute(array($id));
        return $req->fetchAll();
    }

    public function adherentDansUnAutreClub() {
        $req = self::$bdd->prepare("SELECT idClub FROM Utilisateur WHERE idClub = ? AND idUtilisateur = ?");
        if($req == NULL) {
            return false;
        }
        else {
            return true;
        }
    }

        public function dejaAdherentDuClub($id) {
        $req = self::$bdd->prepare("SELECT idClub FROM Utilisateur WHERE idClub = :id AND idUtilisateur = ?");
        if($req == NULL) {
            return false;
        }
        else {
            return true;
        }
    }
}

?>