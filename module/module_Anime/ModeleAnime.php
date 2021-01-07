<?php

require_once("./ConnexionBD.php"); 

class ModeleAnime extends ConnexionBD{

	public function __construct(){
		parent::initConnexion();
	}

	public function getAnime($id){
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

	public function insertAnime(){
		$req = self::$bdd->prepare("INSERT INTO Anime VALUES (default,?,?,?,?,?,?,?,?)");
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
		/*if(!empty($_POST['note'])){
			$note = $_POST['note'];
		}else{
			$note = NULL;
		}*///Bizzare de mettre la note de l'anime
		/*if(!empty($_POST['nbVolume'])){
			$nbVolume = $_POST['nbVolume'];
		}else{
			$nbVolume = NULL;
		}*/
		if(!empty($_POST['nbSaisons'])){
			$nbSaisons = $_POST['nbSaisons'];
		}else{
			$nbSaisons = NULL;
		}
		if(!empty($_POST['nbEpisodes'])){
			$nbEpisodes = $_POST['nbEpisodes'];
		}else{
			$nbEpisodes = NULL;
		}
		
		/*if(!empty($_POST['Auteur'])){
			$AuteurListe = self::getAuteur($_POST['Auteur']);
			if(empty($AuteurListe)){
				$AuteurListe=self::createAuteur($_POST['Auteur']);
			}
			foreach ($AuteurListe as $key){
				$Auteur = $key['idAuteur'];
			}
		}else{
			$Auteur = NULL;
		}*/
		/*if(!empty($_POST['Studio'])){
			$StudioListe = self::getStudio($_POST['Studio']);
			if(empty($StudioListe)){
				$StudioListe=self::createStudio($_POST['Studio']);
			}
			foreach ($StudioListe as $key){
				$Studio = $key['idStudio'];
			}
		}else {
			$Studio = NULL;
		}*/
		$result = $req->execute(array($nom,NULL,$nbEpisodes,$nbSaisons,$synopsis,1,0,NULL));
		return $result;


	}	

	
    
    public function getCommentaire($id) {
        $req = self::$bdd->prepare("SELECT * FROM Commentaire NATURAL JOIN Anime NATURAL JOIN Utilisateur WHERE idAnime = ?");
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
    
    public function insertionCommentaire($idAnime){
        $req = self::$bdd->prepare("INSERT INTO commentaire VALUES (default, ?, ?, ?, ?, ?, ?)");
        $result=$req->execute(array($_SESSION['idUtilisateur'], $idAnime,NULL, $_POST['commentaireV2'],NULL,NULL));//2 dernier null = date et heure
        /*echo date('l j F Y, H:i');*/
        return $result;
    }

    public function suppressionCommentaire($idAnime){
    	$req = self::$bdd->prepare("DELETE FROM commentaire WHERE idCommentaire LIKE ?");
        $result=$req->execute(array( $idAnime));
        return $result;
    }

    public function suppressionAnime($idAnime){
    	$req = self::$bdd->prepare("DELETE FROM anime WHERE idAnime = ?");
        $result=$req->execute(array($idAnime));
        return $result;
    }
}

?>