<?php
if(!defined('CONST_INCLUDE'))die('Accès direct interdit');
require_once('./ConnexionBD.php');

class ModeleClub extends ConnexionBD{


	public function __construct(){
		parent::initConnexion();
	}

    public function rejoindreClub($id) {
        $req = self::$bdd->prepare("INSERT INTO possede VALUES (?,?)");
        $req->execute(array($_SESSION['idUtilisateur'], $id));
        return $req->fetchAll();
    }

    public function quitterClub($id) {
        $req = self::$bdd->prepare("DELETE FROM possede WHERE idUtilisateur = ? AND idClub = ?");
        $req->execute(array($_SESSION['idUtilisateur'], $id));
        return $req->fetchAll();
    }

    public function getNbAdherent($id) {
        $req = self::$bdd->prepare("SELECT count('idUtilisateur') AS nbUtilisateur FROM possede where idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }

    public function posterCommentaire($id){
        $req = self::$bdd->prepare("INSERT INTO commentaire VALUES (default, ?, ?, ?, ?, ?, ?)");
        $result=$req->execute(array($_SESSION['idUtilisateur'], NULL, $id, $_POST['comm'],NULL,NULL));
        return $result;
    }

    public function retirerCommentaire($id){
        $req = self::$bdd->prepare("DELETE FROM Commentaire WHERE idCommentaire = ?");
        $result = $req->execute(array($id));
        return $result;
    }

    public function getCommentaire($id) {
        $req = self::$bdd->prepare("SELECT * FROM Commentaire NATURAL JOIN possede NATURAL JOIN Utilisateur WHERE Commentaire.idClub = ?");
        $req->execute(array($id));
        return $req->fetchAll();
    }


    public function dejaAdherentDuClub($id, $ide) {
        $req = self::$bdd->prepare("SELECT idUtilisateur FROM possede WHERE idClub = ? AND idUtilisateur = ?");
        $req->execute(array($id, $ide));
        return $req->fetchAll();
    }

    public function getIdClub($id) {
        $req = self::$bdd->prepare("SELECT idClub FROM Club where idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }

    public function getListeUtilisateur($id) {
        $req = self::$bdd->prepare("SELECT * FROM utilisateur NATURAL JOIN possede where idClub = ?");
        $req->execute(array($id)); 
        return $req->fetchAll();
    }

    public function insertClub(){
        $req = self::$bdd->prepare("INSERT INTO Club VALUES (default,?,?,?,?)");

        if(!empty($_POST['nomClub'])){
            $nom = $_POST['nomClub'];
        }else{
            $nom = NULL;
        }
        if(!empty($_POST['DescriptionClub'])){
            $synopsis = $_POST['DescriptionClub'];

        }else{
            $synopsis = NULL;
        }

        $Grade = NULL;

        $status = $statusMsg = ''; 
        if(isset($_POST["submit"])){ 
            $status = 'error'; 
            if(!empty($_FILES["ImageClub"]["name"])) { 
                $fileName = basename($_FILES["ImageClub"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                 
                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['ImageClub']['tmp_name']; 
                    $resultat = move_uploaded_file($_FILES['ImageClub']['tmp_name'],"./images/Club/".$fileName);
                    if ($resultat) echo "Transfert réussi";
                    $result = $req->execute(array($nom,$synopsis,$Grade, $fileName));

                    if($result){ 
                        $status = 'success'; 
                        $statusMsg = "File uploaded successfully."; 
                    }
                    else{ 
                        $statusMsg = "File upload failed, please try again.";
                        $result = NULL;
                    }  
                }
                else{ 
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                    $result = NULL; 
                } 
            }
            else{ 
                ?>
                    <script type="text/javascript"> 
                    alert("Vous devez mettre une image pour le club !"); 
                    </script>
                <?php
                $result = NULL;
            } 
        }
 
        echo $statusMsg;
        return $result;
    }

    public function getClub($id){
        $req = self::$bdd->prepare("SELECT DISTINCT * FROM club WHERE idClub = ?");
        $req->execute(array($id));
        return $req->fetchAll();
    }
    public function suppressionClub($idClub){
        $req = self::$bdd->prepare("DELETE FROM club WHERE idClub = ?");
        $result=$req->execute(array($idClub));
        return $result;
    }   

    public function bannir($id, $ide) {
        $req = self::$bdd->prepare("UPDATE possede SET Ban = 1 WHERE idClub = ? AND idUtilisateur = ?");
        $req->execute(array($id, $ide));
        return $req->fetchAll();
    }

    public function verifUserBan($id, $ide) {
        $req = self::$bdd->prepare("SELECT Ban FROM possede WHERE idClub = ? AND idUtilisateur = ?");
        $req->execute(array($id, $ide));
        return $req->fetchAll();
    }
}

?>