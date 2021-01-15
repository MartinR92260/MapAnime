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

    public function getNbAdherent($id) {
        $req = self::$bdd->prepare("SELECT count('idUtilisateur') AS nbUtilisateur FROM possede where idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }

    public function posterCommentaire($id){
        $req = self::$bdd->prepare("INSERT INTO commentaire VALUES (default, ?, ?, ?, ?, ?, ?)");
        $result=$req->execute(array($_SESSION['idUtilisateur'], NULL, $id, $_POST['comm'],NULL,NULL));
        return $result;
    }

    public function retirerCommentaire($id){
        $req = self::$bdd->prepare("DELETE FROM Commentaire WHERE idCommentaire = ?");
        $result = $req->execute(array($id));
        return $result;
    }

    public function getCommentaire($id) {
        $req = self::$bdd->prepare("SELECT * FROM Commentaire NATURAL JOIN possede NATURAL JOIN Utilisateur WHERE Commentaire.idClub = ?");
        $req->execute(array($id));
        return $req->fetchAll();
    }


    public function dejaAdherentDuClub($id, $ide) {
        $req = self::$bdd->prepare("SELECT idUtilisateur FROM possede WHERE idClub = ? AND idUtilisateur = ?");
        $req->execute(array($id, $ide));
        return $req->fetchAll();
    }

    public function getIdClub($id) {
        $req = self::$bdd->prepare("SELECT idClub FROM Club where idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }

    public function getListeUtilisateur($id) {
        $req = self::$bdd->prepare("SELECT * FROM utilisateur NATURAL JOIN possede where idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }

/*    public function bannir($id) {
        if (isset($_SESSION['idUtilisateur'])){
            if ($_SESSION['Admin'] == 1){
                $req = self::$bdd->prepare("INSERT INTO possede VALUES (NULL,NULL)");
                $req->execute(array($_SESSION['idUtilisateur'], $id));
                return $req->fetchAll();
            }
        }
    }*/
}

?>