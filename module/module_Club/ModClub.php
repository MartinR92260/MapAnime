<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('ContClub.php');

class ModClub{

	private $cont;

	public function __construct(){
		$this->cont = new ContClub();
		if( isset($_GET['action']) ){
			$choix=htmlspecialchars($_GET['action']);
			switch($choix){
				case "Club":
					$id=htmlspecialchars($_GET['id']);
					$this->cont->detailClub($id);
				break;
				case "Rejoindre":
					$id=htmlspecialchars($_GET['id']);
					$this->cont->addClub($id);
				break;
				case "Quitter":
					$id=htmlspecialchars($_GET['id']);
					$this->cont->removeClub($id);
				break;
				case "AjouterCommentaire":
					$id=htmlspecialchars($_GET['id']);
					$this->cont->insererCommentaire($id);
				break;
				case "SupprimerCommentaire":
					$idCo=htmlspecialchars($_GET['idCo']);
					$idClub=htmlspecialchars($_GET['idClub']);
					$this->cont->supprimerCommentaire($idCo,$idClub);
				break;
				case "AjoutClub":
					$this->cont->AjouterClub();
				break;
				case "AjoutEnCours":
					$this->cont->InsertionClub();
				break;
				case "SupprClub":
					$idClub=htmlspecialchars($_GET['id']);
					$this->cont->SuppressionClub($idClub);
				break;
				case "modifClub":
					$idClub=htmlspecialchars($_GET['id']);
					$this->cont->modifClub($idClub);
				break;
				case "modifClubEnCours":
					$idClub=htmlspecialchars($_GET['id']);
					$this->cont->modifClubEnCours($idClub);
				break;
/*				case "Bannir":
					$idUser=htmlspecialchars($_GET['idUser']);
					$idClub=htmlspecialchars($_GET['idClub']);
					$this->cont->banUser($idClub, $idUser);
				break;*/
				default :
					?>
						<script type="text/javascript"> 
        					alert("Action Inexistante"); 
 		 				</script>
 		 			<?php
				break;
			}
		}
	}
}

$modClub = new ModClub();

?>
