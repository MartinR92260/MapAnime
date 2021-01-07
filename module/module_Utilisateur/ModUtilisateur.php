<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('ContUtilisateur.php');

class ModUtilisateur{

	private $controleur;

	public function __construct(){
		$this->controleur = new ContUtilisateur();
		if( isset($_SESSION['idUtilisateur']) ){
			if( isset($_GET['action']) ){
				$choix=htmlspecialchars($_GET['action']);
				switch($choix){
					case "ajoutListe":
						$this->controleur->ajouterListe();
					break;
                    case "supprListe":
                        $this->controleur->supprimerListe();
                    break;
                    case "afficheProfil":
                    	$this->controleur->profil();
                    break;
					default:
						echo $choix." Erreur Index : Action inexistant";
					break;
				}
			}
		}
		else{
			echo 'Erreur Connexion : Vous n\'êtes pas connecter';
		}
	}
}

$modUtilisateur = new ModUtilisateur();

?>