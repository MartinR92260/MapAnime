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
		$this->request = "SELECT idAnime,nom,nbEpisodes,nbSaisons FROM anime";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}

	public function infoUsers(){
		$this->request = "SELECT idUtilisateur,pseudo,Email,Admin FROM utilisateur";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}
}
?>