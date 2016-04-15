<?php
session_start();
include ('config.php');
$contM = new ContactManager($ikra);
$contacts = $contM ->liste();
$smarty->assign("contacts", $contacts);

$contactManager =new contactManager($ikra);
$messages=$contactManager->selectUnread();
$nbreMessage=$contactManager->count("WHERE statut = 0");

$smarty->assign("user",$_SESSION['login_user']);
$smarty->assign("messages",$messages);
$smarty->assign("nbreMessage",$nbreMessage);


$smarty->display('contact.html');//Afficher la page produit.html