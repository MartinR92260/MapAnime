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
        $mdp = hash('sha512', $_POST['mdp']);
        if (!isset($_POST['login']) || !isset($_POST['mdp'])) {
            die("il manque le mot de passe ou le login");
        }
        else{
            $bd = self::$bdd->prepare('SELECT * FROM Utilisateur where pseudoUtilisateur like ? and mdpUtilisateur like ?');
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
        $mdp = hash('sha512', $_POST['mdp']);

        $login = $_POST['login'];
        $bd = self::$bdd->prepare('SELECT pseudo FROM Utilisateur where pseudo like ?');
        $bd->execute(array($login));
        $response = $bd->fetch();
        if ($response) {
            return false;
        }
        else{
            $bd = self::$bdd->prepare('INSERT into Utilisateur values(default,?,?,,?,?,?,?,?,2)');
            $bd->execute(array($login,$mdp));
            return true;
        }
    }
}

?>