<?php session_start();
require_once('VueIndex.php');
define('CONST_INCLUDE',NULL);
if (!defined('CONST_INCLUDE')){
    die('Accès direct interdit');
}
$patron = new VueIndex();

            if (!isset($_GET['modules'])) {
                $modules="Recherche";
                $_GET['action'] = "liste";
            }
            else {
                $modules=htmlspecialchars($_GET['modules']);
            }
            switch($modules){
                case "Anime":
                case "Recherche":
                case "Utilisateur":
                case "Connexion":
                    include 'module/module_'.$modules.'/mod_'.$modules.'.php';
                    break;
                default :
                    die("Erreur Index : Module inacessible.");
            }

    $modules = $patron->getAffichage();//on recupere l'affichage des modules
    require('patron.php');
?>