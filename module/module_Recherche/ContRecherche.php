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

	public function rechercheTousAnime(){
		$this->vue->rechercheTousFormat($this->modele->rFormat(),"Anime");
	}
	
	public function listeAnime(){
		$this->vue->affListe($this->modele->listeOeuvre());
	}

	public function listeDesClub(){
		$this->vue->affListeClub($this->modele->listeClub());
	}
}
?>