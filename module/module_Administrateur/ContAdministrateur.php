<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('ModeleAdministrateur.php');
require_once('VueAdministrateur.php');

class ContAdministrateur{

	private $modele;
	private $vue;
	private $vueIndex;

	public function __construct(){
		$this->modele = new ModeleAdministrateur();
		$this->vue = new VueAdministrateur();
		$this->vueIndex = new VueIndex();
	}

	public function affichePanel(){
		$this->vue->affichePanel($this->modele->infoAnimes(),$this->modele->infoUsers(),$this->modele->infoClubs(),$this->modele->infoComs(),$this->modele->infoGenres());
	}
}
?>