<?php
include ('config.php');
$cltM = new ClientManager($ikra);

$client=new Client($_GET);
$cltM ->del($client);
header('location:client.php'); 
