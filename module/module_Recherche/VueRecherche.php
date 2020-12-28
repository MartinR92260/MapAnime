<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
include_once('./VueIndex.php');

class VueRecherche extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Recherche/Vue_Recherche.css"/>';
    }

	public function rechercher($result){
        echo '<form action="index.php?module=Recherche&action=parNom" method="POST">
                <h3>Saisir un nom:</h3>
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="nomSaisie">
				<input type="checkbox" name="papier"/> <label>Papier</label><br>
				<input type="checkbox" name="anime"/> <label>Anime</label><br>
				Genre<br>';
				foreach ($result as $tuple) {
				    echo "<input type=\"checkbox\" name=\"Genre[]\" value=\"".intval($tuple['idGenre'])."\">".$tuple['NomGenre']."</br>";	
				}
				echo '<input type="submit" value="Lancer la recherche">
			</form>';
	}
	
	public function afficheParNom($result,$saisieRecherche=null){
		if($saisieRecherche!=NULL){
			echo "<h3>Resultat=$saisieRecherche</h3></br>";
		}
		foreach ($result as $res) {
			echo "<a href=\"index.php?module=Anime&action=Anime&id=".$res['idAnime']."\">".$res['nom']."</a>";
			echo '</br>';
		}
	}

	public function rechercheTousFormat($result,$Genre){
		echo "<h3>$Genre</h3></br>";
		$this->affListe($result);
	}

	public function affListe($result){
		echo "<div class=\"block\">";
    	foreach ($result as $key) {
    		echo "<a href=\"index.php?module=Anime&action=Anime&id=".$key['idAnime']."\">";
			echo "<div>"; //75d2ed
				echo "<img src=./Images/Anime/".$key['ImageAnime']." class=\"col-3\">";
				echo "<div class=\"col-9\">";
			       	echo "Nom de l'Oeuvre: ".$key['nom']."<br/>";
			       	echo "Sysnopsis :</br>".$key['SUBSTRING(synopsis,1,255)']."...</br>";
		       	echo "</div>";
			echo "</div>";
			echo "</a>";
		}
		echo "</div>";
	}
}
?>