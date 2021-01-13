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
					$id=htmlspecialchars($_GET['id']);
					$this->cont->supprimerCommentaire($id);
				break;
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
