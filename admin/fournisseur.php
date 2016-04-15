<?php
include ('config.php');
session_start();

$fournisseurManager = new FournisseurManager($ikra);
$villeM=new VilleManager($ikra);
$contactManager =new contactManager($ikra);


$fournisseurs = $fournisseurManager->liste();
$villes=$villeM->getAllVille();
$messages=$contactManager->selectUnread();
$nbreMessage=$contactManager->count("WHERE statut = 0");

$contactManager =new contactManager($ikra);
$messages=$contactManager->selectUnread();

$smarty->assign("user",$_SESSION['login_user']);
$smarty->assign("nbreMessage",$nbreMessage);
$smarty->assign("messages",$messages);
$smarty->assign("fournisseurs",$fournisseurs);
$smarty->assign("villes",$villes);
$smarty->display('fournisseur.html');


