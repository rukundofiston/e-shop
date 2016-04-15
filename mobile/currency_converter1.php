<?php

include ('config.php');

if($_GET){
extract($_GET);
function currency_convert($amount,$from,$to){
$result=file_get_contents('http://www.google.com/ig/calculator?hl=en&q='.$amount.$from.'=?'.$to);
$expl=explode('"',$result);
if ($expl[1]== ''|| $expl[3]== ''){
return false;
}
else{
return array(
           $expl[1],
		   $expl[3]
		   );
}
}
if (isset($amount,$from,$to)){
$amount= (int)$amount;
$from= $from;
$to= $to;
$conversion = currency_convert($amount,$from,$to);

$v=$conversion[0];
$w=$conversion[1];
$res =$v. ' = '.$w; 
$smarty->assign("res", $res);
}
$smarty->assign("from", $conversion[0]);
$smarty->assign("to", $conversion[1]);
$smarty->assign("title", "Conversion de devise");
$smarty->display('currency_converter.html');
}
else{
$res="";
$smarty->assign("res", $res);


$smarty->assign("title", "Conversion de devise");
$smarty->display('currency_converter.html');
}
