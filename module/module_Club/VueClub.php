<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
include_once('./VueIndex.php');

class VueClub extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_club/VueClub.css"/>';
    }

    public function afficheButtonRejoindre(){
		echo "<a href=\"index.php?module=Club&action=Rejoindre\"><input type=\"button\" name=\"join\" value=\"Rejoindre le Club\" class=\"joinClub\"/></a>";
	 }

	public function afficheButtonQuitter(){
		echo "<a href=\"index.php?module=Club&action=Quitter\"><input type=\"button\" name=\"quit\" value=\"Quitter le Club\" class=\"quitClub\"/></a>";
	}

	public function afficheNbAdherent() {
		echo "<a href=\"index.php?module=Club&id=".$Club['idClub']."\">".$Club['nbUtilisateur']."</a>";
		echo '</br>';
	}

	public 	function afficheCommentaire($commentaires){
        echo"<div class=\"FormCommentaires\">
	        <form action=\"index.php?module=Club&action=AjouterCommentaire&id=".$key['idClub']."\" method=\"post\">
	        <label for=\"Commentaires\">
                <h1>Messages du Club : <h1>
	            </label>
	            <textarea name=\"Commentaires\" placeholder=\"Postez votre message :\"></textarea><br/>
                <input type=\"submit\" value=\"Confirmer\">
	        </form>
	        </div>";
		if($commentaires!=NULL){
			echo "<div class=\"ListeCommentaires\">";
				foreach ($commentaires as $key) {
		            echo "<div class=\"Commentaires\">
		            	<div class=\"headerCommentaires\">"
			            	.$key['pseudo'];
			        if(isset($_SESSION['idUtilisateur'])){
				        if ($key['idUtilisateur'] == $_SESSION['idUtilisateur']){
				        	echo "<a href=\"index.php?module=Club&action=SupprimerCommentaire&id=".$key['idCommentaire']."\">Supprimer</a>";
				        }				    
				    }
			        echo "</div><p>".$key['commentaires']."</p></div>";
		        }
	    	echo "</div>";
		}
	}
}
?>