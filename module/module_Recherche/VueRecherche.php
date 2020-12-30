<?php
if (!defined('CONST_INCLUDE')){die('Accès direct interdit');}
include_once('./VueIndex.php');

class VueRecherche extends VueIndex{

	public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Recherche/Vue_Recherche.css"/>';
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
}
?>