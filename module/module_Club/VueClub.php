<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
include_once('./VueIndex.php');

class VueClub extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_club/VueClub.css"/>';
    }
    public function afficheImage($idClub) {
    	foreach ($idClub as $id) {
    		echo "<div class =\"Image\">
    		<img src=./images/Club/".$id['ImageClub']." id=\"imageAnime\"/>";
    		echo "</div>";
		 }
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

/*	public function afficheSupprClub($id) {
		foreach ($id as $key) {
		if ($_SESSION['Admin'] == 1){
			echo "<a href=\"index.php?action=SupprClub&module=Club&id=".$key['idClub']."\">Supprimer le club définitivement</a>";
			}
		}
	}*/

	public 	function afficheCommentaire($commentaires, $club){
		foreach($club as $key) {
			if(isset($_SESSION['idUtilisateur'])){
				if ($key['Gerant'] == $_SESSION['idUtilisateur']){
					echo"<div class=\"Suppr\">
					<a href=\"index.php?action=SupprClub&module=Club&id=".$key['idClub']."\">Supprimer le club définitivement</a>";
					echo"</div>";
					echo"<div class=\"Modif\">
					<a href=\"index.php?action=modifClub&module=Club&id=".$key['idClub']."\">Modifier le club</a>";
					echo"</div>";
				}
			}
	        echo"<div class=\"FormCommentaires\">
		        <form action=\"index.php?action=AjouterCommentaire&module=Club&id=".$key['idClub']."\" method=\"post\">
		        <label for=\"commentaire\">
                        <h2>Messages du Club : <h2>
	            		</label>
	            		<textarea name=\"comm\" placeholder=\"inserez votre commentaire\" width = 100px;></textarea><br/>
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
				        	foreach($club as $id) {
						        if ($key['idUtilisateur']  == $_SESSION['idUtilisateur'] || $id['Gerant'] == $_SESSION['idUtilisateur'] ){
						        	echo "<a href=\"index.php?module=Club&action=SupprimerCommentaire&id=".$key['idCommentaire']."\">   Supprimer</a>";
						        }
						    }			    
					    }
					    echo "</div>";
				        echo "<div class =\"headerDetails\">";
			         echo "</div><p>".$key['contenu']."</p>";
			         echo "<div class=\"DivDate\">
			          <p>".$key['Date']."  ".$key['Heure']."</p></div>";
			          echo "</div>";
			        }
		    	echo "</div>";
		    	echo "</div>";
			}
	}

	public function afficheUtilisateur($utilisateurs, $club) {
			echo "<div class =\"DivUtilisateurs\">
				<p>Liste des Adherents : </p>";
				foreach($club as $id) {
					foreach($utilisateurs as $key) {
						echo $key['pseudo'];
						echo "<div class =\"DivUtilisateursBan\">";
/*						if(isset($_SESSION['idUtilisateur'])){
						    if ($id['Gerant'] == $_SESSION['idUtilisateur']) {
								echo "<a href=\"index.php?module=Club&action=Bannir&idUser=".$key['idUtilisateur']."&idClub=".$key['idClub']."\">Bannir</a>";
								echo "</div>";
							}
						}*/
						}
					}
			echo "</div>";
	}

	public function formulaireClub(){
		echo "<div class =\"Formulaire\">";
		 echo '<form action="index.php?action=AjoutEnCours&module=Club" method="post" enctype="multipart/form-data">
				<label>Entrer le nom du club: </label><br/>
			 	<input type="text" name="nomClub" required><br/>
			 	<label>Entrer la description : </label><br/>
				<input type="text" name="DescriptionClub" required><br/> 
				    <label>Image du Club:</label>';
				    echo "<div class =\"FormulaireImage\">";
				    echo '<input type="file" name="ImageClub">';
				    echo "</div>";
				    echo '<input type="submit" name="submit" value="Ajouter">
			</form>';
		echo "</div>";
	}

	public function formulaireUpdateClub($id){
		echo "<div class =\"Formulaire\">";
		echo "<form action=\"index.php?action=modifClubEnCours&module=Club&id=".$id."\" method=\"post\" enctype=\"multipart/form-data\">
				<label>Entrer le nom du club : </label><br/>
			 	<input type=\"text\" name=\"nomClub\"><br/>
				<label>Entrer la description : </label><br/>
			 	<input type=\"text\" name=\"DescriptionClub\"><br/>
					<label>Image du Club:</label>";
				    echo "<div class =\"FormulaireImage\">";
				    echo '<input type="file" name="ImageClub">';
				    echo "</div>";
				    echo '<input type="submit" name="submit" value="Ajouter">

			</form>';
			echo "</div>";
	}

}
?>