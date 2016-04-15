<?php
class FournisseurManager extends Manager{
	/**
	 * Function qui renvoi l existance d'un Fournisseur dans la bdd
	 * @param $client de type Client
	 * @return bool
	 */
	public function exist(Fournisseur $fournisseur){
		$rep = $this->bdd->Find("fournisseur", "id", "WHERE id = '".$fournisseur->getId()."'");
		if($rep){
			return true;
		}
		
		return false;
	}

	/**
	* Function qui renvoie les informations d'un fournisseur à partir de son id 
	* @param $client de type Client
	* @return $clientload de type Client
	*/
		public function get($fournisseur){
			$data = $this->bdd->Find("fournisseur", "*", "WHERE id = ".$fournisseur->getId());
			$frsload = new Fournisseur($data);
			return $frsload;
		}
			/**
	* Function qui renvoie tous les fournisseur du meme sexe
	* @param $sexe
	* @return $fournisseurs un tableau de type fournisseur
	*/
public function getBySexe($sexe){
           $fournisseurs = array();
			$data = $this->bdd->Liste("fournisseur", array("id", "societe", "ville", "adresse", "telephone", "email", "login_bd", "pass_bd","url"), "WHERE sexe = '".$sexe."'"); 
			foreach ($data as $fournisseur) {
				$fournisseurs[] = $fournisseur;
			}
			return $fournisseurs;
		}

	/**
	* Function qui renvoie la liste des fournisseurs
	* @return $fournisseurs un tableau de type Fournisseur
	*/
		public function liste($champs = null){
			$fournisseurs = array();
			if($champs == null){
				$data = $this->bdd->Liste("fournisseur", array("id","societe",
					"ville","adresse","telephone","email","login_bd","pass_bd","url"),
				"");
			}
			else{
				$data = $this->bdd->Liste("fournisseur", $champs, "");
			}
			
			foreach ($data as $fournisseur) {
				$fournisseurs[] = $fournisseur;
			}
			return $fournisseurs;
		}

	/**
	* Function qui renvoie le count des clients
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("fournisseur", $where);
			return $count;
		}
	/**
	 * Function qui ajoute un client
	 * @param $client de type Client
	 */
	public function add(Fournisseur $fournisseur){

		if(! $this->exist($fournisseur)){
		
			$req = $this->bdd->InsertSQL("fournisseur",
			 array("id","societe",
					"ville","adresse","telephone","email","login_bd","pass_bd","url"),
			 array($fournisseur->getId(), $fournisseur->getSociete(), $fournisseur->getVille(), $fournisseur->getAdresse(),$fournisseur->getTelephone(),$fournisseur->getEmail(),$fournisseur->getLogin_bd(),$fournisseur->getPass_bd(),$fournisseur->getUrl())
			 );

		}		
	}
	/**
	 * Function qui modifie un fournisseur
	 * @param $champs qui ont été modifiés
	 */
	public function edit($champs){
		$fournisseur = new Fournisseur(array());
		$info = $champs;
		unset($info['id']);

		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($fournisseur, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $fournisseur->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("fournisseur",$fields, $data,
			"WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime un fournisseur
	 *	@param $fournisseur de type Fournisseur
	 */
	public function del($fournisseur){
		$id = $fournisseur->getId();
		$this->bdd->DeleteSQL("fournisseur", "where id = ".$id);
	}
}
	