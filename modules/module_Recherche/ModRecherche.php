<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
require_once('ContRecherche.php');

class ModRecherche{

	private $controleur;

	public function __construct(){
		$this->controleur = new ContRecherche();
		if( isset($_GET['action']) ){
			$choix=htmlspecialchars($_GET['action']);
			switch($choix){
				case "parNom":
					$this->controleur->rechercheParNom();
					break;
				case "anime":
					$this->controleur->rechercheTousAnime();
					break;
				case "papier":
					$this->controleur->rechercheTousPapier();
					break;
				case "recherche":
					$this->controleur->recherche();
					break;
				case "liste":
					$this->controleur->listeManga();
					break;
				default:
					echo $choix." Erreur Index : Action inexistant";
				break;
			}
		}
	}
}

$modRecherche = new ModRecherche();

?>