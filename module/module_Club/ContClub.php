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
	    	}
	    }
	    else {
	   		?>
				<script type="text/javascript"> 
        			alert("Vous devez être adherent pour poster un message"); 
 		 		</script>
 			<?php
	    }
	}

    public function supprimerCommentaire($id){
    	$this->vue->result($this->modele->retirerCommentaire($id));
    }

    public function detailClub($id) {
    	$this->vue->afficheImage($this->modele->getClub($id));
		$this->vue->afficheCommentaire($this->modele->getCommentaire($id), $this->modele->getClub($id));
		$this->vue->afficheButtonRejoindre($this->modele->getClub($id));
		$this->vue->afficheButtonQuitter($this->modele->getClub($id));
		$this->vue->afficheNbAdherent($this->modele->getNbAdherent($id));
		$this->vue->afficheUtilisateur($this->modele->getListeUtilisateur($id), $this->modele->getClub($id));	
	}

	public function AjouterClub(){
		$this->vue->formulaireClub();
	}

	public function InsertionClub(){
    	$this->vue->result($this->modele->insertClub());
	}

	public function SuppressionClub($idClub){
		$this->vue->result($this->modele->suppressionClub($idClub));
	}

	public function banUser($id) {
		$this->modele->bannir($id, $id);
		$this->detailClub($id);
	}

}

?>