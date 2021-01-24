<?php

include_once('./VueIndex.php');

class VueAnime extends VueIndex{

	public function __construct(){
		echo '<link rel="stylesheet" type="text/css" href="module/module_Anime/Anime.css"/>';
	}

    public function afficheAnime($arrayAnime,$arrayGenre,$arrayCommentaires,$arrayListe,$idAnime){




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
		   			echo '/20';
		   					echo "<br/>




		   
				<h2> Nombre de personne ayant cette Animé dans leurs liste :</h2>".$key['Popularite']."


                    <h2>Sysnopsis :</h2>".$key['synopsis']."
				</div><br/>";
            


               			echo "<div class=\"test\">"; 
				 

				if(isset($_SESSION['idUtilisateur'])) {
					if(!$idAnime==NULL){
                    	echo "<a href=\"index.php?module=Utilisateur&action=supprListe&id=".$key['idAnime']."\">Supprimer a la liste</a>"."<br>";

               
								        
						echo'<form action=index.php?action=modifLaNote&module=Anime&id='.$key['idAnime'].' method="post">

						    <select name="noteSelec" size="1">
						    <option value="-1">PasDeNote
						    <option value="1">1
						    <option value="2">2
						    <option value="3">3
						    <option value="4">4
						    <option value="5">5
						    <option value="6">6
						    <option value="7">7
						    <option value="8">8
						    <option value="9">9
						    <option value="10">10 
						    <option value="11">11
						    <option value="12">12
						    <option value="13">13
						    <option value="14">14
						    <option value="15">15
						    <option value="16">16
						    <option value="17">17
						    <option value="18">18
						    <option value="19">19
						    <option value="20">20
						    </select>

							<input type="submit" value="Valider" />



						</form>';


			


				foreach($idAnime as $idA) {	

			

				if(!$idAnime==NULL){
					
		   			echo" Votre Note: "
		   			.$idA['note'];
		   			echo '/20';
		   			echo "<br/>";

		   			echo" Etat: "
		   			.$idA['etat'];
		   			echo "<br/>";


		   		}
				}	

						echo'<form action=index.php?action=modifEtat&module=Anime&id='.$key['idAnime'].' method="post">

						<select name="etatSelec" size="1">
						    <option value="ARegarder">ARegarder
						    <option value="EnCour">EnCour
						    <option value="Completer">Completer
						    </select>

						    <input type="submit" value="Valider" />
						</form>';
                    }
                    
                    else{
                    	echo "<a href=\"index.php?module=Utilisateur&action=ajoutListe&id=".$key['idAnime']."\">Ajouter de la liste</a>" ."<br>";
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
				
			         echo "</div><p>".$key['contenu']."</p>";
			         echo "<div class=\"DivDate\">
			          <p>".$key['Date']."  ".$key['Heure']."</p></div>";
			          echo "</div>";
		        }
	    	echo "</div>";
		}
	}

	public function formulaireAnime(){
		echo "<div class =\"Formulaire\">";
		echo '<form action="index.php?action=AjoutEnCours&module=Anime" method="post" enctype="multipart/form-data">
				<label>Entrer le titre : </label><br/>
			 	<input type="text" name="nom" required><br/>
			 	<label>Entrer le synopsis : </label><br/>
				<input type="text" name="synopsis" required><br/>
				<label>Entrer le nombre de saison : </label><br/>
		 		<input type="number" min="0" name="nbSaisons"><br/>
		 		<label>Entrer le nombre total d\'épisode : </label><br/>
		 		<input type="number" min="0" name="nbEpisodes"><br/>   
					<label>Image de l\'Anime:</label>';
				    echo "<div class =\"FormulaireImage\">";
				    echo '<input type="file" name="ImageAnime">';
				    echo "</div>";
				    echo '<input type="submit" name="submit" value="Ajouter">

			</form>';
			echo "</div>";
	}

	public function formulaireUpdateAnime($id){
		echo "<div class =\"Formulaire\">";
		echo "<form action=\"index.php?action=modifAnimeEnCours&module=Anime&id=".$id."\" method=\"post\" enctype=\"multipart/form-data\">
				<label>Entrer le titre : </label><br/>
			 	<input type=\"text\" name=\"nom\"><br/>

				<label>Entrer le nombre de saison : </label><br/>
		 		<input type=\"number\" min=\"0\" name=\"nbSaisons\"><br/>

		 		<label>Entrer le nombre total d'épisode : </label><br/>
		 		<input type=\"number\" min=\"0\" name=\"nbEpisodes\"><br/>   
					<label>Image de l'Anime:</label>";
				    echo "<div class =\"FormulaireImage\">";
				    echo '<input type="file" name="ImageAnime">';
				    echo "</div>";
				    echo '<input type="submit" name="submit" value="Ajouter">

			</form>';
			echo "</div>";
	}
}

?>