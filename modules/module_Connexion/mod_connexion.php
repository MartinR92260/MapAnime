<?php
if (!defined('CONST_INCLUDE')){
    die('Accès direct interdit');
}
	include 'cont_connexion.php';


	$controleur = new ContConnexion();

	
			if(isset($_GET['action'])){
				$action =  $_GET['action'];
			}

		switch($action){
			case 'form':
					$controleur->formulaire();//!!!
					break;
			case 'connexion':
					$controleur->connexion();
					break;
			case 'deconnexion':
					$controleur->deconnexion();	
				break;
       		case 'inscription':
					$controleur->inscription();
				break;
			case 'formInscription':
					$controleur->formulaireInscription();
					break;
			default :
					$controleur->formulaire();//!!!
				break;
			}
?>
