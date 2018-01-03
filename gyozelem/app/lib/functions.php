<?php
function loadClass ($className){
    $classPath = CLASS_PATH.$className.'.php';
	if (file_exists($classPath)){
        include($classPath);
	}
}

function debugVar($var){
    echo'<pre>'.print_r($var, true).'</pre>';
}

function convertArrayToString($array){
	$out = [];
	$DELIMITER = "#";
	foreach ($array as $key => $old_array) {	
		$out[] = $key.$DELIMITER.implode($DELIMITER,$old_array);
	}
	return $out;
}

function get_IP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function matchArrayKeys($arrayKeys=[], $array=[]){
	$len1=count($arrayKeys);
	$len2=count($array);
	if (($len2===0)||($len1!==$len2)){return false;}
	$key1 = trim(implode('',$arrayKeys));
	$key2 = trim(implode('',array_keys($array)));
	return ($key1===$key2);
}

function UnsetSession($key){
	if (isset($_SESSION[$key])){
		unset ($_SESSION[$key]);
	}
}
