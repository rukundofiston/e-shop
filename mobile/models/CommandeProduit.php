<?php
class CommandeProduit extends Model{
	private $id;
	private $id_cmd;
	private $date_pdt;
	private $qte;
	

	public function getId() { return $this->id; }  
	public function getId_cmd() { return $this->id_cmd; }  
	public function getId_pdt() { return $this->date_pdt; } 
	public function getQte() { return $this->qte; }
	
	
	
	public function setId($x) { $this->id = $x; } 
	public function setId_cmd($x) { $this->id_cmd = $x; }  
	public function setId_pdt($x) { $this->date_pdt = $x; } 
	public function setQte($x) {  $this->qte = $x; }
	
	
	
}