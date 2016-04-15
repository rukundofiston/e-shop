<?php
class UtilisateurManager extends Manager{
	/**
	 * Function qui renvoi l existance d'un utilisateur dans la bdd
	 * @param $utilisateur de type Utilisateur
	 * @return bool
	 */
	public function exist(Utilisateur $utilisateur){
		$rep = $this->bdd->Find("utilisateur", "id", "WHERE id = '".$utilisateur->getId()."'");
		if($rep){
			return true;
		}
		return false;
	}

	/**
	* Function qui renvoie les informations d'un utilisateur à partir de son id 
	* @param $utilisateur de type Utilisateur
	* @return $utilisateur de type Utilisateur
	*/
		public function get($utilisateur){
			$data = $this->bdd->Find("utilisateur", "*", "WHERE id = ".$utilisateur->getId());
			$utilisateurload = new Utilisateur($data);
			return $utilisateurload;
		}

		public function getByLogin($login){
			$data = $this->bdd->Find("utilisateur", "*", "WHERE login = '".$login."'");
			$utilisateurload = new Utilisateur($data);
			return $utilisateurload;
		}
			
	/**
	* Function qui renvoie la liste des utilisateur
	* @return $commandes un tableau de type Commande
	*/
		public function liste($champs = null){
			$utilisateurs = array();
			if($champs == null){
				$data = $this->bdd->Liste("utilisateur", array("id", "login", "pass", "statut", "id_clt"), "");
			}else{
				$data = $this->bdd->Liste("utilisateur", $champs, "");
			}
			
			foreach ($data as $utilisateur) {
				$utilisateurs[] = $utilisateur;
			}
			return $utilisateurs;
		}

	/**
	* Function qui renvoie le count des utilisateurs
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("utilisateur", $where);
			return $count;
		}
	/**
	 * Function qui ajoute un utilisateur
	 * @param $utilisateur de type Utilisateur
	 */
	public function add(Utilisateur $utilisateur){

		if(! $this->exist($utilisateur)){
		
			$req = $this->bdd->InsertSQL("utilisateur",
			 array("id", "login", "pass", "statut", "id_clt"),
			 array($utilisateur->getId(), $utilisateur->getLogin(), $utilisateur->getPass(), $utilisateur->getStatut(), $utilisateur->getId_clt())
			 );

		}		
	}
	/**
	 * Function qui modifie un utilisateur
	 * @param $champs qui ont été modifiés
	 */
	public function edit($champs){
		$utilisateur = new Utilisateur(array());
		$info = $champs;
		unset($info['id']);
		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($utilisateur, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $utilisateur->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("utilisateur",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime un utilisateur
	 *	@param $utilisateur de type Utilisateur
	 */
	public function del($utilisateur){
		$id = $utilisateur->getId();
		$this->bdd->DeleteSQL("utilisateur", "where id = ".$id);
	}
}
	