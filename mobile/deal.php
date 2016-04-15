<?php
include ('config.php');
extract($_GET);

$pdtM= new ProduitManager($ikra);
$liste=$pdtM->getDeal();
$smarty->assign("listes",$liste);
$smarty->display('mobileDeal.html');