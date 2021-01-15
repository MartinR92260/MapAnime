<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
include_once('./VueIndex.php');

class VueClub extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_club/Club_css.css"/>';
    }

    public function afficheButtonRejoindre($idClub){
    	foreach ($idClub as $id) {
			echo "<div class =\"Rejoindre\">
			<a href=\"index.php?module=Club&action=Rejoindre&id=".$id['idClub']."\"><input type=\"button\" name=\"join\" value=\"Rejoindre le Club\" class=\"joinClub\"/></a>";
		}
	 }

	public function afficheButtonQuitter($idClub){
		foreach ($idClub as $id) {
			echo "<a href=\"index.php?module=Club&action=Quitter&id=".$id['idClub']."\"><input type=\"button\" name=\"quit\" value=\"Quitter le Club\" class=\"quitClub\"/></a>";
		}
	}

	public function afficheNbAdherent($nombre) {
		foreach ($nombre as $nb) {
			echo "<div class =\"NombreAdherent\">
			<p> Nombre d'Adherent : ".$nb['nbUtilisateur']."</p>";
		}
	}

	public 	function afficheCommentaire($commentaires, $club){
		foreach($club as $key) {
	        echo"<div class=\"FormCommentaires\">
		        <form action=\"index.php?action=AjouterCommentaire&module=Club&id=".$key['idClub']."\" method=\"post\">
		        <label for=\"commentaire\">
                        <h2>Messages du Club : <h2>
	            		</label>
	            		<textarea name=\"comm\" placeholder=\"inserez votre commentaire\"></textarea><br/>
                        <input type=\"submit\" value=\"valider\">
	            	</form>
	            </div> 
	        </div>";
		
}
			if($commentaires!=NULL){
				echo "<div class=\"ListeCommentaires\">";
					foreach ($commentaires as $key) {
			            echo "<div class=\"Commentaires\">
			            	<div class=\"headerCommentaires\">"
				            	.$key['pseudo'];
				        if(isset($_SESSION['idUtilisateur'])){
					        if ($key['idUtilisateur'] == $_SESSION['idUtilisateur'] || $_SESSION['Admin'] == 1){
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

	public function afficheUtilisateur($utilisateurs) {
			echo "<div class =\"DivUtilisateurs\">
				<p>Liste des Adherents : </p>";
				foreach($utilisateurs as $key) {
					echo "<div class =\"users\">"
					.$key['pseudo'];
					if(isset($_SESSION['idUtilisateur'])){
					    if ($_SESSION['Admin'] == 1){
/*							echo"<a href=\"index.php?module=Club&action=Bannir&id=".$key['idUtilisateur']."\">Bannir</a>";*/
						}
					}
					echo "</div>";
				}
				echo "</div>";
	}

}
?>