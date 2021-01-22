<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
include_once('./VueIndex.php');

class VueUtilisateur extends VueIndex{

    public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Utilisateur/Vue_Utilisateurcss.css"/>';
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
            echo "<div class =\"DivAmi\">";
            echo "<a href=\"index.php?module=Utilisateur&action=afficheOtherProfil&id=".$ami['idAmi']."\">".$ami['PhotoProfil']."<h4>" .$ami['pseudoAmi']."</h4><br>"."</a>";
             echo "<a href=\"index.php?module=Utilisateur&action=envoyerMessage&id=".$ami['idAmi']."\">EnvoyerMesage</h4><br>"."</a>";
            echo "</div>";
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
            echo "<h1>Profil de ".$key['pseudo']." : </h1>";
        }

        echo "<div class =\"Anime\">";
        echo '<h2>Liste d\'anime</h2>';
        if ($listeAnime){
                foreach ($listeAnime as $anime) {
                    echo "<div class =\"DivAnime\">";
                    echo "<a href=\"index.php?module=Anime&action=Anime&id=".$anime['idAnime']."\"><img src=./images/Anime/".$anime['ImageAnime']." id=\"imageAnime\"/><h4>". $anime['nom']."</h4></a>";
                    echo '</br>';
                    echo "</div>";
                }
            echo "</div>";
        }
        else{
            echo "Votre liste est vide. N'hésitez pas a la remplir !";
        }

        echo "<div class =\"Ami\">";
        echo '<h2>Liste d\'amis</h2>';
        foreach ($listeInfoAmis as $ami) {
            echo "<div class =\"DivAmi\">";
            echo "<a href=\"index.php?module=Utilisateur&action=afficheOtherProfil&id=".$ami['idAmi']."\">".$ami['PhotoProfil']."<h4>" .$ami['pseudoAmi']."</h4><br>"."</a>";

            echo "</div>";
        }
        echo "</div>";

        if($_SESSION['idUtilisateur']!=$id['0']['idUtilisateur']){
            $amiOuPas=0;
            foreach ($listeAmiUtilisateur as $ami) {
                if($ami['idAmi']==$id['0']['idUtilisateur']){
                    $amiOuPas=1;
                }
            }
            echo "<div class =\"AjouterAmi\">";
            if($amiOuPas==1){
                echo "<a href=\"index.php?module=Utilisateur&action=supprAmi&id=".$id['0']['idUtilisateur']."\">Supprimer ami</a>"."<br>";
            }
            else{
                echo "<a href=\"index.php?module=Utilisateur&action=ajoutAmi&id=".$id['0']['idUtilisateur']."\">Ajouter en ami</a>" ."<br>";
            }
            echo "</div>";
        }
}

    public function pageMesssage($idUtilisateur,$message,$idAmi,$listeInfoAmi,$getMessage/*,$recepteur*/,$pseudoEnvoyeur){
    	
	   	foreach($listeInfoAmi as $key) {
	   		if($key['idAmi']==$idAmi){//$idAmi=id ami du mec sur qui on clique

        echo '<h2>Liste des messages envoyé a : '.$key['pseudoAmi']."</h4>";

       }
   		}


	   		foreach($getMessage as $mess) {

		   		foreach($pseudoEnvoyeur as $user) {

		   			/*if($mess['idAmi']==$idAmi && $mess['idUtilisateur']==$_SESSION['idUtilisateur']  ){
		   				echo":".$_SESSION['pseudo'].":".$mess['contenu']."</br>";
		  		 	}

		  		 	else if($mess['idAmi']==$_SESSION['idUtilisateur'] && $mess['idUtilisateur']==$idAmi) {
		  		 		echo":".$user['pseudo'].":".$mess['contenu']."</br>";

		  		 	}
		  		 */

		  		 	if($mess['idUtilisateur']==$_SESSION['idUtilisateur']) {
		  		 		echo":".$_SESSION['pseudo'].":".$mess['contenu']."-"
		  		 		.$mess['Heure']."<p>"
		  		 		.$mess['Date']."</p>";
		  		 	}

		  		 	else{
		  		 		echo":".$user['pseudo'].":".$mess['contenu']." 
			          	-".$mess['Heure']."
			         	<p>".$mess['Date']."</p>";

		  		 	}

		   		}
		   					   	
	   		}


	   		
	   			echo"<div class=\"form-commentaire\">
	            	<form action=\"index.php?action=AddCommentaire&module=Utilisateur&id=".$idAmi."\" method=\"post\">
	            		<label for=\"message\">
                        <h2>Envoyer un message : <h2>
	            		</label>
	            		<textarea name=\"commentaireV22\" placeholder=\"inserez votre message\"></textarea><br/>
                        <input type=\"submit\" value=\"valider\">
	            	</form>
	            </div> 
	        </div>";

	
	
 			


    }



}
?>