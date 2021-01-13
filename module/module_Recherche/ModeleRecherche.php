<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
require_once('./ConnexionBD.php');

class ModeleRecherche extends ConnexionBD{

	private $requestPrepare;
	private $request;
	private $arg;

	public function __construct(){
		parent::initConnexion();
		$this->arg = array();
	}

	public function searchNom($expr=NULL){
		$expr="%".$expr."%";
		$this->request='SELECT DISTINCT idAnime,nom,ImageAnime,SUBSTRING(synopsis,1,255) FROM anime WHERE nom LIKE ?';
		$this->arg=array($expr);
		$this->requestPrepare=self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		return $this->requestPrepare->fetchAll();
	}

	public function searchGenre($expr=NULL){
		$expr="%".$expr."%";
		$this->request='SELECT DISTINCT idAnime,nom,ImageAnime,SUBSTRING(synopsis,1,255) FROM anime NATURAL JOIN etre NATURAL JOIN genre WHERE nom LIKE ?';
		$this->arg=array($expr);
		$this->queryMaker($expr);
		$this->requestPrepare=self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		return $this->requestPrepare->fetchAll();
	}

	private function queryMaker($expr=NULL){
		if(0<count($_POST['Genre'])){
			for($i=0 ; $i<intval(count($_POST['Genre'])) ; $i++){
				$this->request=$this->request.' AND idAnime IN (SELECT idAnime FROM etre WHERE idGenre = ?)';
				array_push($this->arg,$_POST['Genre'][$i]);
			}
		}
	}

	public function listeGenre(){
		$this->request = "SELECT idGenre,NomGenre FROM Genre";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}

	public function listeAnime(){
		$this->request = "SELECT idAnime,nom,ImageAnime,SUBSTRING(synopsis,1,255) FROM Anime ORDER BY nom";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}

	public function listeClub(){
		$this->request = "SELECT idClub,nomClub, SUBSTRING(DescriptionClub,1,255) FROM Club";
		$prepareRequest=self::$bdd->prepare($this->request);
		$prepareRequest->execute();
		return $prepareRequest->fetchAll();
	}
} 
?>