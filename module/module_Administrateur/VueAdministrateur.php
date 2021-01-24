<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
include_once('./VueIndex.php');

class VueAdministrateur extends VueIndex{

  public function __construct(){
    echo '<link rel="stylesheet" type="text/css" href="module/module_Administrateur/Vue_Administrateur.css"/>';
  }

  public function formulaireUpdateUser($id){
    echo "<form action=\"index.php?module=Administrateur&action=modifUserEnCours&id=".$id."\" method=\"post\">
        <label>Entrer le num du role : </label><br/>
        <input type=\"text\" name=\"admin\" required><br/>
        <input type=\"submit\" value=\"Modifier\"> 
      </form>";
  }

  public function formulaireUpdateGenre($id){
    echo "<form action=\"index.php?module=Administrateur&action=modifGenreEnCours&id=".$id."\" method=\"post\">
        <label>Entrer le nom : </label><br/>
        <input type=\"text\" name=\"nom\" required><br/>
        <input type=\"submit\" value=\"Modifier\"> 
      </form>";
  }

    public function formulaireGenre(){
    echo "<form action=\"index.php?action=ajoutGenreEnCours&module=Administrateur\" method=\"post\">
        <h6>Ajouter un genre</h6>
        <label>Entrer le nom : </label><br/>
        <input type=\"text\" name=\"nom\" required><br/>   
        <input type=\"submit\" value=\"Ajouter\">
      </form>";
  }

    public function affichePanel($infoAnimes,$infoUsers,$infoClubs,$infoComs,$infoGenres){
      echo "<div class =\"Panel\">";
?>

    <h1>Animes</h1>
    <a href="index.php?module=Anime&action=AjoutAnime" class="col-auto">Ajouter un anime</a></br>

		<input type="text" id="animeTriId" onkeyup="animeTriParId()" placeholder="Entrer l'id.." title="Tri par id">
		<input type="text" id="animeTriNom" onkeyup="animeTriParNom()" placeholder="Entrer le nom.." title="Tri par nom">

		<table id="animeMyTable">
  			<tr class="header">
    			<th style="width:50px;">Id</th>
    			<th style="width:300px;">Nom</th>
          <th style="width:300px;">Image</th>
    			<th style="width:100px;">Nb Episodes</th>
    			<th style="width:100px;">Nb Saisons</th>
    			<th style="width:100px;">Options</th>
  			</tr>
<?php
  		foreach($infoAnimes as $anime){
  			echo "<tr>
    			<td>".$anime['idAnime']."</td>
    			<td>".$anime['nom']."</td>
          <td>".$anime['ImageAnime']."</td>
    			<td>".$anime['nbEpisodes']."</td>
    			<td>".$anime['nbSaisons']."</td>
    			<td><a href=\"index.php?module=Anime&action=modifAnime&id=".$anime['idAnime']."\" class=\"col-auto\">Modifier</a> </br> <a href=\"index.php?module=Anime&action=SupprAnime&id=".$anime['idAnime']."\" class=\"col-auto\">Supprimer</a></td>
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
    <hr>
    <h1>Genres</h1>
    <a href="index.php?module=Administrateur&action=ajoutGenre" class="col-auto">Ajouter un genre</a></br>

    <input type="text" id="genreTriId" onkeyup="genreTriParId()" placeholder="Entrer l'id.." title="Tri par id">
    <input type="text" id="genreTriNom" onkeyup="genreTriParNom()" placeholder="Entrer le nom.." title="Tri par nom">

    <table id="genreMyTable">
        <tr class="header">
          <th style="width:50px;">Id</th>
          <th style="width:300px;">Nom</th>
          <th style="width:100px;">Options</th>
        </tr>
<?php
      foreach($infoGenres as $genre){
        echo "<tr>
          <td>".$genre['idGenre']."</td>
          <td>".$genre['nomGenre']."</td>
          <td><a href=\"index.php?module=Administrateur&action=modifGenre&id=".$genre['idGenre']."\" class=\"col-auto\">Modifier</a> </br> <a href=\"index.php?module=Administrateur&action=supprGenre&id=".$genre['idGenre']."\" class=\"col-auto\">Supprimer</a></td>
        </tr>";
      }
?>
      </table>
      <script>
      function genreTriParId() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("genreTriId");
      filter = input.value.toUpperCase();
      table = document.getElementById("genreMyTable");
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

    function genreTriParNom() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("genreTriNom");
      filter = input.value.toUpperCase();
      table = document.getElementById("genreMyTable");
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
		<hr>
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
    			<td><a href=\"index.php?module=Administrateur&action=modifUser&id=".$user['idUtilisateur']."\" class=\"col-auto\">Modifier</a> </br> <a href=\"index.php?module=Administrateur&action=supprUser&id=".$user['idUtilisateur']."\" class=\"col-auto\">Supprimer</a></td>
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
    <hr>
    <h1>Clubs</h1>

    <input type="text" id="clubTriId" onkeyup="clubTriParId()" placeholder="Entrer l'id.." title="Tri par id">
    <input type="text" id="clubTriNom" onkeyup="clubTriParNom()" placeholder="Entrer le nom.." title="Tri par nom">

    <table id="clubMyTable">
        <tr class="header">
          <th style="width:50px;">Id</th>
          <th style="width:300px;">Nom</th>
          <th style="width:100px;">Options</th>
        </tr>
<?php
      foreach($infoClubs as $club){
        echo "<tr>
          <td>".$club['idClub']."</td>
          <td>".$club['nomClub']."</td>
          <td><a href=\"index.php?module=Club&action=SupprClub&id=".$club['idClub']."\" class=\"col-auto\">Supprimer</a></td>
        </tr>";
      }
?>
      </table>
      <script>
      function clubTriParId() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("clubTriId");
      filter = input.value.toUpperCase();
      table = document.getElementById("clubMyTable");
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

    function clubTriParNom() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("clubTriNom");
      filter = input.value.toUpperCase();
      table = document.getElementById("clubMyTable");
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
    <hr>
    <h1>Commentaires</h1>

    <input type="text" id="comTriIdCom" onkeyup="comTriParIdCom()" placeholder="Entrer l'id du Commentaire.." title="Tri par idCommentaire">
    <input type="text" id="comTriIdUser" onkeyup="comTriParIdUser()" placeholder="Entrer l'id de l'Utilisateur.." title="Tri par idUtilisateur">
    <input type="text" id="comTriIdAnime" onkeyup="comTriParIdAnime()" placeholder="Entrer l'id de l'Anime.." title="Tri par idAnime">
    <input type="text" id="comTriIdClub" onkeyup="comTriParIdClub()" placeholder="Entrer l'id du Club.." title="Tri par idClub">
    <input type="text" id="comTriIdCont" onkeyup="comTriParIdCont()" placeholder="Entrer le contenu.." title="Tri par contenu">

    <table id="comMyTable">
        <tr class="header">
          <th style="width:100px;">IdCommentaire</th>
          <th style="width:100px;">IdUtilisateur</th>
          <th style="width:100px;">IdAnime</th>
          <th style="width:100px;">IdClub</th>
          <th style="width:300px;">Contenu</th>
          <th style="width:100px;">Date</th>
          <th style="width:100px;">Heure</th>
          <th style="width:100px;">Options</th>
        </tr>
<?php
      foreach($infoComs as $com){
        echo "<tr>
          <td>".$com['idCommentaire']."</td>
          <td>".$com['idUtilisateur']."</td>
          <td>".$com['idAnime']."</td>
          <td>".$com['idClub']."</td>
          <td>".$com['contenu']."</td>
          <td>".$com['Date']."</td>
          <td>".$com['Heure']."</td>";
          if($com['idClub']==NULL)
            echo "<td><a href=\"index.php?module=Anime&action=DelCommentaire&id=".$com['idCommentaire']."\" class=\"col-auto\">Supprimer</a></td>";
          else
            echo "<td><a href=\"index.php?module=Club&action=SupprimerCommentaire&id=".$com['idCommentaire']."\" class=\"col-auto\">Supprimer</a></td>
        </tr>";
      }
?>
      </table>
      <script>
      function comTriParIdCom() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("comTriIdCom");
      filter = input.value.toUpperCase();
      table = document.getElementById("comMyTable");
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

    function comTriParIdUser() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("comTriIdUser");
      filter = input.value.toUpperCase();
      table = document.getElementById("comMyTable");
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

    function comTriParIdAnime() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("comTriIdAnime");
      filter = input.value.toUpperCase();
      table = document.getElementById("comMyTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[2];
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

    function comTriParIdClub() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("comTriIdClub");
      filter = input.value.toUpperCase();
      table = document.getElementById("comMyTable");
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

    function comTriParIdCont() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("comTriIdCont");
      filter = input.value.toUpperCase();
      table = document.getElementById("comMyTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[4];
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
  echo "</div>";
    }
}
?>