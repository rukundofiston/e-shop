<?php

include ('config.php');


$smarty->assign("title", "Réclamation");

$smarty->assign("msg", "");
$smarty->display('reclamation.html');