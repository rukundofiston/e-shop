<?php
include ('config.php');
$cltM = new ClientManager($ikra);
$client = new Client($_POST);

$clients = $cltM ->add($client);
header('location:client.php'); 