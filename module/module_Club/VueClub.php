<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
include_once('./VueIndex.php');

class VueClub extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_club/Vue_Club.css"/>';
    }

    public function afficheButtonRejoindre(){
		echo "<div class =\"Rejoindre\">
		<a href=\"index.php?module=Club&action=Rejoindre&id=?\"><input type=\"button\" name=\"join\" value=\"Rejoindre le Club\" class=\"joinClub\"/></a>";
	 }

	public function afficheButtonQuitter(){
		echo "<a href=\"index.php?module=Club&action=Quitter&id=?\"><input type=\"button\" name=\"quit\" value=\"Quitter le Club\" class=\"quitClub\"/></a>";
	}

	public function afficheNbAdherent($nombre) {
		foreach ($nombre as $nb) {
			echo "<div class =\"NombreAdherent\">
			<p> Nombre d'Adherent : ".$nb['nbUtilisateur']."</p>";
		}
	}

	public 	function afficheCommentaire($commentaires){
	        echo"<div class=\"FormCommentaires\">
		        <form action=\"index.php?module=Club&action=Club&id= ? method=\"post\">
		        <label for=\"Commentaires\">
	                <h1>Messages du Club : <h1>
		            </label>
		        </form>
		        </div>";
		    echo "<div class=\"PosterCommentaire\">
		    		<textarea name=\"Commentaires\" placeholder=\"Postez votre message :\"></textarea><br/>
	                <a href=\"index.php?action=AjouterCommentaire&module=Club&id=?\"><input type=\"submit\" value=\"Confirmer\">
	                </a>
	              </div>";

			if($commentaires!=NULL){
				echo "<div class=\"ListeCommentaires\">";
					foreach ($commentaires as $key) {
			            echo "<div class=\"Commentaires\">
			            	<div class=\"headerCommentaires\">"
				            	.$key['pseudo'];
				        if(isset($_SESSION['idUtilisateur'])){
					        if ($key['idUtilisateur'] == $_SESSION['idUtilisateur']){
					        	echo "<a href=\"index.php?module=Club&action=SupprimerCommentaire&id=".$key['idCommentaire']."\">   Supprimer</a>";
					        }				    
					    }
				        echo "<div class =\"headerDetails\">"
					        .$key['Date']
					        .$key['Heure'];
				        echo "</div>
				        <p>".$key['contenu']."</p></div>";
			        }
		    	echo "</div>";
			}
	}
}
?>