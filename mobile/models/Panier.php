<?php
class Panier extends Model{
	private $id;
	private $id_produit;
	
	public function getId() { return $this->id; }  
	public function getId_produit() { return $this->id_produit;}

	public function setId($x) { $this->id = $x; } 
	public function setId_produit($x) { $this->id_produit = $x;}

}