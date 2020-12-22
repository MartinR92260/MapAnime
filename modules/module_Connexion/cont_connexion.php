<?php
include 'VueConnexion.php';
include 'ModeleConnexion.php';
if (!defined('CONST_INCLUDE')){
    die('Accès direct interdit');
}
	class ContConnexion{
        
		protected $modeleConnexion;
		protected $vueConnexion;
        
		public function __construct(){
			$this->modeleConnexion = new ModeleConnexion();
			$this->vueConnexion = new VueConnexion();
		}
        
		function formulaire() {
			$this->vueConnexion->afficheForm();
		}

		function connexion() {
			$this->modeleConnexion->verifConnexion();
		}

		function deconnexion(){
			$this->modeleConnexion->deconnexion();
		}
        
		function formulaireInscription(){
			$this->vueConnexion->afficheFormInscription();
		}

		function Inscription(){
			$this->vueConnexion->result($this->modeleConnexion->Inscription());
                
		}
	}

?>