<?php

include ('config.php');

$smarty->assign("title", "A propos de nous");
$smarty->display('about.html');//Afficher la page .htm ou .tpl
