<?php
class Commande extends Model{
	private $id;
	private $id_clt;
	private $date_cmd;
	private $id_paiement;
	private $etat;
	

	public function getId() { return $this->id; }  
	public function getEtat() { return $this->etat; }  
	public function getId_clt() { return $this->id_clt; }  
	public function getDate_cmd() { return $this->date_cmd; } 
	public function getId_paiement() { return $this->id_paiement; }
	
	
	
	public function setId($x) { $this->id = $x; } 
	public function setEtat($x) { $this->etat = $x; }
	public function setId_clt($x) { $this->id_clt = $x; }  
	public function setDate_cmd($x) { $this->date_cmd = $x; } 
	public function setId_paiement($x) {  $this->id_paiement = $x; }
	
	
	
}