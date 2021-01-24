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

	public function ajouterListe($id){
			$this->vueIndex->result($this->modele->addToliste($id));
			$this->modele->refreshPop($this->modele->popularite($id),$id);
	}

    public function supprimerListe($id){
			$this->vueIndex->result($this->modele->delToliste($id));
			$this->modele->refreshPop($this->modele->popularite($id),$id);
	}
    
    public function profil(){
		$this->vue->affichageDuProfilUtilisateur($this->modele->requestListe(),$this->modele->listeAmis(),$this->modele->utili());
	}

	public function profilOther($id){
		$this->vue->affichageDuProfilDeAutreUtilisateur($this->modele->getUser($id), $this->modele->requestListeDeAutreUtilisateur($id),$this->modele->listeAmisDeAutreUtilisateur($id),$this->modele->listeAmis());
	}

	public function ajouterListeAmi($id){
		$this->modele->addTolisteAmi($id);
	}

	public function supprimerListeAmi($id){
		$this->modele->delTolisteAmi($id);
	}

	public function envoyerMessageAmi($id){
		$this->vue->pageMesssage($id,$this->modele->listeAmis(),$this->modele->getMessage($id),$this->modele->getPseudoSenderMessage($id));
	}

	

	public function insererMessage($idAmi){
	 
	    	$this->modele->insertionMessage($idAmi);
	    	$this->envoyerMessageAmi($idAmi);



    }

   
}
?>