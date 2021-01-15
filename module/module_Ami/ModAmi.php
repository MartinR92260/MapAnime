<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('ContAmi.php');

class ModAmi{

	private $controleur;

	public function __construct(){
		$this->controleur = new ContAmi();
		if( isset($_SESSION['idAmi']) ){
			if( isset($_GET['action']) ){
				$choix=htmlspecialchars($_GET['action']);
				switch($choix){
					case "":
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
	}
}

$modAmi = new ModAmi();

?>