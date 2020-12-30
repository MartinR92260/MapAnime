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

	public function search($expr=NULL){
		$expr="%".$expr."%";
		$this->request='SELECT DISTINCT idAnime,nom FROM anime NATURAL JOIN genre WHERE nom LIKE ?';
		$this->arg=array($expr);
		$this->queryMaker($expr);
		$this->requestPrepare=self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		return $this->requestPrepare->fetchAll();
	}

	private function queryMaker($expr=NULL){
		if(isset($_POST['anime'])){
			$this->request=$this->request.' AND nbEpisodes IS NOT NULL';
		}
		else if(isset($_POST['Genre']) && 0<count($_POST['Genre'])){
			for($i=0 ; $i<intval(count($_POST['Genre'])) ; $i++){
				$this->request=$this->request.' AND idAnime IN (SELECT idAnime FROM genre WHERE idGenre = ?)';
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
} 
?>