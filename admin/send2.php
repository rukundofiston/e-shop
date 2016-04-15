<?php
//test de smarty
require_once('config.php');
$contM = new ContactManager($ikra);

extract($_POST);

  $to   = $email;
     $subject = 'Réponse de E_shope';
     $message = $reponse;
     $headers = 'From: fatiflower.elidrissi@gmail.com' . "\r\n" .
     'Reply-To: fatiflower.elidrissi@gmail.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $message, $headers);
	$contacts = $contM ->edit(array('id'=>$id,'statut'=>1)); 
header('location:contact.php');

   