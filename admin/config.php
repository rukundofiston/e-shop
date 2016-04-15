<?php
//session_start();
//smarty
define('SMARTY_DIR', '../../outils/Smarty/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty();
	$smarty->debugging = 0;
	$smarty->template_dir = '../smarty/templates/';
	$smarty->compile_dir = '../smarty/templates_c/';
	$smarty->config_dir = '../smarty/configs/';
	$smarty->cache_dir = '../smarty/cahe/';


//ORM
require_once('../App/ikra.php');
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "e-shop");

// database( your_database_user , your_database_password , your_database , your_server );
$ikra = new database(DB_USER, DB_PASS, DB_NAME,DB_HOST);

//include les functions de l'app
require_once("../App/func.php");

//autoload classes
spl_autoload_register('putClasses');


