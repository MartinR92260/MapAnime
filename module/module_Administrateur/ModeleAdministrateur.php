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
		$this->request = "SELECT idAnime,nom,nbEpisodes,nbSaisons FROM anime ORDER BY idAnime";
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
}
?>