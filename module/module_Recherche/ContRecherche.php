<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
require_once('ModeleRecherche.php');
require_once('VueRecherche.php');

class ContRecherche{

	private $modele;
	private $vue;

	public function __construct(){
		$this->modele = new ModeleRecherche();
		$this->vue = new VueRecherche();
	}
    
    public function rechercheParBar(){
		$nomSaisie=htmlspecialchars($_POST['nomSaisie']);
		$this->vue->afficheParNom($this->modele->search($nomSaisie),$nomSaisie);
	}
	
    public function rechercheParGenre(){
		$this->vue->rechercher($this->modele->listeGenre());
	}
	
	public function listeDesAnime(){
		$this->vue->afficheListeAnime($this->modele->listeAnime());
	}

	public function listeDesClub(){
		$this->vue->afficheListeClub($this->modele->listeClub());
	}

}
?>