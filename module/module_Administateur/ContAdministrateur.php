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

	
}
?>