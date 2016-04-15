<?php
class PaiementManager extends Manager{
	/**
	 * Function qui renvoi l existance d'un type de paiement dans la bdd
	 * @param $paiement de type Paiement
	 * @return bool
	 */
	public function exist(Paiement $paiement){
		$rep = $this->bdd->Find("paiement", "id", "WHERE id = '".$paiement->getId()."'");
		if($rep){
			return true;
		}
		return false;
	}

	/**
	* Function qui renvoie les informations d'un type de paiement à partir de son id 
	* @param $paiement de type Paiement
	* @return $paiement de type Paiement
	*/
		public function get($paiement){
			$data = $this->bdd->Find("paiement", "*", "WHERE id = ".$paiement->getId());
			$paiementload = new Paiement($data);
			return $paiementload;
		}
			/**
	
			

	* Function qui renvoie la liste des type de paiement
	* @return $paiements un tableau de type Paiement
	*/
		public function liste($champs = null){
			$paiements = array();
			if($champs == null){
				$data = $this->bdd->Liste("paiement", array("id", "libelle"), "");
			}else{
				$data = $this->bdd->Liste("paiement", $champs, "");
			}
			
			foreach ($data as $paiement) {
				$paiements[] = $paiement;
			}
			return $paiements;
		}

	/**
	* Function qui renvoie le count des paiement
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("paiement", $where);
			return $count;
		}
	/**
	 * Function qui ajoute un type de paiement
	 * @param $paiement de type Paiement
	 */
	public function add(Paiement $paiement){

		if(! $this->exist($paiement)){
		
			$req = $this->bdd->InsertSQL("paiement",
			 array("id", "libelle"),
			 array($paiement->getId(), $paiement->getLibelle())
			 );

		}		
	}
	/**
	 * Function qui modifie un type de paiement
	 * @param $champs qui ont été modifiés
	 */
	public function edit($champs){
		$paiement = new Paiement(array());
		$info = $champs;
		unset($info['id']);
		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($paiement, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $paiement->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("paiement",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime un type paiement
	 *	@param $paiement de type Paiement
	 */
	public function del($paiement){
		$id = $paiement->getId();
		$this->bdd->DeleteSQL("paiement", "where id = ".$id);
	}
}
	