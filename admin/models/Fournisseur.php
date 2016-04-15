<?php
class Fournisseur extends Model{
	private $id;
	private $societe;
	private $ville;
	private $adresse;
	private $telephone;
	private $email;
	private $login_bd;
	private $pass_bd;
	private $url;
	

	public function getId(){return $this->id; }  
	public function getSociete(){return $this->societe; }  
	public function getVille(){return $this->ville; } 
	public function getAdresse(){return $this->adresse; }
	public function getTelephone(){ return $this->telephone; }
	public function getEmail() {return $this->email; }
	public function getLogin_bd(){ return $this->login_bd; } 
	public function getPass_bd(){return $this->pass_bd; }
	public function getUrl(){return $this->url; }
	
	public function setId($x){$this->id = $x; } 
	public function setSociete($x){$this->societe = $x; }  
	public function setVille($x){$this->ville = addslashes($x); } 
	public function setAdresse($x){$this->adresse = $x; }
	public function setTelephone($x){$this->telephone = $x; }  
	public function setEmail($x){$this->email = $x; }
	public function setLogin_bd($x){$this->login_bd = $x;}
	public function setPass_bd($x){$this->pass_bd = md5($x);}
	public function setUrl($x){$this->url = $x;}
}