<?php
include ('config.php');
session_start();
unset($_SESSION['login_user']);

if(session_destroy()){
	$smarty->display('me-login.html'); 
}
