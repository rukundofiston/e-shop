<?php

include ('config.php');
extract($_GET);

$pdtM= new ProduitManager($ikra);
$produit=new Produit($_GET);
$liste=$pdtM->get($produit);
$smarty->assign("liste",$liste);
//$smarty->assign("type",$type); 
//debug($liste);
//die();
$smarty->display('MobileInfopdt.html');