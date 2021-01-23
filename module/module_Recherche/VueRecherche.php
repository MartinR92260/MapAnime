<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
include_once('./VueIndex.php');

echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";

class VueRecherche extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Recherche/Vue_Recherche.css"/>';
    }

	public function rechercher($result){
	echo "<div class=\"formulaireGenre\">"; 
		?>
        <form action="index.php?module=Recherche&action=parNom" method="POST">
        		Rechercher un anime par nom<br>
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="nomSaisie"><br>
				<input type="submit" value="Lancer la recherche">
			</form>
			<form action="index.php?module=Recherche&action=parGenre" method="POST">
				Rechercher un anime par genre : 
		<?php
				foreach ($result as $tuple) {
				    echo "<input type=\"checkbox\" name=\"Genre[]\" value=\"".intval($tuple['idGenre'])."\">".$tuple['NomGenre'];	
				}
		?>
				<input type="submit" value="Lancer la recherche">
			</form>
		<?php 
		echo "</div>";
	}

	public function afficheListeAnime($result){
		echo "<div class=\"block\">";
		echo '<p>Anime</p>';
		echo "<hr class = \"haut\">";
    	foreach ($result as $key ) {
    		
    		echo "<a href=\"index.php?module=Anime&action=Anime&id=".$key['idAnime']."\">";
			echo "<div>"; //75d2ed
				echo "<img src=./images/Anime/".$key['ImageAnime']." class=\"col-3\">";
				echo "<div class=\"col-9\">";
			       	echo "Nom : ".$key['nom']."<br/>";
			       	echo "Description :</br>".$key['SUBSTRING(synopsis,1,255)']."...</br>";
		       	echo "</div>";
			echo "</div>";
			echo "</a>";
		}

		echo "<hr class = \"bas\">";
		echo "</div>";
	
	}



	public function afficheTopAnime($result){
		$count=0;
		echo "<div class=\"blockTopAnime\">";
		echo '<p>Top 5 Anime Les plus populaires </p>';
		echo "<hr class = \"haut\">";
    	foreach ($result as $key ) {
    		
    		echo "<a href=\"index.php?module=Anime&action=Anime&id=".$key['idAnime']."\">";
			echo "<div>"; //75d2ed
				echo "<img src=./images/Anime/".$key['ImageAnime']." class=\"col-3\">";
				echo "<div class=\"col-9\">";
			       	echo "Nom : ".$key['nom']."<br/><br/>";
			       	echo "Nombre de Personne ayant cet anime dans leur liste : ".$key['Popularite']."</br></br>";
			       	echo "Description :</br>".$key['SUBSTRING(synopsis,1,255)']."...</br>";
		       	echo "</div>";
			echo "</div>";
			echo "</a>";
			$count++;
			if($count==5){
				break;
			}
		}
		
		echo "<hr class = \"bas\">";
		echo "</div>";
	}


public function afficheTopAnimeNote($result){
		$count=0;
		echo "<div class=\"blockTopAnimeNote\">";
		echo '<p>Top 5 Anime Les mieux noté </p>';
		echo "<hr class = \"haut\">";
    	foreach ($result as $key ) {
    		
    		echo "<a href=\"index.php?module=Anime&action=Anime&id=".$key['idAnime']."\">";
			echo "<div>"; //75d2ed
				echo "<img src=./images/Anime/".$key['ImageAnime']." class=\"col-3\">";
				echo "<div class=\"col-9\">";
			       	echo "Nom : ".$key['nom']."<br/><br/>";
			       	echo "Note :".$key['noteG']."/20</br></br>";
			       	echo "Description :</br>".$key['SUBSTRING(synopsis,1,255)']."...</br>";

		       	echo "</div>";
			echo "</div>";
			echo "</a>";
			$count++;
			if($count==5){
				break;
			}
		}
		
		echo "<hr class = \"bas\">";
		echo "</div>";
	}


	public function afficheListeClub($result){
		echo "<div class=\"blockClub\">";
		echo '<p>Club</p>';
		echo "<hr class = \"haut\">";
    	foreach ($result as $key) {
    		echo "<a href=\"index.php?module=Club&action=Club&id=".$key['idClub']."\">";
			echo "<div>"; //75d2ed
			echo "<img src=./images/Club/".$key['ImageClub']." class=\"col-3\">";
				echo "<div class=\"col-9\">";
			       	echo "Nom : ".$key['nomClub']."<br/><br/>";
			       	echo "Description :</br>".$key['DescriptionClub']."</br>";
		       	echo "</div>";
			echo "</div>";
			echo "</a>";
		}
		if(isset($_SESSION['idUtilisateur'])){
			echo "<hr class = \"bas\">";
			echo "<div class = \"divAjout\">";
			echo "<a href=\"index.php?module=Club&action=AjoutClub\">Ajouter un club</a>";
			echo "</div>";
			echo "</div>";
		}
            
	}

	public function rechercherUser(){ 
		echo "<div class=\"formulaireUser\">";
		?>
        <form action="index.php?module=Recherche&action=parNomUser" method="POST">
        		Rechercher un utilisateur <br>
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="nomSaisie"><br>
				<input type="submit" value="Lancer la recherche">
			</form>
		<?php
		echo "</div>";
	}

	public function afficheListeUser($result){
		echo "<div class=\"blockUser\">";
		echo '<p>Utilisateur</p>';
		echo "<hr class = \"haut\">";
    	foreach ($result as $key ) {
    		if ($key['idUtilisateur'] != $_SESSION['idUtilisateur']) {
    		echo "<a href=\"index.php?module=Utilisateur&action=afficheOtherProfil&id=".$key['idUtilisateur']."\">";
				echo "<div class=\"col-9\">";
			       	echo "Pseudo : ".$key['pseudo']."<br/>";
		       	echo "</div>";
			echo "</a>";
		}
		}

		echo "<hr class = \"bas\">";
		echo "</div>";
	
	}
}
?>