<?php
class CommandeProduitManager extends Manager{
	/**
	 * Function qui renvoi l existance d'une commandeProduit dans la bdd
	 * @param $commande de type Commande
	 * @return bool
	 */
	public function exist(CommandeProduit $commandePdroduit){
		$rep = $this->bdd->Find("commande_pdts", "id", "WHERE id = '".$commandePdroduit->getId()."'");
		if($rep){
			return true;
		}
		return false;
	}

	/**
	* Function qui renvoie les informations d'une commande des produits à partir de son id 
	* @param $commandeProduit de type CommandeProduit
	* @return $commandeProduit de type CommandeProduit
	*/
		public function get($commandeProduits){
			$commandeProduit = array();
			$data = $this->bdd->Find("commande_pdts", "*", "WHERE id = ".$commandeProduits);
			$datac = $this->bdd->Find("commande", "*", "WHERE id = ".$data['id_cmd']);
			$dataclt = $this->bdd->Find("client", "*", "WHERE id = ".$datac['id_clt']);
			$datapaiement = $this->bdd->Find("paiement", "*", "WHERE id = ".$datac['id_paiement']);
			$commandeProduit['id']=$data['id'];
			 $commandeProduit['date_cmd']=$datac['date_cmd'];
			 $commandeProduit['nom']=$dataclt['nom'];
			 $commandeProduit['prenom']=$dataclt['prenom'];
			  $commandeProduit['libelle']=$datapaiement['libelle'];
			$commandeProduit['etat']=$datac['etat'];
			
			return $commandeProduit;
		}
			/**
	* Function qui renvoie tous les produit  d'une meme commande
	* @param $
	* @return $commandes un tableau de type Commande
	*/
public function getBycommande($commande){
           $commandeProduits = array();
			$data = $this->bdd->Liste("commande_pdts", array("id", "id_cmd", "id_pdt", "qte"), "WHERE id_cmd = '".$commande.getId()."'"); 
			foreach ($data as $commandeProduit) {
				$commandeProduits[] = $commandeProduit;
			}
			return $commandeProduits;
		}
			/**
	* Function qui renvoie tous les commandes contenant le meme produit 
	* @param $produit
	* @return $commandeProduits un tableau de type CommandeProduit
	*/
public function getByproduit($produit){
           $commandeProduits = array();
			$data = $this->bdd->Liste("commande_pdts", array("id", "id_cmd", "id_pdt", "qte"), "WHERE id_pdt = '".$produit.getId()."'"); 
			foreach ($data as $commandeProduit) {
				$commandeProduits[] = $commandeProduit;
			}
			return $commandeProduits;
		}
		

	/**
	* Function qui renvoie la liste des commande Produits
	* @return $commandeProduits un tableau de type CommandeProduit
	*/
		
			public function liste1($champs = null){
			$commandeProduits = array();
			if($champs == null){
				
				$data = $this->bdd->Liste("commande", array("id", "id_clt", "date_cmd", "id_paiement", "etat"), "");
			}else{
				$data = $this->bdd->Liste("commande", $champs, "");
			}
			
			foreach ($data as $commande) {
			
			$pdts=array();
			$sommeprix=0;
			$dataclt = $this->bdd->Find("client", "*", "WHERE id = ".$commande['id_clt']);
			$datapaiement = $this->bdd->Find("paiement", "*", "WHERE id = ".$commande['id_paiement']);
			$datalistepdt = $this->bdd->Liste("commande_pdts", array("id", "id_cmd", "id_pdt", "qte"), 
				"WHERE id_cmd = '".$commande['id']. "'"); 
			foreach ($datalistepdt as $Produit){
			$datapdt = $this->bdd->Find("produit", "*", "WHERE id = ".$Produit['id_pdt']);
			//echo  $datapdt['id_cat'];

			//debug($datapdt);
			$var=unserialize($datapdt['description']);
			$desc="";
			$datacat = $this->bdd->Find("categorie", "*", "WHERE id ='".$datapdt['id_cat']. "'");
			$sommeprix = $sommeprix + $datapdt['prix'] + $datapdt['prix'] * $datacat['pourcentage'] ;
			foreach ($var as $key => $value)
			{
            $desc.='<b>'.$key.'</b>'." : ".$value.",".'<br>';
			}
			   $datapdt['description']=$desc;

				
			
			$pdts[]=$datapdt;
			}
			$commandeProduit['prix']=$sommeprix;
			$commandeProduit['id']=$commande['id'];
			$commandeProduit['date_cmd']=$commande['date_cmd'];
			$commandeProduit['nom']=$dataclt ['nom'];
			$commandeProduit['prenom']=$dataclt ['prenom'];
			$commandeProduit['libelle']=$datapaiement ['libelle'];
			$commandeProduit['etat']=$commande['etat'];
			$commandeProduit['pdt']=$pdts;
			
				$commandeProduits[] = $commandeProduit;
			}
			return $commandeProduits;
		}

	/**
	* Function qui renvoie le count des commandes produits
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("commande_pdts", $where);
			return $count;
		}
	/**
	 * Function qui ajoute une commande produit
	 * @param $commandeProduit de type CommandeProduit
	 */
	public function add(CommandeProduit $commandeProduit){

		if(! $this->exist($commandeProduit)){
		
			$req = $this->bdd->InsertSQL("commande_pdts",
			 array("id", "id_cmd", "id_pdt", "qte"),
			 array($commandeProduit->getId(), $commandeProduit->getId_cmd(), $commandeProduit->getId_pdt(), $commandeProduit->getQte())
			 );

		}		
	}
	/**
	 * Function qui modifie une commande produit
	 * @param $champs qui ont été modifiés
	 */
	public function edit($champs){
		$commandeProduit = new CommandeProduit(array());
		$info = $champs;
		unset($info['id']);
		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($commandeProduit, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $commandeProduit->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("commande_pdts",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime une commande produit
	 *	@param $commandeProduit de type CommandeProduit
	 */
	public function del($commandeProduit){
	
		$id = $commandeProduit->getId();
		
		$this->bdd->DeleteSQL("commande", "where id = ".$id);
		$this->bdd->DeleteSQL("commande_pdts", "where id_cmd = ".$id);
	}
}
	