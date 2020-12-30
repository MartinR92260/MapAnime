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
					$this->controleur->rechercheParBar();
					break;
				case "parGenre":
					$this->controleur->rechercheParGenre();
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