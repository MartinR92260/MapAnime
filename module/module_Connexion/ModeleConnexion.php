<?php
if (!defined('CONST_INCLUDE')){
    die('Accès direct interdit');
}
require_once('./ConnexionBD.php');//!!!!

class ModeleConnexion extends ConnexionBD {
    public function __construct(){
        parent::initConnexion();
    }

    public function verifConnexion() {
/*        $mdp = hash('sha512', $_POST['mdp']);
*/ 
            $mdp = $_POST['mdp'];

       if (!isset($_POST['login']) || !isset($_POST['mdp'])) {
            die("il manque le mot de passe ou le login");
        }
        else{
            $bd = self::$bdd->prepare('SELECT * FROM Utilisateur where pseudo like ? and mdp like ?');
            $bd->execute(array($_POST['login'], $mdp));
            $response = $bd->fetch();
            if ($response) {
                $_SESSION['idUtilisateur'] = $response['idUtilisateur'];
                $_SESSION['Admin'] = $response['Admin'];
                $_SESSION['pseudo'] = $response['pseudo'];
                header('Location:index.php');
            }
        }
    }

    public function deconnexion(){
        session_unset();
        header('Location:index.php');
    }	


    public function inscription(){
/*        $mdp = hash('sha512', $_POST['mdp']);//hash MotDePasse
*/
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];



        $login = $_POST['login'];
        $bd = self::$bdd->prepare('SELECT pseudo FROM Utilisateur where pseudo like ?');
        $bd->execute(array($login));
        $response = $bd->fetch();
        if ($response) {
            return false;
        }

        else if($_POST['mdp2']!=$_POST['mdp']) {
            echo'La confirmation du Mot de passe a échoué';

        }

        else{
            $bd = self::$bdd->prepare('INSERT into Utilisateur values(default,NULL,NULL,NULL,?,?,NULL,NULL,2)');
            $bd->execute(array($login,$mdp));
            return true;//Confirmation MDP marche pas et Conexioon marche pas
        }
    }
}

?>