<?php
class Client extends Model{
	private $id;
	private $nom;
	private $prenom;
	private $date_naissance;
	private $telephone;
	private $ville;
	private $adresse;
	private $email;
	private $sexe;

	public function getId() { return $this->id; }  
	public function getNom() { return $this->nom; }  
	public function getPrenom() { return $this->prenom; } 
	public function getDate_naissance() { return $this->date_naissance; }
	public function getTelephone() { return $this->telephone; }
	public function getVille() { return $this->ville; } 
	public function getAdresse() { return $this->adresse; }
	public function getEmail() { return $this->email; }
	public function getSexe() { return $this->sexe; }
	
	
	public function setId($x) { $this->id = $x; } 
	public function setNom($x) { $this->nom = $x; }  
	public function setPrenom($x) { $this->prenom = $x; } 
	public function setDate_naissance($x) {  $this->date_naissance = $x; }
	public function setTelephone($x) { $this->telephone = $x; }
	public function setVille($x) { $this->ville = addslashes($x); } 
    public function setAdresse($x) { $this->adresse = $x; }
	public function setEmail($x) { $this->email = $x; }
	public function setSexe($x) { $this->sexe = $x;}	
	
	
}