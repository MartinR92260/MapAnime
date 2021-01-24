<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('./ConnexionBD.php');

class ModeleAdministrateur extends ConnexionBD{

	private $requestPrepare;
	private $request;
	private $arg;

	public function __construct(){
		parent::initConnexion();
		$this->arg = array();
	}

	public function infoAnimes(){
		$this->request = "SELECT idAnime,nom,ImageAnime,nbEpisodes,nbSaisons FROM anime ORDER BY idAnime";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}

	public function infoUsers(){
		$this->request = "SELECT idUtilisateur,pseudo,Email,Admin FROM utilisateur ORDER BY idUtilisateur";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}

	public function infoClubs(){
		$this->request = "SELECT idClub,nomClub FROM club ORDER BY idClub";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}

	public function infoComs(){
		$this->request = "SELECT idCommentaire,idUtilisateur,idAnime,idClub,contenu,Date,Heure FROM commentaire ORDER BY idCommentaire";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}

	public function infoGenres(){
		$this->request = "SELECT idGenre,nomGenre FROM genre ORDER BY idGenre";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}
 
	public function insertGenre(){
		header('Location:index.php?module=Administrateur&action=affichePanel');
		$request = self::$bdd->prepare("INSERT INTO genre VALUES (default,?)");
		if(!empty($_POST['nom'])){
			$nom = $_POST['nom'];
		}else{
			$nom = NULL;
		}
		$request->execute(array($nom));
	}

	public function updateGenre($id){
		header('Location:index.php?module=Administrateur&action=affichePanel');
		$request = self::$bdd->prepare("UPDATE genre SET nomGenre=? WHERE idGenre=?");
		$request->execute(array($_POST['nom'],$id));
	}

	public function supprGenre($id){
		header('Location:index.php?module=Administrateur&action=affichePanel');
    	$request = self::$bdd->prepare("DELETE FROM genre WHERE idGenre=?");
        $request->execute(array($id));
    }

    public function updateUser($id){
		header('Location:index.php?module=Administrateur&action=affichePanel');
		$request = self::$bdd->prepare("UPDATE utilisateur SET Admin=? WHERE idUtilisateur=?");
		$request->execute(array($_POST['admin'],$id));
	}

	public function supprUser($id){
		header('Location:index.php?module=Administrateur&action=affichePanel');
    	$request = self::$bdd->prepare("DELETE FROM utilisateur WHERE idUtilisateur=?");
        $request->execute(array($id));
    }
}
?>