<?php
session_start();
include ('config.php');
$commandeM = new CommandeProduitManager($ikra);
$commandes = $commandeM ->liste1();
//debug($command
$smarty->assign("commandes", $commandes);
$contactManager =new contactManager($ikra);
$messages=$contactManager->selectUnread();
$nbreMessage=$contactManager->count("WHERE statut = 0");

$smarty->assign("user",$_SESSION['login_user']);
$smarty->assign("messages",$messages);
$smarty->assign("nbreMessage",$nbreMessage);

$smarty->display('commande.html');//Afficher la page commande.html
