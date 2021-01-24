<?php
if (!defined('CONST_INCLUDE')){
    die('Accès direct interdit');
}
include_once('./VueIndex.php');

echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";

class VueConnexion extends VueIndex{//!!!!!
    public function __construct() {
         parent::__construct();
         echo '<link rel="stylesheet" type="text/css" href="module/module_Connexion/Vue_Connexion.css"/>';

     }

	function afficheForm(){
        echo '<center>
        <form action="index.php?action=connexion&module=Connexion" method="post">
            <div class="formulaire">
                <h1>Connexion</h1>
                <label>Entrer votre pseudo : </label></br>
                <input type="text" name="pseudo"  placeholder="Pseudo" required></br>
                <label>Entrer votre mot de passe : </label></br>
                <input type="password" name="mdp" placeholder="Mot de passe" required></br>
            <input class="button-center" type="submit" value="Connexion">
            </div>
        </form>
        </center>';
	 }

    function afficheFormInscription(){
        echo '<center>
        <form action="index.php?action=inscription&module=Connexion" method="post" enctype="multipart/form-data">
            <div class="formulaire">
                <h1>Inscription</h1>
                <label>Entrer votre pseudo : </label></br>
                <input type="text" name="pseudo" placeholder="Pseudo" required></br>
                <label>Entrer votre mot de passe : </label></br>
                <input type="password" name="mdp" placeholder="Mot de passe" required></br>
                <label>Confirmer votre mot de passe : </label></br>
                <input type="password" name="mdp2" placeholder="Mot de passe" required></br>
                    <label>Image de Profil:</label>';
                    echo "<div class =\"FormulaireImage\">";
                    echo '<input type="file" name="ImageProfil">';
                    echo "</div>";
                    echo '<input type="submit" name="submit" value="Inscription">
            </form>
            </center>';
        echo "</div>";
        ;
	}
}
?>