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
	public function recherche(){
		$this->vue->rechercher($this->modele->listeGenre());
	}

	public function rechercheParNom(){
		$nomSaisie=htmlspecialchars($_POST['nomSaisie']);
		$this->vue->afficheParNom($this->modele->search($nomSaisie),$nomSaisie);
	}

	public function rechercheTousAnime(){
		$_POST['papier']=NULL;
		$_POST['anime']='default';
		$_POST['genre']=NULL;
		$this->vue->rechercheTousFormat($this->modele->rFormat(),"Anime");
	}
    
	public function rechercheTousPapier(){
		$_POST['papier']='default';
		$_POST['anime']=NULL;
		$_POST['genre']=NULL;
		$this->vue->rechercheTousFormat($this->modele->rFormat(),"Papier");
	}
    
	public function listeManga(){
		$this->vue->affListe($this->modele->listeOeuvre());
	}
    
}

?>