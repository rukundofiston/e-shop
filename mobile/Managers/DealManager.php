<?php
class DealManager extends Manager{
	/**
	 * Function qui renvoi l existance d'un deal dans la bdd
	 * @param $h de type deal
	 * @return bool
	 */
	public function exist(Deal $m){
		$rep = $this->bdd->Find("deal", "id", "WHERE id = '".$m->getId()."'");
		if($rep){
			return true;
		}
		return false;
	}

	/**
	* Function qui renvoie les informations d'un deal à partir de son id 
	* @param $deal de type deal
	* @return $deal de type deal
	*/
		public function get($deal){
			$data = $this->bdd->Find("deal", "*", "WHERE id = ".$deal->getId());
			$deal1 = new Deal($data);
			return $deal1;
		}
			/**
	* Function qui renvoie tous les deals de la meme ville
	* @param $ville 
	* @return $deal un tableau de type deal
	*/
public function getByVille($ville){
           $deals = array();
			$data = $this->bdd->Liste("deal", array("id", "ville", "type", "offre", "description", "image","nom"), "WHERE ville = '".$ville."'"); 
			foreach ($data as $deal) {
				$deals[] = $deal;
			}
			return $deals;
		}
/**
	* Function qui renvoie tous les deals du meme type
	* @param $type soit restaurant ou bien hotel 
	* @return $deal un tableau de type deal
	*/	
public function getByType($type){
           $deals = array();
			$data = $this->bdd->Liste("deal", array("id", "ville", "type", "offre", "description", "image","nom"), "WHERE type = '".$type."'"); 
			foreach ($data as $deal) {
				$deals[] = $deal;
			}
			return $deals;
		}
	/**
	* Function qui renvoie les deals
	* @return $deals de type array d'deal
	*/
		public function liste($champs = null){
			$deals = array();
			if($champs == null){
				$data = $this->bdd->Liste("deal", array("id", "ville", "type", "offre", "description", "image","nom"), "");
			}else{
				$data = $this->bdd->Liste("deal", $champs, "");
			}
			
			foreach ($data as $deal) {
				$deals[] = $deal;
			}
			return $deals;
		}

	/**
	* Function qui renvoie le count des deals
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("deal", $where);
			return $count;
		}
	/**
	 * Function qui ajoute un deal
	 * @param $m de type deal
	 */
	public function add(Deal $m){

		if(! $this->exist($m)){
		
			$req = $this->bdd->InsertSQL("deal",
			 array("id", "ville", "type", "offre", "description", "image","nom"),
			 array($m->getId(), $m->getVille(), $m->getType(), $m->getOffre(), $m->getDescription(),$m->getImage(),$m->getNom())
			 );

		}		
	}
	/**
	 * Function qui modifie un deal
	 * @param $champs 
	 */
	public function edit($champs){
		$deal = new Deal(array());
		$info = $champs;
		unset($info['id']);
		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($deal, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $deal->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("deal",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime un deal
	 *	@param $deal de type deal
	 */
	public function del($deal){
		$id = $deal->getId();
		$this->bdd->DeleteSQL("deal", "where id = ".$id);
	}
}
	