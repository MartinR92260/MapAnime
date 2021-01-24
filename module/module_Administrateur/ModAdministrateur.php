<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('ContAdministrateur.php');

class ModAdministrateur{

	private $controleur;

	public function __construct(){
		$this->controleur = new ContAdministrateur();
		if(isset($_SESSION['idUtilisateur']) && $_SESSION['Admin']==1){
			if( isset($_GET['action']) ){
				$choix=htmlspecialchars($_GET['action']);
				switch($choix){
					case "affichePanel":
                        $this->controleur->affichePanel();
					break;
					case "ajoutGenre":
                        $this->controleur->ajoutGenre();
					break;
					case "ajoutGenreEnCours":
                        $this->controleur->insertionGenre();
					break;
					case "modifGenre":
						$id=htmlspecialchars($_GET['id']);
                        $this->controleur->modifGenre($id);
					break;
					case "modifGenreEnCours":
						$id=htmlspecialchars($_GET['id']);
                        $this->controleur->modifGenreEnCours($id);
					break;
					case "supprGenre":
						$id=htmlspecialchars($_GET['id']);
						$this->controleur->supprGenre($id);
					break;
					case "modifUser":
						$id=htmlspecialchars($_GET['id']);
                        $this->controleur->modifUser($id);
					break;
					case "modifUserEnCours":
						$id=htmlspecialchars($_GET['id']);
                        $this->controleur->modifUserEnCours($id);
					break;
					case "supprUser":
						$id=htmlspecialchars($_GET['id']);
						$this->controleur->supprUser($id);
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

$modAdministrateur = new ModAdministrateur();

?>