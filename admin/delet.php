<?php
include ('config.php');
$produitM = new ProduitManager($ikra);
$produit=new Produit($_GET);
$produitM ->del($produit);
header('location:index.php'); 
