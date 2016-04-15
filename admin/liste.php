<?php
include ('config.php');
$produitM = new ProduitManager($ikra);
$produits = $produitM ->liste();
print_r($produits);