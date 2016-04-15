<?php
include ('config.php');
$fournisseurManager = new FournisseurManager($ikra);
$fournisseur = new Fournisseur($_POST);
$fournisseurs = $fournisseurManager ->add($fournisseur);

header('location:fournisseur.php'); 