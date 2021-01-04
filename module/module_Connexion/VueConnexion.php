<?php
if (!defined('CONST_INCLUDE')){
    die('Accès direct interdit');
}
include_once('./VueIndex.php');

class VueConnexion extends VueIndex{//!!!!!
    public function __construct() {
         parent::__construct();
         echo '<link rel="stylesheet" type="text/css" href="module/module_Connexion/VueConnexion.css"/>';

     }

	function afficheForm(){
        echo '<center>
        <form action="index.php?action=connexion&module=Connexion" method="post">
            <div class="formulaire">
                <h1>Connexion</h1>
                <label>Entrer votre pseudo : </label></br>
                <input type="text" name="login"  placeholder="Pseudo" required></br>
                <label>Entrer votre mot de passe : </label></br>
                <input type="password" name="mdp" placeholder="Mot de passe" required></br>
            </div>
            <input class="button-center" type="submit" value="Connexion">
        </form>
        </center>';
	 }

    function afficheFormInscription(){
        echo '<center>
        <form action="index.php?action=inscription&module=Connexion" method="post">
            <div class="formulaire">
                <h1>Inscription</h1>
                <label>Entrer votre pseudo : </label></br>
                <input type="text" name="login" placeholder="Pseudo" required></br>
                <label>Entrer votre mot de passe : </label></br>
                <input type="password" name="mdp" placeholder="Mot de passe" required></br>
                <label>Confirmer votre mot de passe : </label></br>
                <input type="password" name="mdp2" placeholder="Mot de passe" required></br>
            </div>
            <input class="button-center" type="submit" value="Inscription">
        </form>
        </center>';
	}
}
?>