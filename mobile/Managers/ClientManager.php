<?php
class ClientManager extends Manager{
	/**
	 * Function qui renvoi l existance d'un client dans la bdd
	 * @param $client de type Client
	 * @return bool
	 */
	public function exist(Client $client){
		$rep = $this->bdd->Find("client", "id", "WHERE id = '".$client->getId()."'");
		if($rep){
			return true;
		}
		return false;
	}

	/**
	* Function qui renvoie les informations d'un client à partir de son id 
	* @param $client de type Client
	* @return $clientload de type Client
	*/
		public function get($client){
			$data = $this->bdd->Find("client", "*", "WHERE id = ".$client->getId());
			$clientload = new Client($data);
			return $clientload;
		}
			/**
	* Function qui renvoie tous les clients du meme sexe
	* @param $sexe
	* @return $clients un tableau de type Client
	*/
public function getBySexe($sexe){
           $clients = array();
			$data = $this->bdd->Liste("client", array("id", "nom", "prenom", "date_naissance", "telephone", "ville", "adresse", "email", "sexe"), "WHERE sexe = '".$sexe."'"); 
			foreach ($data as $client) {
				$clients[] = $client;
			}
			return $clients;
		}

	/**
	* Function qui renvoie la liste des clients
	* @return $clients un tableau de type Client
	*/
		public function liste($champs = null){
			$clients = array();
			if($champs == null){
				$data = $this->bdd->Liste("client", array("id", "nom", "prenom", "date_naissance", "telephone", "ville", "adresse", "email", "sexe"), "");
			}else{
				$data = $this->bdd->Liste("client", $champs, "");
			}
			
			foreach ($data as $client) {
				$clients[] = $client;
			}
			return $clients;
		}

	/**
	* Function qui renvoie le count des clients
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("client", $where);
			return $count;
		}
	/**
	 * Function qui ajoute un client
	 * @param $client de type Client
	 */
	public function add(Client $client){

		if(! $this->exist($client)){
		
			$req = $this->bdd->InsertSQL("client",
			 array("id", "nom", "prenom", "date_naissance", "telephone", "ville", "adresse", "email", "sexe"),
			 array($client->getId(), $client->getNom(), $client->getPrenom(), $client->getDate_naissance(), $client->getTelephone(),$client->getVille(),$client->getAdresse(),$client->getEmail(),$client->getSexe())
			 );

		}		
	}
	/**
	 * Function qui modifie un client
	 * @param $champs qui ont été modifiés
	 */
	public function edit($champs){
		$client = new Client(array());
		$info = $champs;
		unset($info['id']);
		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($client, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $client->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("client",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}

	/**
	 * Function qui supprime un client
	 *	@param $client de type Client
	 */
	public function del($client){
		$id = $client->getId();
		$this->bdd->DeleteSQL("client", "where id = ".$id);
	}
}
	