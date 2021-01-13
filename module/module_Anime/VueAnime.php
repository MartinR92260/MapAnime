<?php

include_once('./VueIndex.php');

class VueAnime extends VueIndex{

	public function __construct(){
		echo '<link rel="stylesheet" type="text/css" href="module/module_Anime/csspls.css"/>';
	}

    public function afficheAnime($arrayAnime,$arrayGenre,$arrayCommentaires,$arrayListe){




    	foreach ($arrayAnime as $key) {


    		echo 
    		"<div class=\"Anime\">
	    		<h1>". $key['nom']."</h1>
	    		
	    		<img src=./images/Anime/".$key['ImageAnime']." id=\"imageAnime\"/>



	    		<div class=\"infoAnime\"> 

	    	
		   			
		    		 <div class=\"synAnime\">

		    		 

		    	 <h2> Genre :</h2>";


		    		 if($arrayGenre){
						/*echo "<h2>Genre :</h2></br>";*/
						foreach ($arrayGenre as $keyG) {
							echo " - ".$keyG['NomGenre']."</br>";
						}
					}

					echo "<br/>


		    	 <h2> NoteG :</h2>"

		   			.$key['NoteG'];
		   			echo '/10';
		   					echo "<br/>


                    <h2>Sysnopsis :</h2>".$key['synopsis']."
				</div><br/>";
            


               			echo "<div class=\"test\">"; 
				 

				if(isset($_SESSION['idUtilisateur'])) {
					if($arrayListe){
                    	echo "<a href=\"index.php?module=Utilisateur&action=supprListe&id=".$key['idAnime']."\">Supprimer a la liste</a>";
                    }
                    else{
                    	echo "<a href=\"index.php?module=Utilisateur&action=ajoutListe&id=".$key['idAnime']."\">Ajouter a la liste</a>" ."<br>";
                    }
					

				        if ($_SESSION['Admin'] == 1){
				        	echo "<a href=\"index.php?action=SupprAnime&module=Anime&id=".$key['idAnime']."\">Supprimer</a>";
				        }				    
				    	
				}

                echo "</div><br/>
                </div>
                <div class=\"synAnime\">
             
		   			
		   		
					 <h2>Anime : </h2>";
					
					if($key['nbSaisons']!=NULL || $key['nbSaisons']!=0){
						echo "<h3>Nombre de Saison :</h3> ".$key['nbSaisons']."<br/>";
					}
					if($key['nbEpisodes']!=NULL || $key['nbEpisodes']!=0){
						echo "<h3>Nombre total d'épisode :</h3> ".$key['nbEpisodes']."<br/>";
					}
					/*if($key['nomStudio']!=NULL){
						echo "<h3>Nom du Studio d'Animation :</h3> ".$key['nomStudio']."<br/>";
					}
					echo "<br/>";*/

					
					








            
	            echo"<div class=\"form-commentaire\">
	            	<form action=\"index.php?action=AddCommentaire&module=Anime&id=".$key['idAnime']."\" method=\"post\">
	            		<label for=\"commentaire\">
                        <h2>Commentaires : <h2>
	            		</label>
	            		<textarea name=\"commentaireV2\" placeholder=\"inserez votre commentaire\"></textarea><br/>
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
				        if ($key['idUtilisateur'] == $_SESSION['idUtilisateur'] || $_SESSION['Admin'] == 1){
				        	echo "<a href=\"index.php?action=DelCommentaire&module=Anime&id=".$key['idCommentaire']."\">Supprimer</a>";
				        }				    
				    }
			        echo "</div><p>".$key['contenu']."</p></div>";
		        }
	    	echo "</div>";
		}
	}

	public function formulaireAnime(){
		echo '<form action="index.php?action=AjoutEnCours&module=Anime" method="post">
				<label>Entrer le titre : </label><br/>
			 	<input type="text" name="nom" required><br/>
			 	<label>Entrer le synopsis : </label><br/>
				<input type="text" name="synopsis" required><br/>
				
				    <label>Entrer le nombre de saison : </label><br/>
		 		<input type="number" min="0" name="nbSaisons"><br/>
		 		<label>Entrer le nombre total d\'épisode : </label><br/>
		 		<input type="number" min="0" name="nbEpisodes"><br/>   
				<input type="submit" value="Ajouter">
			</form>';
	}
}
/*<label>Entrer la note : </label><br/>
		 		<input type="number" min="0" max="10" name="noteG" required><br/>*/
?>