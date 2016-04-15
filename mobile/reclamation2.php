<?php

include ('config.php');
$contM = new ContactManager($ikra);
$reclamation =new Contact($_GET);
$contM ->add($reclamation);
$smarty->assign("title", "Réclamation");
$smarty->assign("msg", "votre réclamation à été bien envoyée");
$smarty->display('reclamation.html');
