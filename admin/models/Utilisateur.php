<?php
class Utilisateur extends Model{
	private $id;
	private $login;
	private $pass;
	private $statut;
	private $id_clt;
	

	public function getId() { return $this->id; }  
	public function getId_clt() { return $this->id_clt; } 
	public function getStatut() { return $this->statut; }	
	public function getLogin() { return $this->login; } 
	public function getPass() { return $this->pass; }
	
	
	
	public function setId($x) { $this->id = $x; } 
	public function setId_clt($x) { $this->id_clt = $x; }  
	public function setStatut($x) { $this->statut = $x; } 
	public function setLogin($x) {  $this->login = $x; }
	public function setPass($x) {  $this->pass = $x; }
	
	
}