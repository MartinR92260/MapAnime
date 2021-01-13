<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('./ConnexionBD.php');

class ModeleUtilisateur extends ConnexionBD{

	private $requestPrepare;
	private $request;
	private $arg;

	public function __construct(){
		parent::initConnexion();
		$this->arg = array();
	}

	public function requestListe(){
		$idUtilisateur = $_SESSION['idUtilisateur'];
		$this->request = 'SELECT idAnime,nom FROM utilisateur NATURAL JOIN liste NATURAL JOIN anime WHERE idUtilisateur=?';
		$this->arg = array($idUtilisateur);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		return $this->requestPrepare->fetchAll();
	}

	public function addToliste(){
		$idUtilisateur = $_SESSION['idUtilisateur'];
		$id = $_GET['id'];
		//Insert
		$this->request = 'INSERT INTO liste VALUES(?,?,NULL)';
		$this->arg = array($idUtilisateur,$id);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		//Verife avec un select pcq insert renvoie tjrs array()
		$this->request = 'SELECT idAnime FROM liste WHERE idUtilisateur=? AND idAnime=? LIMIT 1';
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		return $this->requestPrepare->fetchAll();
	}
    
    public function delToliste(){
        $this->request = 'DELETE FROM liste WHERE idUtilisateur='.$_SESSION['idUtilisateur'].' AND idAnime=?';
        $this->arg = array($_GET['id']);
        $this->requestPrepare = self::$bdd->prepare($this->request);
		return $this->requestPrepare->execute($this->arg);
    }
}

?>