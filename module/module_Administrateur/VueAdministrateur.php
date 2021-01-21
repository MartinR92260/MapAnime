<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
include_once('./VueIndex.php');

class VueAdministrateur extends VueIndex{

    public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Administrateur/VueAdministrateur.css"/>';
    }

    public function affichePanel($infoAnimes,$infoUsers){
?>
    	<h1>Animes</h1>

		<input type="text" id="animeTriId" onkeyup="animeTriParId()" placeholder="Entrer l'id.." title="Tri par id">
		<input type="text" id="animeTriNom" onkeyup="animeTriParNom()" placeholder="Entrer le nom.." title="Tri par nom">

		<table id="animeMyTable">
  			<tr class="header">
    			<th style="width:50px;">Id</th>
    			<th style="width:300px;">Nom</th>
    			<th style="width:100px;">Nb Episodes</th>
    			<th style="width:100px;">Nb Saisons</th>
    			<th style="width:100px;">Options</th>
  			</tr>
<?php
  		foreach($infoAnimes as $anime){
  			echo "<tr>
    			<td>".$anime['idAnime']."</td>
    			<td>".$anime['nom']."</td>
    			<td>".$anime['nbEpisodes']."</td>
    			<td>".$anime['nbSaisons']."</td>
    			<td><a href=\"index.php?module=Utilisateur&action=afficheProfil\" class=\"col-auto\">Modifier</a> </br> <a href=\"index.php?module=Utilisateur&action=afficheProfil\" class=\"col-auto\">Supprimer</a></td>
  			</tr>";
		
  				}
?>
  		</table>
  		<script>
  		function animeTriParId() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("animeTriId");
			filter = input.value.toUpperCase();
			table = document.getElementById("animeMyTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
    			td = tr[i].getElementsByTagName("td")[0];
    			if (td) {
    				txtValue = td.textContent || td.innerText;
    				if (txtValue.toUpperCase().indexOf(filter) > -1) {
        				tr[i].style.display = "";
      				} else {
        				tr[i].style.display = "none";
    				}
    			}       
			}
		}

		function animeTriParNom() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("animeTriNom");
			filter = input.value.toUpperCase();
			table = document.getElementById("animeMyTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
    			td = tr[i].getElementsByTagName("td")[1];
    			if (td) {
    				txtValue = td.textContent || td.innerText;
    				if (txtValue.toUpperCase().indexOf(filter) > -1) {
        				tr[i].style.display = "";
      				} else {
        				tr[i].style.display = "none";
    				}
    			}       
			}
		}
		</script>

		
		<h1>Utilisateurs</h1>

		<input type="text" id="userTriId" onkeyup="userTriParId()" placeholder="Entrer l'id.." title="Tri par id">
		<input type="text" id="userTriPseudo" onkeyup="userTriParPseudo()" placeholder="Entrer le pseudo.." title="Tri par pseudo">
		<input type="text" id="userTriStatus" onkeyup="userTriParStatus()" placeholder="Entrer le Status.." title="Tri par status">

		<table id="userMyTable">
  			<tr class="header">
    			<th style="width:50px;">Id</th>
    			<th style="width:300px;">Pseudo</th>
    			<th style="width:300px;">Email</th>
    			<th style="width:100px;">Status</th>
    			<th style="width:100px;">Options</th>
  			</tr>
<?php
  		foreach($infoUsers as $user){
  			echo "<tr>
    			<td>".$user['idUtilisateur']."</td>
    			<td>".$user['pseudo']."</td>
    			<td>".$user['Email']."</td>
    			<td>".$user['Admin']."</td>
    			<td><a href=\"index.php?module=Utilisateur&action=afficheProfil\" class=\"col-auto\">Modifier</a> </br> <a href=\"index.php?module=Utilisateur&action=afficheProfil\" class=\"col-auto\">Supprimer</a></td>
  			</tr>";
		
  				}
?>
  		</table>
  		<script>
  		function userTriParId() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("userTriId");
			filter = input.value.toUpperCase();
			table = document.getElementById("userMyTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
    			td = tr[i].getElementsByTagName("td")[0];
    			if (td) {
    				txtValue = td.textContent || td.innerText;
    				if (txtValue.toUpperCase().indexOf(filter) > -1) {
        				tr[i].style.display = "";
      				} else {
        				tr[i].style.display = "none";
    				}
    			}       
			}
		}

		function userTriParPseudo() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("userTriPseudo");
			filter = input.value.toUpperCase();
			table = document.getElementById("userMyTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
    			td = tr[i].getElementsByTagName("td")[1];
    			if (td) {
    				txtValue = td.textContent || td.innerText;
    				if (txtValue.toUpperCase().indexOf(filter) > -1) {
        				tr[i].style.display = "";
      				} else {
        				tr[i].style.display = "none";
    				}
    			}       
			}
		}

		function userTriParStatus() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("userTriStatus");
			filter = input.value.toUpperCase();
			table = document.getElementById("userMyTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
    			td = tr[i].getElementsByTagName("td")[3];
    			if (td) {
    				txtValue = td.textContent || td.innerText;
    				if (txtValue.toUpperCase().indexOf(filter) > -1) {
        				tr[i].style.display = "";
      				} else {
        				tr[i].style.display = "none";
    				}
    			}       
			}
		}
		</script>
<?php
    }
}
?>