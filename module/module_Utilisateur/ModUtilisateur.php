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
						$id=htmlspecialchars($_GET['id']);
						$this->controleur->ajouterListe($id);
					break;
                    case "supprListe":
                    	$id=htmlspecialchars($_GET['id']);
                        $this->controleur->supprimerListe($id);
                    break;
                    case "afficheProfil":
                    	$this->controleur->profil();
                    break;
                   case "afficheOtherProfil":
                   		$id=htmlspecialchars($_GET['id']);
                    	$this->controleur->profilOther($id);
                    break;
                    case "afficheProfilAmi":
						$id=htmlspecialchars($_GET['id']);
						$this->controleur->profilAmi($id);
					break;
					default:
					?>
						<script type="text/javascript"> 
        					alert("Action Inexistante"); 
 		 				</script>
 		 			<?php
					break;
				}
			}
		}
		else{
		?>
			<script type="text/javascript"> 
       			alert("Non Connecter"); 
 		 	</script>
 		<?php
		}
	}
}

$modUtilisateur = new ModUtilisateur();

?>