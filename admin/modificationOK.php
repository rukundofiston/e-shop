<?php
include ('config.php');
$produitM = new ProduitManager($ikra);
extract($_POST);
$produits = $produitM ->edit(array('id'=>$id,'prix'=>$prix));


header('location:index.php'); 