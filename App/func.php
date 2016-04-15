<?php
/**
 * Function de debugage	
 */
function debug($s=null){
	echo '<pre>';
		print_r($s);
	echo '<pre>';
}

/**
 * Function qui autoload les classes
 */
function putClasses($class){
	if(preg_match("#Manager#", $class)){
		require '/Managers/'.$class.'.php';
	}else{
		require '/models/'.$class.'.php';
	}
}

