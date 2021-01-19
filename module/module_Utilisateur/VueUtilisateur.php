<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
include_once('./VueIndex.php');

class VueUtilisateur extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Utilisateur/VueUtilisateur.css"/>';
    }

    public function affichageDuProfilUtilisateur($listeAnime,$listeInfoAmis){
        echo "<h1>profil de ".$_SESSION['pseudo']." : </h1>";
        echo '<h2>Liste d\'anime</h2>';
        if ($listeAnime){
            echo "<div>";
    			foreach ($listeAnime as $anime) {
    				echo "<a href=\"index.php?module=Anime&action=Anime&id=".$anime['idAnime']."\">".$anime['nom']."</a>";
				    echo '</br>';
    			}
    		echo "</div>";
        }
        else{
			echo "Votre liste est vide. N'ésitez pas a la remplir !";
		}
        echo '<h2>Liste d\'amis</h2>';
        foreach ($listeInfoAmis as $ami) {
            echo "<a href=\"index.php?module=Utilisateur&action=afficheProfilAmi&id=".$ami['idAmi']."\">".$ami['PhotoProfil'].$ami['pseudoAmi']."<br>"."</a>";
        }

        if($_SESSION['Admin']==1){
            echo "<h1>Interface d'administrateur : </h1>";
            echo "<a href=\"index.php?module=Anime&action=AjoutAnime\">Ajouter un anime</a>";
        }
    }

    public function affichageDuProfilDeAutreUtilisateur($id, $listeAnime,$listeInfoAmis){
        foreach($id as $key) {
            echo "<h1>profil de ".$key['pseudo']." : </h1>";
        }
        echo '<h2>Liste d\'anime</h2>';
        if ($listeAnime){
            echo "<div>";
                foreach ($listeAnime as $anime) {
                    echo "<a href=\"index.php?module=Anime&action=Anime&id=".$anime['idAnime']."\">".$anime['nom']."</a>";
                    echo '</br>';
                }
            echo "</div>";
        }
        else{
            echo "Votre liste est vide. N'ésitez pas a la remplir !";
        }
        echo '<h2>Liste d\'amis</h2>';
        foreach ($listeInfoAmis as $ami) {
            echo "<a href=\"index.php?module=Utilisateur&action=afficheProfilAmi&id=".$ami['idAmi']."\">".$ami['PhotoProfil'].$ami['pseudoAmi']."<br>"."</a>";
        }
    }

    public function affichageDuProfilAmi($arrayAnime, $infoProfil, $listeInfoAmis){
        echo "<h1>profil de ".$infoProfil['0']['pseudo']." : </h1>";
        echo '<h2>Liste d\'anime</h2>';
        if ($arrayAnime){
            echo "<div>";
                foreach ($arrayAnime as $anime) {
                    echo "<a href=\"index.php?module=Anime&action=Anime&id=".$anime['idAnime']."\">".$anime['nom']."</a>";
                    echo '</br>';
                }
            echo "</div>";
        }
        else{
            echo "La liste de votre ami est vide.";
        }

        echo '<h2>Liste d\'amis</h2>';
        foreach ($listeInfoAmis as $ami) {
            echo "<a href=\"index.php?module=Utilisateur&action=afficheProfilAmi&id=".$ami['idAmi']."\">".$ami['PhotoProfil'].$ami['pseudoAmi']."<br>"."</a>";
        }
    }

}
?>