<?php
include ('config.php');
$cltM = new ClientManager($ikra);
$clients = $cltM ->edit($_POST);
header('location:client.php'); 