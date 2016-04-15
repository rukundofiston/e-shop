<?php
session_start();
include ('config.php');
$cltM = new ClientManager($ikra);
$villeM=new VilleManager($ikra);

$clients = $cltM->liste();
$villes=$villeM->getAllVille();
$smarty->assign("clients", $clients);
$smarty->assign("villes", $villes);

$contactManager =new contactManager($ikra);
$messages=$contactManager->selectUnread();
$nbreMessage=$contactManager->count("WHERE statut = 0");

$smarty->assign("messages",$messages);
$smarty->assign("nbreMessage",$nbreMessage);

$smarty->assign("user",$_SESSION['login_user']);
$smarty->display('client.html');
