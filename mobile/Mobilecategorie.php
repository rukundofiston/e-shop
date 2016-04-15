<?php

include ('config.php');
extract($_GET);
//$smarty->assign("type",$type);
$catM= new CategorieManager($ikra);
$liste=$catM->listecat($type);
$smarty->assign("liste",$liste);
$smarty->assign("type",$type); 
//debug($liste);
//die();
$smarty->display('Mobilecategorie.html');