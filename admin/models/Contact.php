<?php
class Contact extends Model{
	private $id;
	private $email;
	private $objet;
	private $msg;
	private $statut;
	private $temps;

	public function getId() { return $this->id; } 
	public function getEmail() { return $this->email; } 
	public function getObjet() { return $this->objet; } 
	public function getMsg() { return $this->msg; } 
	public function getStatut() { return $this->statut; } 
	public function getTemps() { return $this->temps; } 
	
	public function setId($x) { $this->id = $x; } 
	public function setEmail($x) { $this->email = $x; } 
	public function setObjet($x) { $this->objet = $x; } 
	public function setMsg($x) { $this->msg = $x; } 
	public function setStatut($x) { $this->statut= $x; } 
	public function setTemps($x) { $this->temps= $x; }
	
}