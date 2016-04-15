<?php
class Produit extends Model{
	private $id;
	private $id_p;
	private $id_fr;
	private $libelle;
	private $prix;
	private $description;
	private $qte_stock;
	private $photos;
	private $id_cat;

	public function getId() { return $this->id; }  
	public function getId_p() { return $this->id_p; }  
	public function getId_fr() { return $this->id_fr; } 
	public function getLibelle() { return $this->libelle; }
	public function getPrix() { return $this->prix; }
	public function getDescription() { return $this->description; } 
	public function getQte_stock() { return $this->qte_stock; }
	public function getPhotos() { return $this->photos; }
	public function getId_cat() { return $this->id_cat; }
	
	
	public function setId($x) { $this->id = $x; } 
	public function setId_p($x) { $this->id_p = $x; }  
	public function setId_fr($x) { $this->id_fr = $x; } 
	public function setLibelle($x) {  $this->libelle = $x; }
	public function setPrix($x) { $this->prix = $x; }
	public function setDescription($x) { $this->description = addslashes($x); } 
    public function setQte_stock($x) { $this->qte_stock = $x; }
	public function setPhotos($x) { $this->photos = $x; }
	public function setId_cat($x) { $this->id_cat = $x;}	
	
	
}