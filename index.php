<?php session_start();
require_once('VueIndex.php');
define('CONST_INCLUDE',NULL);
if (!defined('CONST_INCLUDE')){
    die('Accès direct interdit');
}

$patron = new VueIndex();

            if (!isset($_GET['module'])) {
                $module="Recherche";
                $_GET['action'] = "anime";
            }
            else {
                $module=htmlspecialchars($_GET['module']);
            }
            switch($module){
                case "Anime":
                case "Club":
                case "Recherche":
                case "Utilisateur":
                case "Connexion":
                    include 'module/module_'.$module.'/Mod'.$module.'.php';
                    break;
                default :
                    die("Erreur Index : Module inacessible.");
            }

    $module = $patron->getAffichage();//on recupere l'affichage des modules
    require('patron.php');
?>