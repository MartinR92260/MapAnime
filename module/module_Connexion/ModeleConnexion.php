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
        ?>
            <script type="text/javascript"> 
                alert("pseudo ou mot de passe non renseigner"); 
            </script>
        <?php
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
        ?>
            <script type="text/javascript"> 
                alert("Action Inexistante"); 
            </script>
        <?php

        }

        else{
            $bd = self::$bdd->prepare('INSERT into Utilisateur values(default,?,?,NULL,?,2)');
            if(isset($_POST["submit"])){ 
                if(!empty($_FILES["ImageProfil"]["name"])) { 
                    $fileName = basename($_FILES["ImageProfil"]["name"]); 
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                     
                    $allowTypes = array('jpg','png','jpeg','gif');
                    if(in_array($fileType, $allowTypes)){ 
                        $image = $_FILES['ImageProfil']['tmp_name']; 
                        $resultat = move_uploaded_file($_FILES['ImageProfil']['tmp_name'],"./images/Profil/".$fileName);
                        $bd->execute(array($pseudo,$mdp, $fileName));

                        if($bd){ 
                            ?>
                                <script type="text/javascript"> 
                                alert("Votre Compte a bien été créer!"); 
                                </script>
                            <?php
                        }
                        else{ 
                            ?>
                                <script type="text/javascript"> 
                                alert("L'importation de l'image de votre profil a échoué, Veuillez réessayer!!"); 
                                </script>
                            <?php
                        }  
                    }
                    else{
                        ?>
                            <script type="text/javascript"> 
                            alert("Les seules formats supportés sont : JPG, JPEG, PNG, & GIF!"); 
                            </script>
                        <?php
                    } 
                }
                else{ 
                    ?>
                        <script type="text/javascript"> 
                        alert("Vous devez mettre une image pour votre compte !"); 
                        </script>
                    <?php
                }
            return true;
        }
    }
}
}

?>