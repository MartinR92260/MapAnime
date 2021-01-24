<?php
require_once('ModeleClub.php');
require_once('VueClub.php');

class ContClub{

	private $modele;
	private $vue;

	public function __construct(){
		$this->modele = new ModeleClub();
		$this->vue = new VueClub();
	}

	public function addClub($id) {
		if(isset($_SESSION['idUtilisateur'])){
		    $this->modele->rejoindreClub($id);
		    $this->detailClub($id);
	    }
	    else {
	    ?>
			<script type="text/javascript"> 
        		alert("Vous devez être connecté pour rejoindre ce club"); 
 		 	</script>
 		<?php
 		$this->detailClub($id);

	    }
	}

	public function removeClub($id) {
		if(isset($_SESSION['idUtilisateur'])){
		   	$this->modele->quitterClub($id);
		   	$this->detailClub($id);
	    }
	    else {
	    ?>
			<script type="text/javascript"> 
        		alert("Vous devez être connecter pour quitter ce club"); 
 		 	</script>
 		<?php
 		$this->detailClub($id);
	    }
	}
    
    public function insererCommentaire($id){
	    if(isset($_SESSION['idUtilisateur'])){
	    	if($this->modele->dejaAdherentDuClub($id, $_SESSION['idUtilisateur'])) {
		        $this->modele->posterCommentaire($id);
		        $this->detailClub($id);
	   		}
	   		else {
	   		?>
				<script type="text/javascript"> 
        			alert("Vous devez être adherent pour poster un message"); 
 		 		</script>
 			<?php
 			$this->detailClub($id);
	    	}
	    }
	    else {
	   		?>
				<script type="text/javascript"> 
        			alert("Vous devez être connecter pour poster un message"); 
 		 		</script>
 			<?php
 			$this->detailClub($id);
	    }
	}

    public function supprimerCommentaire($idCo,$idClub){
    	$this->modele->retirerCommentaire($idCo);
    	$this->detailClub($idClub);


    }

    public function detailClub($id) {
	    	$this->vue->afficheImage($this->modele->getClub($id));
			$this->vue->afficheCommentaire($this->modele->getCommentaire($id), $this->modele->getClub($id));
			$this->vue->afficheButtonRejoindre($this->modele->getClub($id),$this->modele->dejaAdherentDuClub($id,$_SESSION['idUtilisateur']));
			$this->vue->afficheButtonQuitter($this->modele->getClub($id),$this->modele->dejaAdherentDuClub($id,$_SESSION['idUtilisateur']));
			$this->vue->afficheNbAdherent($this->modele->getNbAdherent($id));
			$this->vue->afficheUtilisateur($this->modele->getListeUtilisateur($id), $this->modele->getClub($id));
	}

	public function AjouterClub(){
		$this->vue->formulaireClub();
	}

	public function InsertionClub(){
    	$this->modele->insertClub();

	}

	public function SuppressionClub($idClub){
		$this->modele->suppressionClub($idClub);
	}

	public function modifClub($id){
		$this->vue->formulaireUpdateClub($id);

	}

	public function modifClubEnCours($id){
		$this->modele->updateClub($id);
		$this->detailClub($id);

	}



}

?>