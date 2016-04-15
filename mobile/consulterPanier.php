<?php

include ('config.php');
$panierM= new PanierManager($ikra);
$paniers= $panierM->listeProduit();
$smarty->assign("paniers",$paniers);
//print_r($paniers);
$smarty->display('monpanier.html');