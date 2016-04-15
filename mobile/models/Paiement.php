<?php
class Paiement extends Model{
	private $id;
	private $libelle;
	
	

	public function getId() { return $this->id; }  
	public function getLibelle() { return $this->Libelle; }  
	
	
	public function setId($x) { $this->id = $x; } 
	public function setLibelle($x) { $this->libelle = $x; }  
	
	
	
	
}