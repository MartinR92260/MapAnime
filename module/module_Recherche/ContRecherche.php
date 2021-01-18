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
<<<<<<< Updated upstream
/*
	public function listeAnimeRecommander(){
		$this->vue->afficheAnimeRecommander($this->modele->listeAnimeRecommancer($this->modele->listeGenreAnimeUtilisateur($this->modele->listeAnimeUtilisateur())));
	}*/
=======

	public function formRechercheUtilisateur(){
		$this->vue->rechercherUser();
	}

	public function rechercheParUser(){
		$nomSaisie=htmlspecialchars($_POST['nomSaisie']);
		$this->vue->afficheListeUser($this->modele->searchNomUser($nomSaisie));
	}
<<<<<<< Updated upstream
=======

	public function listeDesClub(){
		$_POST['club']='default';
		$this->vue->affListeClub($this->modele->listeClub());
	}
    
}
>>>>>>> Stashed changes

>>>>>>> Stashed changes
}
?>