<?php

class ProduitManager extends Manager{
	/**
	 * Function qui renvoi l existance d'un produit dans la bdd
	 * @param $produit de type produit
	 * @return bool
	 */
	public function exist(Produit $produit){
		$rep = $this->bdd->Find("produit", "id", "WHERE id = '".$produit->getId()."'");
		if($rep){
			return true;
		}
		return false;
	}

	/**
	* Function qui renvoie les informations d'un produit à partir de son id 
	* @param $produit de type Produit
	* @return $produit de type Produit
	*/
		public function get($produit){
			$data = $this->bdd->Find("produit", "*", "WHERE id = ".$produit->getId());
			$var=unserialize($data['description']);
			$desc="";
			foreach ($var as $key => $value)
			{
             $desc.='<b>'.$key.'</b>'." : ".$value.",".'<br>';
			}
			$data['description']=$desc;
			$data['photos']=unserialize($data['photos']);
			$produitload = new Produit($data);
			return $produitload;
		}

		public function getDeal(){
           $produits = array();
			$data = $this->bdd->Liste("produit", array("id","id_p", "id_fr", "libelle", "prix", "description", "qte_stock", "photos", "id_cat","id_type"), "order by prix asc"); 
			$i=0;
			while ($i<=5) {
				$i=$i+1;
				foreach ($data as $produit) {
					$produit['photos']=unserialize($produit['photos']);
					$produits[] = $produit;
				}
			}
			return $produits;
		}
			/**
	* Function qui renvoie tous les produits de la meme categorie
	* @param $categorie 
	* @return $produits un tableau de type Produit
	*/
public function getBycategorie($categorie){
           $produits = array();
			$data = $this->bdd->Liste("produit", array("id", "id_p", "id_fr", "libelle", "prix", "description", "qte_stock", "photos", "id_cat"), "WHERE id_cat = '".$categorie."'"); 
			foreach ($data as $produit) {
				$produits[] = $produit;
			}
			return $produits;
		}

	/**
	* Function qui renvoie la liste des produits
	* @return $produits un tableau de type produit
	*/
		public function liste($champs = null){
			$produits = array();
									
			if($champs == null){
				$data = $this->bdd->Liste("produit", array("id", "id_p", "id_fr", "libelle", "prix", "description", "qte_stock", "photos", "id_cat"), "");
			}else{
				$data = $this->bdd->Liste("produit", $champs, "");
			}
			
			foreach ($data as $produit) {
			
			$datafrn = $this->bdd->Find("fournisseur", "*", "WHERE id = ".$produit['id_fr']);
			$datacat = $this->bdd->Find("categorie", "*", "WHERE id = ".$produit['id_cat']);
			$produit['libellecat']=$datacat ['libelle'];
			$produit['nomfr']=$datafrn ['societe'];
			$produit['photos']=unserialize($produit['photos']);
			$var=unserialize($produit['description']);
			$desc="";
			foreach ($var as $key => $value)
			{
            $desc.='<b>'.$key.'</b>'." : ".$value.",".'<br>';
			}
			   $produit['description']=$desc;

				$produits[] = $produit;
			}
		
			
			return $produits;
		}
		public function listepdt($type,$categorie){
			$categories=array();
			$data = $this->bdd->Liste("produit", "*", "WHERE id_cat = ".$categorie." and id_type=".$type);
			foreach ($data as $datacat) {
			
			$datacat['photos']=unserialize($datacat['photos']);
			$var=unserialize($datacat['description']);
			$desc="";
			foreach ($var as $key => $value)
			{
            $desc.='<b>'.$key.'</b>'." : ".$value.",".'<br>';
			}
			$datacat['description']=$desc;
      		$categories[]=$datacat;
			}
      		return $categories;

		}



	/**
	* Function qui renvoie le count des produits
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("produit", $where);
			return $count;
		}
	/**
	 * Function qui ajoute un produit
	 * @param $produit de type Produit
	 */
	public function add(Produit $produit){

		if(! $this->exist($produit)){
		
			$req = $this->bdd->InsertSQL("produit",
			 array("id", "id_p", "id_fr", "libelle", "prix", "description", "qte_stock", "photos", "id_cat"),
			 array($produit->getId(), $produit->getId_p(), $produit->getId_fr(), $produit->getLibelle(), $produit->getPrix(),$produit->getDescription(),$produit->getQte_stock(),$produit->getPhotos(),$produit->getId_cat())
			 );

		}		
	}
	/**
	 * Function qui modifie un produit
	 * @param $champs qui ont été modifiés
	 */
	public function edit($champs){
		$produit = new Produit(array());
		$info = $champs;
		unset($info['id']);
		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($produit, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $produit->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("produit",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime un produit
	 *	@param $produit de type Produit
	 */
	public function del($produit){
		$id = $produit->getId();
		$this->bdd->DeleteSQL("produit", "where id = ".$id);
	}
}
	