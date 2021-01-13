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

    public function rechercheParGenre(){
		$this->vue->afficheListeAnime($this->modele->searchGenre());
    }

    public function rechercheParBar(){
		$nomSaisie=htmlspecialchars($_POST['nomSaisie']);
		$this->vue->afficheListeAnime($this->modele->searchNom($nomSaisie));
	}
	
    public function formRecherche(){
		$this->vue->rechercher($this->modele->listeGenre());
	}
	
	public function listeDesAnime(){
		$this->vue->afficheListeAnime($this->modele->listeAnime());
	}

	public function topDesAnime(){
		$this->vue->afficheTopAnime($this->modele->topAnime());
	}

	public function topDesAnimeNote(){
		$this->vue->afficheTopAnimeNote($this->modele->topAnimeNote());
	}

	public function listeDesClub(){
		$this->vue->afficheListeClub($this->modele->listeClub());
	}

}
?>