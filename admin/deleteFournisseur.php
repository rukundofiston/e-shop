<?php
include ('config.php');
$fournisseurM = new FournisseurManager($ikra);

$fournisseur=new Fournisseur($_GET);
$fournisseurM->del($fournisseur);
header('location:fournisseur.php'); 