<?php

include_once('./VueIndex.php');

class VueAnime extends VueIndex{

	public function __construct(){
		echo '<link rel="stylesheet" type="text/css" href="module/module_Anime/VueAnime.css"/>';
	}

    public function afficheAnime($arrayAnime,$arrayGenre,$arrayCommentaires,$arrayListe){
    	foreach ($arrayAnime as $key) {

    		echo"TEST CLICK ANIME";

    		echo 
    		"<div class=\"Anime\">
	    		<h1>". $key['nom']."</h1>
	    		<img src=./icone/".$key['image']." id=\"imageAnime\"/>
	    		<img src=./Images/Anime/".$key['image']." id=\"imageAnime\"/>



	    		<div class=\"infoAnime\"> 
		    		<h3> Note :</h3>";
		       		for($i = 0; $i<$key['note'];$i++){
		   				echo "&#9733";
		   			}
		   			for($i = 0;$i<10-$key['note'];$i++){
		   				echo "&#9734";
		   			}
		   			echo "<br/>";
		   			/*echo "<h2>Manga : </h2>";
					if($key['nbVolume']!=NULL || $key['nbVolume']!=0){
						echo "<h3>Nombre de Volume :</h3>".$key['nbVolume']."<br/>";
					}
					if($key['nomAuteur']!=NULL){
						echo "<h3>Auteur :</h3> ".$key['nomAuteur']."<br/>
						<br/>";
					}*/
					echo "<h2>Anime : </h2>";
					
					if($key['nbSaison']!=NULL || $key['nbSaison']!=0){
						echo "<h3>Nombre de Saison :</h3> ".$key['nbSaison']."<br/>";//!!! AJOUTER NB EPISODE ET NB SAISON A LA BD
					}
					if($key['nbEpisode']!=NULL || $key['nbEpisode']!=0){
						echo "<h3>Nombre total d'épisode :</h3> ".$key['nbEpisode']."<br/>";//!!! AJOUTER NB EPISODE ET NB SAISON A LA BD
					}
					/*if($key['nomStudio']!=NULL){
						echo "<h3>Nom du Studio d'Animation :</h3> ".$key['nomStudio']."<br/>";
					}
					echo "<br/>";*/

					if($arrayGenre){
						echo "<h2>Genre :</h2></br>";
						foreach ($arrayGenre as $keyG) {
							echo " - ".$keyG['NomGenre']."</br>";
						}
					}
                echo "</div><br/>
                <div class=\"synAnime\">
                    <h2>Sysnopsis :</h2>".$key['synopsis']."
				</div><br/>";//!!!A AJOUTER DANS LA BD
            
				if(isset($_SESSION['idUtilisateur'])) {
					if($arrayListe){
                    	echo "<a href=\"index.php?module=Utilisateur&action=supprListe&id=".$key['idAnime']."\">Supprimer a la liste</a>";
                    }
                    else{
                    	echo "<a href=\"index.php?module=Utilisateur&action=ajoutListe&id=".$key['idAnime']."\">Ajouter a la liste</a>";
                    }
					
                    //SUPPR DE   if($arrayFav){ A </script> et <?php

				}
            
	            echo"<div class=\"form-commentaire\">
	            	<form action=\"index.php?action=AddCommentaire&module=Anime&id=".$key['idAnime']."\" method=\"post\">
	            		<label for=\"commentaire\">
                        <h2>Commentaires : <h2>
	            		</label>
	            		<textarea name=\"commentaire\" placeholder=\"inserez votre commentaire\"></textarea><br/>
                        <input type=\"submit\" value=\"valider\">
	            	</form>
	            </div> 
	        </div>";
		}
		if($arrayCommentaires!=NULL){
			echo "<div class=\"ListeCom\">";
				foreach ($arrayCommentaires as $key) {
		            echo 
		            "<div class=\"commentaire\">
		            	<div class=\"headerCommentaire\">"
			            	.$key['pseudo'];
			        if(isset($_SESSION['idUtilisateur'])){
				        if ($key['idUtilisateur'] == $_SESSION['idUtilisateur'] || $_SESSION['idRole'] <= 2){//idrole = admin?
				        	echo "<a href=\"index.php?action=DelCommentaire&module=Anime&id=".$key['idCommentaire']."\">supprimer</a>";
				        }				    
				    }
			        echo "</div><p>".$key['commentaire']."</p></div>";
		        }
	    	echo "</div>";
		}
	}

	public function formulaireAnime(){
		echo '<form action="index.php?action=AjoutEnCours&module=Anime" method="post">
				<label>Entrer le titre : </label><br/>
			 	<input type="text" name="nom" required><br/>
			 	<label>Entrer le synopsis : </label><br/>
				// <input type="text" name="synopsis" required><br/>
				<label>Entrer la note : </label><br/>
		 		<input type="number" min="0" max="10" name="noteG" required><br/>
				/*    <label>Entrer le nombre de saison : </label><br/>
		 		<input type="number" min="0" name="nbSaison"><br/>
		 		<label>Entrer le nombre total d\'épisode : </label><br/>
		 		<input type="number" min="0" name="nbTotalEp"><br/>
			 	<label>Entrer le nom du studio d\'animation : </label><br/>
				<input type="text" name="Studio"><br/>    */
				<input type="submit" value="Ajouter">
			</form>';
	}
}

?>