<?php
class Manager{
	public $bdd;

	public function __construct($bdd){
		$this->setBdd($bdd);
	}

	public function setBdd($bdd){
		$this->bdd = $bdd;
	}
}