<?php
session_start();
include ('config.php');

$produitM = new ProduitManager($ikra);
$produits = $produitM ->liste();
$smarty->assign("produits", $produits);


$contactManager =new contactManager($ikra);
$messages=$contactManager->selectUnread();
$nbreMessage=$contactManager->count("WHERE statut = 0");

$smarty->assign("user",$_SESSION['login_user']);
$smarty->assign("messages",$messages);
$smarty->assign("nbreMessage",$nbreMessage);

$smarty->display('produit.html');//Afficher la page produit.html
