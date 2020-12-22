<?php

require_once('ContAnime.php');

$cont = new ContAnime;

if(isset($_GET['action'])){
	$menu=htmlspecialchars($_GET['action']);
}else{
	$menu="liste";
}
switch($menu){
	case "Anime":
		if(isset($_GET['id'])){
			$idOe=htmlspecialchars($_GET['id']);
			$cont->detailAnime($idOe);//detailAnime
		}else{
			echo "You are not supposed to be here.";
		}
		break;
    case "AddCommentaire":
		$idCo=htmlspecialchars($_GET['id']);
        $cont->insererCommentaire($idCo);
        break;
    case "DelCommentaire":
    	$idCo=htmlspecialchars($_GET['id']);
        $cont->supprimerCommentaire($idCo);
    	break;
    case "AjoutAnime":
		$cont->AjoutAnime();
		break;*/
	case "AjoutEnCours":
		$cont->InsertionAnime();
		break;
	case "SupprAnime":
		$idOe=htmlspecialchars($_GET['id']);
		$cont->SuppresionAnime($idOe);//supressionAnime
		break;
	default :
		die("Action impossible");
	break;
}

?>