<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('./ConnexionBD.php');

class ModeleAmi extends ConnexionBD{

	private $requestPrepare;
	private $request;
	private $arg;

	public function __construct(){
		parent::initConnexion();
		$this->arg = array();
	}

	public function recupAnime($id){
		$this->request = 'SELECT idAnime,nom FROM utilisateur NATURAL JOIN liste NATURAL JOIN anime WHERE idUtilisateur=?';
		$this->arg = array($id);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		return $this->requestPrepare->fetchAll();
	}

	public function recupProfilAmi($id){
		$this->request = 'SELECT * FROM utilisateur WHERE idUtilisateur=?';
		$this->arg = array($id);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		return $this->requestPrepare->fetchAll();
	}

	public function listeAmis($id){
		$this->request = "SELECT idAmi,pseudoAmi,PhotoProfil FROM ami NATURAL JOIN avoir WHERE idUtilisateur=?";
		$this->arg=array($id);
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute($this->arg);
		return $prepareRequest->fetchAll();
	}
}
?>