<?php

require_once("./ConnexionBD.php"); 

class ModeleAnime extends ConnexionBD{

	public function __construct(){
		parent::initConnexion();
	}

	public function getAnime($id){
		$req = self::$bdd->prepare("SELECT DISTINCT * FROM anime WHERE idAnime = ?");
		$req->execute(array($id));
		return $req->fetchAll();
	}


	public function VerifAnimeDansListe($id){
		 if(isset($_SESSION['idUtilisateur'])){
		$req = self::$bdd->prepare("SELECT idAnime FROM liste WHERE idUtilisateur = ? AND idAnime= ?");
		$req->execute(array($_SESSION['idUtilisateur'],$id));
		return $req->fetchAll();
	}
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
            $req = self::$bdd->prepare("SELECT idAnime FROM liste WHERE idUtilisateur = ? ");
            $req->execute(array($_SESSION['idUtilisateur']));
            return $req->fetchAll();
        }
    }

    
    
    public function insertionCommentaire($idAnime){

    	
    	$date=date("Y-m-d");
    	$heure=date("H:i:s");
    	
        $req = self::$bdd->prepare("INSERT INTO commentaire VALUES (default, ?, ?, ?, ?, ?, ?)");
        $result=$req->execute(array($_SESSION['idUtilisateur'], $idAnime,NULL, $_POST['commentaireV2'],$date,$heure));
        return $result;
    }

    public function suppressionCommentaire($idAnime){
    	    	header('Location:index.php');

    	$req = self::$bdd->prepare("DELETE FROM commentaire WHERE idCommentaire LIKE ?");
        $result=$req->execute(array( $idAnime));
        return $result;
    }

    public function suppressionAnime($idAnime){

    	header('Location:index.php');


    	$req = self::$bdd->prepare("DELETE FROM anime WHERE idAnime = ?");
        $result=$req->execute(array($idAnime));
        return $result;
    }
   

    	public function modifNote($id){

    	header('Location:index.php');

		$idUtilisateur = $_SESSION['idUtilisateur'];
		$newNote=$_POST['noteSelec'];
		$this->request = 'UPDATE  liste SET note=? WHERE idUtilisateur=? AND idAnime=?';
		$this->arg = array($newNote,$idUtilisateur,$id);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		
	}

	public function modifLEtat($id) {

    	header('Location:index.php');


		$idUtilisateur = $_SESSION['idUtilisateur'];
		$newEtat=$_POST['etatSelec'];
		$this->request = 'UPDATE  liste SET etat=? WHERE idUtilisateur=? AND idAnime=?';
		$this->arg = array($newEtat,$idUtilisateur,$id);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		
	}
}

?>