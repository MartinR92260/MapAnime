<?php

require_once("./ConnexionBD.php"); 

class ModeleAnime extends ConnexionBD{

	public function __construct(){
		parent::initConnexion();
	}

	public function getAnime($id){//getAnime
		$req = self::$bdd->prepare("SELECT DISTINCT * from anime WHERE idAnime = ?");
		$req->execute(array($id));
		return $req->fetchAll();
	}

    public function getGenre($id){//getGenre== ancien getGenreFrom
       /* $req = self::$bdd->prepare("SELECT DISTINCT idGenre,NomGenre FROM genre  WHERE idGenre = ?");*/
       $req = self::$bdd->prepare("SELECT DISTINCT idGenre,NomGenre FROM Anime NATURAL JOIN etre NATURAL JOIN Genre WHERE idAnime = ?");
        $req->execute(array($id));
        return $req->fetchAll();
    }

	/*public function insertAnime(){
		$req = self::$bdd->prepare("INSERT INTO anime VALUES (default,?,?,?,?,?,?,?,?,?)");
		if(!empty($_POST['nom'])){
			$nom = $_POST['nom'];
		}else{
			$nom = NULL;
		}
		if(!empty($_POST['synopsis'])){
			$synopsis = $_POST['synopsis'];
		}else{
			$synopsis = NULL;
		}
		if(!empty($_POST['note'])){
			$note = $_POST['note'];
		}else{
			$note = NULL;
		}
		if(!empty($_POST['nbVolume'])){
			$nbVolume = $_POST['nbVolume'];
		}else{
			$nbVolume = NULL;
		}
		if(!empty($_POST['nbSaison'])){
			$nbSaison = $_POST['nbSaison'];
		}else{
			$nbSaison = NULL;
		}
		if(!empty($_POST['nbTotalEp'])){
			$nbTotalEp = $_POST['nbTotalEp'];
		}else{
			$nbTotalEp = NULL;
		}
		
		if(!empty($_POST['Auteur'])){
			$AuteurListe = self::getAuteur($_POST['Auteur']);
			if(empty($AuteurListe)){
				$AuteurListe=self::createAuteur($_POST['Auteur']);
			}
			foreach ($AuteurListe as $key){
				$Auteur = $key['idAuteur'];
			}
		}else{
			$Auteur = NULL;
		}
		if(!empty($_POST['Studio'])){
			$StudioListe = self::getStudio($_POST['Studio']);
			if(empty($StudioListe)){
				$StudioListe=self::createStudio($_POST['Studio']);
			}
			foreach ($StudioListe as $key){
				$Studio = $key['idStudio'];
			}
		}else {
			$Studio = NULL;
		}
		$result = $req->execute(array($nom,$synopsis,NULL,$note,$nbVolume,$nbSaison,$nbTotalEp,$Auteur,$Studio));
		return $result;
	}	*/
    
    public function getCommentaire($id) {
        $req = self::$bdd->prepare("SELECT * FROM commentaire NATURAL JOIN anime NATURAL JOIN utilisateur WHERE idAnime = ?");//Avis==commentaire
        $req->execute(array($id));
		return $req->fetchAll();
    }

    /*Create/Get studio/auteur*/

   public function getListe($id) {
        if (isset($_SESSION['idUtilisateur'])){
            $req = self::$bdd->prepare("SELECT * FROM utilisateur WHERE idAnime = ? AND idUtilisateur = ?");
            $req->execute(array($id,$_SESSION['idUtilisateur']));
            return $req->fetchAll();
        }
    }

    /*getFav*/
    
    public function insertionCommentaire($idOe){
        $req = self::$bdd->prepare("INSERT INTO commentaire VALUES (default, ?, ?, ?)");
        $result=$req->execute(array($_POST['commentaire'], $idOe,$_SESSION['idUtilisateur']));
        return $result;
    }

    public function suppressionCommentaire($idOe){
    	$req = self::$bdd->prepare("DELETE FROM commentaire WHERE idCommentaire LIKE ?");
        $result=$req->execute(array( $idOe));
        return $result;
    }

    public function suppressionAnime($idOe){
    	$req = self::$bdd->prepare("DELETE FROM anime WHERE idAnime = ?");
        $result=$req->execute(array($idOe));
        return $result;
    }
}

?>