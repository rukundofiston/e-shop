<?php
include ('config.php');
$fournisseurM = new FournisseurManager($ikra);
$fournisseurs = $fournisseurM->edit($_POST);
header('location:fournisseur.php'); 