<?php
$db = mysql_connect("localhost","root","");
mysql_select_db('e-shop',$db);
$id_fr= $_GET['id'];
$sURL = $_GET['url']."?id_fr=".$_GET['id']; // The Request URL

$aHTTP = array('http' => // The wrapper to be used
array(
    'method'  => 'GET', // Request Method
  )
);
/*
echo $sURL;
echo $id_fr;*/


$context = stream_context_create($aHTTP);
$contents = file_get_contents($sURL, false, $context);

$data=explode("**", $contents);

for ($i=0; $i < sizeof($data); $i++) { 
	if($data[$i]==""){
		exit();
	}
	$sql=$data[$i];
	mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}
header('Location: index.php');
