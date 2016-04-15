<?php

include ('config.php');
extract($_GET);

$pdtM= new ProduitManager($ikra);
$liste=$pdtM->listepdt($type,$categorie);
$smarty->assign("listes",$liste);
$smarty->assign("type",$type); 
//debug($liste);
//die();
$smarty->display('Mobilecategorie2.html');