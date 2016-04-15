<?php
class ContactManager extends Manager{
	/**
	 * Function qui renvoi l existance d'un client dans la bdd
	 * @param $client de type Client
	 * @return bool
	 */
	public function exist(Contact $contact){
		$rep = $this->bdd->Find("contact", "id", "WHERE id = '".$contact->getId()."'");
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
		public function get($contact){
			$data = $this->bdd->Find("contact", "*", "WHERE id = ".$contact->getId());
			$contactload = new Contact($data);
			return $contactload;
		}
			
	/**
	* Function qui renvoie la liste des clients
	* @return $clients un tableau de type Client
	*/
	public function liste($champs = null){
			$contacts = array();
			if($champs == null){
				$data = $this->bdd->Liste("contact", array("id", "email", "objet", "msg", "statut","temps"), "");
			}else{
				$data = $this->bdd->Liste("contact", $champs, "");
			}
			
			foreach ($data as $client) {
				$contacts[] = $client;
			}
			return $contacts;
		}
		
	/**
	* Function qui renvoie le count des clients
	* @return $count
	*/
	public function count($where = null){
			$count = $this->bdd->Count("contact", $where);
			return $count;
		}

	public function selectUnread(){
			$messages = array();
				$data = $this->bdd->Liste("contact", array("id", "email", "objet", "msg", "statut","temps"), " where statut=0");
			
			foreach ($data as $msg) {
				$messages[] = $msg;
			}
			
			return $messages;
	}
	/**
	 * Function qui ajoute un client
	 * @param $client de type Client
	 */
	public function add(Contact $contact){

		if(! $this->exist($contact)){
		$d =  date("Y-m-d H:i:s");  
		
			$req = $this->bdd->InsertSQL("contact",
			 array("id", "email", "objet", "msg", "statut", "temps"),
			 array($contact->getId(), $contact->getEmail(), $contact->getObjet(), $contact->getMsg(), $contact->getStatut(),$d)
			 );

		}		
	}
	

	/**
	 * Function qui supprime un client
	 *	@param $client de type Client
	 */
	public function del($contact){
		$id = $contact->getId();
		$this->bdd->DeleteSQL("contact", "where id = ".$id);
	}
	
	public function edit($champs){
		$contact = new Contact(array());
		$info = $champs;
		unset($info['id']);
		$fields = array();
		$data = array();
		foreach ($info as $key => $value) {
			$method = 'set'.ucfirst($key);
			
				    // Si le setter correspondant existe.
				    if (method_exists($contact, $method))
				    {
				    	$fields[] = $key;
				    	$data[] = $value;
				      $contact->$method($value);
				    }
		}
		$req = $this->bdd->ModifySQL("contact",
		 $fields,
		 $data,
		 "WHERE id = ".$champs['id']
		 );
	}
}
	