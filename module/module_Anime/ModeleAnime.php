<?php

require_once("./ConnexionBD.php"); 




class ModeleAnime extends ConnexionBD{


	public function __construct(){
		parent::initConnexion();
	}

	public function getAnime($id){
		$req = self::$bdd->prepare("SELECT DISTINCT * FROM anime WHERE idAnime = ?");
		$req->execute(array($id));
		return $req->fetchAll();
	}


	public function VerifAnimeDansListe($id){
		if(isset($_SESSION['idUtilisateur'])){
		$req = self::$bdd->prepare("SELECT idAnime,note,etat FROM liste WHERE idUtilisateur = ? AND idAnime= ?");
		$req->execute(array($_SESSION['idUtilisateur'],$id));
		return $req->fetchAll();
	}
	}



    public function getGenre($id){//getGenre== ancien getGenreFrom
       /* $req = self::$bdd->prepare("SELECT DISTINCT idGenre,NomGenre FROM genre  WHERE idGenre = ?");*/
       $req = self::$bdd->prepare("SELECT DISTINCT idGenre,NomGenre FROM Anime NATURAL JOIN etre NATURAL JOIN Genre WHERE idAnime = ?");
        $req->execute(array($id));
        return $req->fetchAll();
    }

	public function insertAnime(){
		$req = self::$bdd->prepare("INSERT INTO Anime VALUES (default,?,?,?,?,?,?,?)");
		if(!empty($_POST['nom'])){
			$nom = $_POST['nom'];
		}else{
			$nom = NULL;
		}
		if(!empty($_POST['synopsis'])){
			$synopsis = $_POST['synopsis'];
		}else{
			$synopsis = NULL;
		}
		if(!empty($_POST['nbSaisons'])){
			$nbSaisons = $_POST['nbSaisons'];
		}else{
			$nbSaisons = NULL;
		}
		if(!empty($_POST['nbEpisodes'])){
			$nbEpisodes = $_POST['nbEpisodes'];
		}else{
			$nbEpisodes = NULL;
		}

		if(isset($_POST["submit"])){ 
            if(!empty($_FILES["ImageAnime"]["name"])) { 
                $fileName = basename($_FILES["ImageAnime"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                 
                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['ImageAnime']['tmp_name']; 
                    $resultat = move_uploaded_file($_FILES['ImageAnime']['tmp_name'],"./images/Anime/".$fileName);
                    $result = $req->execute(array($nom,$fileName,$nbEpisodes,$nbSaisons,$synopsis,NULL,NULL));

                    if($result){ 
                        ?>
                            <script type="text/javascript"> 
                            alert("L'animé a bien été créer!"); 
                            </script>
                        <?php
                    }
                    else{ 
                        ?>
                            <script type="text/javascript"> 
                            alert("L'importation de l'image du l'animé a échoué, Veuillez réessayer!!"); 
                            </script>
                        <?php
                        $result = NULL;
                    }  
                }
                else{
                    ?>
                        <script type="text/javascript"> 
                        alert("Les seules formats supportés sont : JPG, JPEG, PNG, & GIF!"); 
                        </script>
                    <?php
                    $result = NULL; 
                } 
            }
            else{ 
                ?>
                    <script type="text/javascript"> 
                    alert("Vous devez mettre une image pour l'anime!"); 
                    </script>
                <?php
                $result = NULL;
            } 
        }
		return $result;
	}	

	
    
    public function getCommentaire($id) {
        $req = self::$bdd->prepare("SELECT * FROM Commentaire NATURAL JOIN Anime NATURAL JOIN Utilisateur WHERE idAnime = ? ORDER BY Date,Heure");
         $req->execute(array($id));
		return $req->fetchAll();
    }

    /*Create/Get studio/auteur*/

   public function getListe($id) {
        if (isset($_SESSION['idUtilisateur'])){
            $req = self::$bdd->prepare("SELECT idAnime FROM liste WHERE idUtilisateur = ? ");
            $req->execute(array($_SESSION['idUtilisateur']));
            return $req->fetchAll();
        }
    }

    
    
    public function insertionCommentaire($idAnime){

    	
    	$date=date("Y-m-d");
    	$heure=date("H:i:s");
    	
        $req = self::$bdd->prepare("INSERT INTO commentaire VALUES (default, ?, ?, ?, ?, ?, ?)");
        $result=$req->execute(array($_SESSION['idUtilisateur'], $idAnime,NULL, $_POST['commentaireV2'],$date,$heure));
        return $result;
    }

    public function suppressionCommentaire($idAnime){
    	    	header('Location:index.php');

    	$req = self::$bdd->prepare("DELETE FROM commentaire WHERE idCommentaire LIKE ?");
        $result=$req->execute(array( $idAnime));
        return $result;
    }

    public function suppressionAnime($idAnime){

    	header('Location:index.php');


    	$req = self::$bdd->prepare("DELETE FROM anime WHERE idAnime = ?");
        $result=$req->execute(array($idAnime));
        return $result;
    }
   

    	public function modifNote($id){

    	header('Location:index.php');

		$idUtilisateur = $_SESSION['idUtilisateur'];
		$newNote=$_POST['noteSelec'];
		$this->request = 'UPDATE  liste SET note=? WHERE idUtilisateur=? AND idAnime=?';
		$this->arg = array($newNote,$idUtilisateur,$id);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		
	}



	public function modifLEtat($id) {

    	header('Location:index.php');


		$idUtilisateur = $_SESSION['idUtilisateur'];
		$newEtat=$_POST['etatSelec'];
		$this->request = 'UPDATE  liste SET etat=? WHERE idUtilisateur=? AND idAnime=?';
		$this->arg = array($newEtat,$idUtilisateur,$id);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);
		
	}

	public function noteGenerale($id) {


		$req = self::$bdd->prepare("SELECT  note FROM liste WHERE idAnime=?");
		$req->execute(array($id));
		return $req->fetchAll();

	}



	public function updateNoteG($id,$req) {

		$add=0;
		$countt=0;

		$res=array_column($req, 'note');//Transformation en tableau a 1 ligne

	
		foreach ($res as $value) {
		if($value>=0 && $value!=NULL){
		$countt	++;
		$add=$value+$add;
		}	

		}


		$noteG=$add/$countt;

		$this->request = 'UPDATE  anime SET NoteG=? WHERE idAnime=?';
		$this->arg = array($noteG,$id);
		$this->requestPrepare = self::$bdd->prepare($this->request);
		$this->requestPrepare->execute($this->arg);

		

	}

	public function updateAnime($id){
		$nom=$_POST['nom'];
		$nbSaisons=$_POST['nbSaisons'];
		$nbEpisodes=$_POST['nbEpisodes'];
		if(isset($_POST["submit"])){ 
	        if(!empty($_FILES["ImageAnime"]["name"])) { 
	            $fileName = basename($_FILES["ImageAnime"]["name"]); 
	            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
	                 
	            $allowTypes = array('jpg','png','jpeg','gif');
	            if(in_array($fileType, $allowTypes)){ 
	                $image = $_FILES['ImageAnime']['tmp_name']; 
	                $resultat = move_uploaded_file($_FILES['ImageAnime']['tmp_name'],"./images/Anime/".$fileName);

            	}
        	}
        }

		if(!empty($_POST['nbSaisons']) && !empty($_POST['nbEpisodes']) && !empty($_POST['nom'])&& !empty($_FILES["ImageAnime"]["name"])) {
			$req = self::$bdd->prepare("UPDATE anime SET nom=?,nbSaisons=?,nbEpisodes=?, ImageAnime=? WHERE idAnime=?");
			$req->execute(array($nom,$nbSaisons,$nbEpisodes,$fileName,$id));
		}

		elseif (!empty($_POST['nbSaisons']) && !empty($_POST['nbEpisodes']) && !empty($_POST['nom'])) {
			$req = self::$bdd->prepare("UPDATE anime SET nom=?,nbSaisons=?,nbEpisodes=? WHERE idAnime=?");
			$req->execute(array($nom,$nbSaisons,$nbEpisodes,$id));
		}
		elseif (!empty($_POST['nbSaisons']) && !empty($_POST['nbEpisodes']) && !empty($_FILES["ImageAnime"]["name"])) {
			$req = self::$bdd->prepare("UPDATE anime SET nbSaisons=?,nbEpisodes=?, ImageAnime=? WHERE idAnime=?");
			$req->execute(array($nbSaisons,$nbEpisodes,$fileName,$id));
		}
		elseif (!empty($_POST['nbSaisons']) && !empty($_POST['nom']) && !empty($_FILES["ImageAnime"]["name"])) {
			$req = self::$bdd->prepare("UPDATE anime SET nom=?,nbSaisons=?, ImageAnime=? WHERE idAnime=?");
			$req->execute(array($nom,$nbSaisons,$fileName,$id));
		}
		elseif (!empty($_POST['nbEpisodes']) && !empty($_POST['nom']) && !empty($_FILES["ImageAnime"]["name"])) {
			$req = self::$bdd->prepare("UPDATE anime SET nom=?,nbEpisodes=?,ImageAnime=? WHERE idAnime=?");
			$req->execute(array($nom,$nbEpisodes,$fileName,$id));
		}

		elseif (!empty($_POST['nbSaisons']) && !empty($_POST['nbEpisodes'])) {
			$req = self::$bdd->prepare("UPDATE anime SET nbSaisons=?,nbEpisodes=? WHERE idAnime=?");
			$req->execute(array($nbSaisons,$nbEpisodes,$id));
		}
		elseif (!empty($_POST['nbEpisodes']) && !empty($_POST['nom'])) {
			$req = self::$bdd->prepare("UPDATE Anime SET nom=?,nbEpisodes=? WHERE idAnime=?");
			$req->execute(array($nom,$nbEpisodes,$id));
		}
		elseif (!empty($_POST['nbSaisons']) && !empty($_POST['nom'])) {
			$req = self::$bdd->prepare("UPDATE Anime SET nom=?,nbSaisons=? WHERE idAnime=?");
			$req->execute(array($nom,$nbSaisons,$id));
		}
		elseif (!empty($_POST['nbSaisons']) && !empty($_FILES["ImageAnime"]["name"])) {
			$req = self::$bdd->prepare("UPDATE Anime SET ImageAnime=?, nbSaisons=? WHERE idAnime=?");
			$req->execute(array($fileName,$nbSaisons,$id));
		}
		elseif (!empty($_POST['nbEpisodes']) && !empty($_FILES["ImageAnime"]["name"])) {
			$req = self::$bdd->prepare("UPDATE Anime SET nbEpisodes=?, ImageAnime=? WHERE idAnime=?");
			$req->execute(array($nbEpisodes,$fileName,$id));
		}
		elseif (!empty($_POST['nom']) && !empty($_FILES["ImageAnime"]["name"])) {
			$req = self::$bdd->prepare("UPDATE Anime SET nom=?, ImageAnime=? WHERE idAnime=?");
			$req->execute(array($nom,$fileName,$id));
		}

		elseif (!empty($_POST['nom'])) {
			$req = self::$bdd->prepare("UPDATE Anime SET nom=? WHERE idAnime=?");
			$req->execute(array($nom,$id));
		}
		elseif (!empty($_POST['nbSaisons'])) {
			$req = self::$bdd->prepare("UPDATE Anime SET nbSaisons=? WHERE idAnime=?");
			$req->execute(array($nbSaisons,$id));
		}
		elseif (!empty($_POST['nbEpisodes'])) {
			$req = self::$bdd->prepare("UPDATE Anime SET nbEpisodes=? WHERE idAnime=?");
			$req->execute(array($nbEpisodes,$id));
		}
		else if(!empty($_FILES["ImageAnime"]["name"])) { 
				$req = self::$bdd->prepare("UPDATE Anime SET ImageAnime=? WHERE idAnime=?");
				$req->execute(array($fileName,$id));
		}
	}
}	
?>