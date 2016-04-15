<?php
include ('config.php');
$ContactM = new ContactManager($ikra);
$contact=new Contact($_GET);
$ContactM ->del($contact);
header('location:contactok.php'); 
