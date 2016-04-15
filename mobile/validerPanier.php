<?php
include ('config.php');

if(isset($_POST['choix'])){
	foreach($_POST['choix'] as $chkbx){ 
		echo $chkbx; //ex. : 12 16 23 31 ...							 
	}
}
else{
	echo "pas de valeur";
}