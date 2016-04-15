<?php
class CategorieManager extends Manager{
	/**
	 * Function qui renvoi l existance d'une categorie dans la bdd
	 * @param $categoriede type Categorie
	 * @return bool
	 */
	public function exist(Categorie $categorie){
		$rep = $this->bdd->Find("categorie", "id", "WHERE id = '".$categorie->getId()."'");
		if($rep){
			return true;
		}
		return false;
	}
	public function listecat($id_cat){
		$categories=array();
		$data = $this->bdd->Liste("categorie", "*", "WHERE id_type = '".$id_cat."'");
	foreach ($data as $categorie) {
			

				$categories[] = $categorie;
			}
			return $categories;
	}

	/**
	* Function qui renvoie les informations d'une categorie à partir de son id 
	* @param $categorie de type Categorie
	* @return $categorie de type Categorie
	*/
		public function get($categorie){
			$data = $this->bdd->Find("categorie", "*", "WHERE id = ".$categorie->getId());
			$categorieload = new Categorie($data);
			return $categorieload;
		}
			/**
	
			

	* Function qui renvoie la liste des categories
	* @return $categories un tableau de type categorie
	*/
		public function liste($champs = null){
			$commandes = array();
			if($champs == null){
				$data = $this->bdd->Liste("categorie", array("id", "libelle"), "");
			}else{
				$data = $this->bdd->Liste("categorie", $champs, "");
			}
			
			foreach ($data as $categorie) {

				$categories[] = $categorie;
			}
			return $categories;
		}


	/**
	* Function qui renvoie le count des categories
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("categorie", $where);
			return $count;
		}
	/**
	 * Function qui ajoute une categorie
	 * @param $categorie de type Categorie
	 */
	public function add(Categorie $categorie){

		if(! $this->exist($categorie)){
		
			$req = $this->bdd->InsertSQL("categorie",
			 array("id", "libelle"),
			 array($categorie->getId(), $categorie->getLibelle())
			 );

		}		
	}
	/**
	 * Function qui modifie une categorie
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
				    if (method_exists($categorie, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $categorie->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("categorie",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime un categorie
	 *	@param $categorie de type Catagorie
	 */
	public function del($categorie){
		$id = $categorie->getId();
		$this->bdd->DeleteSQL("categorie", "where id = ".$id);
	}
}
	