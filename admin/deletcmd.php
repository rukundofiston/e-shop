<?php
include ('config.php');
$commandeM = new CommandeProduitManager($ikra);
$commande=new CommandeProduit($_GET);
$commandeM ->del($commande);
header('location:commande.php'); 
