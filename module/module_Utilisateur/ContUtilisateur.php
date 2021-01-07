<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('ModeleUtilisateur.php');
require_once('VueUtilisateur.php');

class ContUtilisateur{

	private $modele;
	private $vue;
	private $vueIndex;

	public function __construct(){
		$this->modele = new ModeleUtilisateur();
		$this->vue = new VueUtilisateur();
		$this->vueIndex = new VueIndex();
	}

	public function ajouterListe(){
		if(isset($_GET['id'])){
			$this->vueIndex->result($this->modele->addToliste());
		}
	}

    public function supprimerListe(){
		if(isset($_GET['id'])){
			$this->vueIndex->result($this->modele->delToliste());
		}
	}
    
    public function profil(){
		$this->vue->affichageDuProfilUtilisateur($this->modele->requestListe());
	}
}

?>