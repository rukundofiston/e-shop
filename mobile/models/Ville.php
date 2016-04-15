<?php
class Ville extends Model{
	private $id;
	private $libelle;

	public function getId() { return $this->id; }  
	public function getLibelle() { return $this->libelle; }
		
	public function setId($x) { $this->id = $x; } 
	public function setLibelle($x) { $this->libelle = $x;}
}