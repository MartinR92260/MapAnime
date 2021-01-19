<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
include_once('./VueIndex.php');

class VueAdministrateur extends VueIndex{

    public function __construct(){
        echo '<link rel="stylesheet" type="text/css" href="module/module_Administrateur/VueAdministrateur.css"/>';
    }


}
?>