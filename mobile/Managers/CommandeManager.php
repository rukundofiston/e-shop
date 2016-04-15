<?php
class CommandeManager extends Manager{
	/**
	 * Function qui renvoi l existance d'une commande dans la bdd
	 * @param $commande de type Commande
	 * @return bool
	 */
	public function exist(Commande $commande){
		$rep = $this->bdd->Find("commande", "id", "WHERE id = '".$commande->getId()."'");
		if($rep){
			return true;
		}
		return false;
	}

	/**
	* Function qui renvoie les informations d'une commande à partir de son id 
	* @param $commande de type Commande
	* @return $commande de type Commande
	*/
		public function get($commande){
			$data = $this->bdd->Find("commande", "*", "WHERE id = ".$commande->getId());
			$commandeload = new Commande($data);
			return $commandeload;
		}
			/**
	* Function qui renvoie tous les commandes d'un meme client
	* @param $client
	* @return $commandes un tableau de type Commande
	*/
public function getByclient($client){
           $commandes = array();
			$data = $this->bdd->Liste("commande", array("id", "id_clt", "date_cmd", "id_paiement", "etat"), "WHERE id_clt = '".$client.getId()."'"); 
			foreach ($data as $commande) {
				$commandes[] = $commande;
			}
			return $commandes;
		}
			/**
	* Function qui renvoie tous les commandes d'un meme type de paiement
	* @param $paiement
	* @return $commandes un tableau de type Commande
	*/
public function getBypaiement($paiement){
           $commandes = array();
			$data = $this->bdd->Liste("commande", array("id", "id_clt", "date_cmd", "id_paiement", "etat"), "WHERE id_paiement = '".$paiement.getId()."'"); 
			foreach ($data as $commande) {
				$commandes[] = $commande;
			}
			return $commandes;
		}
		

	/**
	* Function qui renvoie la liste des commandes
	* @return $commandes un tableau de type Commande
	*/
		public function liste($champs = null){
			$commandes = array();
			if($champs == null){
				$data = $this->bdd->Liste("commande", array("id", "id_clt", "date_cmd", "id_paiement", "etat"), "");
			}else{
				$data = $this->bdd->Liste("commande", $champs, "");
			}
			
			foreach ($data as $commande) {
				$commandes[] = $commande;
			}
			return $commandes;
		}

	/**
	* Function qui renvoie le count des commandes
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("commande", $where);
			return $count;
		}
	/**
	 * Function qui ajoute une commande
	 * @param $commande de type Commande
	 */
	public function add(Commande $commande){

		if(! $this->exist($commande)){
		
			$req = $this->bdd->InsertSQL("commande",
			 array("id", "id_clt", "date_cmd", "id_paiement", "etat"),
			 array($commande->getId(), $commande->getId_clt(), $commande->getDate_cmd(), $commande->getId_paiement(), $commande->getEtat())
			 );

		}		
	}
	/**
	 * Function qui modifie un commande
	 * @param $champs qui ont été modifiés
	 */
	public function edit($champs){
		$commande = new Commande(array());
		$info = $champs;
		unset($info['id']);
		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($commande, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $commande->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("commande",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime une commande
	 *	@param $commande de type commande
	 */
	public function del($commande){
		$id = $commande->getId();
		$this->bdd->DeleteSQL("commande", "where id = ".$id);
	}
}
	