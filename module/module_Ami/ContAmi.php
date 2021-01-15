<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('ModeleAmi.php');
require_once('VueAmi.php');

class ContAmi{

	private $modele;
	private $vue;
	private $vueIndex;

	public function __construct(){
		$this->modele = new ModeleAmi();
		$this->vue = new VueAmi();
		$this->vueIndex = new VueIndex();
	}
}

?>