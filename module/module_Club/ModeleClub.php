<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('./ConnexionBD.php');

class ModeleClub extends ConnexionBD{


	public function __construct(){
		parent::initConnexion();
	}

    public function rejoindreClub($id) {
            if (isset($_SESSION['idUtilisateur'])){
                $req = self::$bdd->prepare("UPDATE possede SET idClub = ? where idUtilisateur = ?");
                $req->execute(array($id,$_SESSION['idUtilisateur']));
                return $req->fetchAll();
        }
    }

    public function quitterClub($id) {
        if (isset($_SESSION['idUtilisateur'])){
                $req = self::$bdd->prepare("DELETE FROM possede WHERE idUtilisateur = ? AND idClub = ?");
                $req->execute(array($id,$_SESSION['idUtilisateur']));
                return $req->fetchAll();
        }
    }

    public function incrementNbUtilisateur($id) {
        $nbAdherent = $this->getNbAdherent($id);
        $nbAdherent++;
        $newNbAdherent = $this->setNbAdherent($nbAdherent);
    }

    public function decrementNbUtilisateur($id) {
        $nbAdherent = $this->getNbAdherent($id);
        $nbAdherent--;
/*        $newNbAdherent = $this->setNbAdherent($nbAdherent);*/
    
    }

    public function getNbAdherent($id) {
        $req = self::$bdd->prepare("SELECT nbUtilisateur FROM Club WHERE idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }

    public function setNbAdherent($id) {
        $req = self::$bdd->prepare("UPDATE Club SET nbUtilisateur = ? WHERE idClub = ?");
        $req->execute($id); 
        return $req->fetchAll();
    }

	public function posterCommentaire($id){
        $req = self::$bdd->prepare("INSERT INTO Commentaire VALUES (default, 1, NULL, ?, ?, ?, ?)");
        $result=$req->execute(array($id));
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
}

?>