<?php
class PanierManager extends Manager{

		public function get($panier){
			$data = $this->bdd->Find("panier", "*", "WHERE id = ".$panier->getId());
			$panierload = new Panier($data);
			return $panierload;
		}
			
	/**
	* Function qui renvoie la liste des utilisateur
	* @return $commandes un tableau de type Commande
	*/
		public function liste($champs = null){
			$paniers = array();
			if($champs == null){
				$data = $this->bdd->Liste("panier", array("id", "login", "pass", "statut", "id_clt"), "");
			}else{
				$data = $this->bdd->Liste("panier", $champs, "");
			}
			
			foreach ($data as $panier) {
				$paniers[] = $panier;
			}
			return $paniers;
		}

		public function listeProduit($champs = null){
			$paniers = array();
			if($champs == null){
				$data = $this->bdd->Liste("panier", array("id", "id_produit"), "");
			}else{
				$data = $this->bdd->Liste("panier", $champs, "");
			}
			
			foreach ($data as $panier) {
				$rep = $this->bdd->Find("produit", "*", "WHERE id = '".$panier['id_produit']."'");
				$produitload = new Produit($rep);
				$paniers[] = $produitload;
			}
			return $paniers;
		}


	
	/**
	 * Function qui ajoute un utilisateur
	 * @param $utilisateur de type Utilisateur
	 */
	public function add(Panier $panier){	
			$req = $this->bdd->InsertSQL("panier",
			 array("id", "id_produit"),
			 array($panier->getId(), $panier->getId_produit())
			 );
	}

	
	/**
	 * Function qui supprime un utilisateur
	 *	@param $utilisateur de type Utilisateur
	 */
	public function del($panier){
		$id = $panier->getId_produit();
		$this->bdd->DeleteSQL("panier", "where id_produit= ".$id);
	}
}
	