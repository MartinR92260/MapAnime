<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
include_once('./VueIndex.php');

class VueUtilisateur extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Utilisateur/VueUtilisateur.css"/>';
    }

    public function affichageDuProfilUtilisateur($result){
    	echo "<h1>profil de ".$_SESSION['pseudo']." : </h1>";
        echo '<h2>Liste d\'anime</h2>';
        if ($result){
            echo "<div>";
    			foreach ($result as $anime) {
    				echo "<a href=\"index.php?module=Anime&action=Anime&id=".$anime['idAnime']."\">".$anime['nom']."</a>";
				    echo '</br>';
    			}
    		echo "</div>";
        }
        else{
			echo "Votre liste est vide. N'ésitez pas a la remplir !";
		}

        if($_SESSION['Admin']==1){
            echo "<h1>Interface d'administrateur : </h1>";
            echo "<a href=\"index.php?module=Anime&action=AjoutAnime\">Ajouter un anime</a>";
        }
    }

}
?>