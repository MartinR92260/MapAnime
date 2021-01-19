<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
include_once('./VueIndex.php');

class VueUtilisateur extends VueIndex{

    public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Utilisateur/VueUtilisateurcss.css"/>';
    }

    public function affichageDuProfilUtilisateur($listeAnime,$listeInfoAmis){
        echo "<h1>Profil de ".$_SESSION['pseudo']." : </h1>";
        echo "<div class =\"Anime\">";
        echo '<h2>Liste d\'anime</h2>';
        if ($listeAnime){
                foreach ($listeAnime as $anime) {
                    echo "<div class =\"DivAnime\">";
                    echo "<a href=\"index.php?module=Anime&action=Anime&id=".$anime['idAnime']."\"><img src=./images/Anime/".$anime['ImageAnime']." id=\"imageAnime\"/><h4>". $anime['nom']."</h4></a>";
                    echo "</div>";
                }
            echo "</div>";

        }
        else{
            echo "Votre liste est vide. N'ésitez pas a la remplir !";
        }

        echo "<div class =\"Ami\">";
        echo '<h2>Liste d\'amis</h2>';
        foreach ($listeInfoAmis as $ami) {
            echo "<a href=\"index.php?module=Utilisateur&action=afficheOtherProfil&id=".$ami['idAmi']."\">".$ami['PhotoProfil'].$ami['pseudoAmi']."<br>"."</a>";
            echo '</br>';
        }
        echo "</div>";

        echo "<div class =\"Admin\">";
        if($_SESSION['Admin']==1){
            echo "<h1>Interface d'administrateur : </h1>";
            echo "<a href=\"index.php?module=Anime&action=AjoutAnime\">Ajouter un anime</a>";
        }
        echo "</div>";
    }

    public function affichageDuProfilDeAutreUtilisateur($id, $listeAnime,$listeInfoAmis,$listeAmiUtilisateur){
        foreach($id as $key) {
            echo "<h1>profil de ".$key['pseudo']." : </h1>";
        }

        if($_SESSION['idUtilisateur']!=$id['0']['idUtilisateur']){
            $amiOuPas=0;
            foreach ($listeAmiUtilisateur as $ami) {
                if($ami['idAmi']==$id['0']['idUtilisateur']){
                    $amiOuPas=1;
                }
            }
            if($amiOuPas==1){
                echo "<a href=\"index.php?module=Utilisateur&action=supprAmi&id=".$id['0']['idUtilisateur']."\">Supprimer ami</a>"."<br>";
            }
            else{
                echo "<a href=\"index.php?module=Utilisateur&action=ajoutAmi&id=".$id['0']['idUtilisateur']."\">Ajouter en ami</a>" ."<br>";
            }
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
            echo "<a href=\"index.php?module=Utilisateur&action=afficheOtherProfil&id=".$ami['idAmi']."\">".$ami['PhotoProfil'].$ami['pseudoAmi']."<br>"."</a>";
        }
    }
}
?>