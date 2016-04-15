<?php
class VilleManager extends Manager{
	
	public function get($ville){
			$data = $this->bdd->Find("client", "*", "WHERE id = ".$ville->getId());
			$ville = new Client($data);
			return $ville;
		}
			/**
	* Function qui renvoie tous les clients du meme sexe
	* @param $sexe
	* @return $clients un tableau de type Client
	*/
public function getAllVille(){
           $villes = array();
           $data = $this->bdd->Liste("ville", array("id", "libelle"), "");
			foreach ($data as $ville) {
				$villes[] = $ville;
			}
			return $villes;
		}
}