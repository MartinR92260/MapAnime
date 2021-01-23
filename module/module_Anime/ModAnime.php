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
			$idAnime=htmlspecialchars($_GET['id']);
			$cont->detailAnime($idAnime);
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
		break;
	case "AjoutEnCours":
		$cont->InsertionAnime();
		break;
	case "SupprAnime":
		$idAnime=htmlspecialchars($_GET['id']);
		$cont->SuppresionAnime($idAnime);
		break;
	case "modifLaNote":
		$idAnime=htmlspecialchars($_GET['id']);
		$cont->modifLaNote($idAnime);
		break;
	case "modifEtat":
		$idAnime=htmlspecialchars($_GET['id']);
		$cont->modifEtat($idAnime);
		break;
	case "modifAnime":
		$idAnime=htmlspecialchars($_GET['id']);
		$cont->modifAnime($idAnime);
		break;

	default :
	   	?>
			<script type="text/javascript"> 
        		alert("Action Inexistante"); 
 		 	</script>
 		<?php
	break;
}

?>