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

       if (!isset($_POST['pseudo']) || !isset($_POST['mdp'])) {
            die("il manque le mot de passe ou le pseudo");
        }
        else{
            $bd = self::$bdd->prepare('SELECT * FROM Utilisateur where pseudo like ? and mdp like ?');
            $bd->execute(array($_POST['pseudo'], $mdp));
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



        $pseudo = $_POST['pseudo'];
        $bd = self::$bdd->prepare('SELECT pseudo FROM Utilisateur where pseudo like ?');
        $bd->execute(array($pseudo));
        $response = $bd->fetch();
        if ($response) {
            return false;
        }

        else if($_POST['mdp2']!=$_POST['mdp']) {
            echo'La confirmation du Mot de passe a échoué';

        }

        else{
            $bd = self::$bdd->prepare('INSERT into Utilisateur values(default,?,?,NULL,NULL,2)');
            $bd->execute(array($pseudo,$mdp));
            return true;
        }
    }
}

?>