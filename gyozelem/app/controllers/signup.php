<?php

// if user logged in we redirect user to index page
if (isset($_SESSION['username'])&&isset($_SESSION['password'])){
	Controller::redirectPage('/');
}


// --- whole block about : 
// 1. validation
// 2. store if have error or user data if success
// 3. reload (because of post method)

// ----- you must add this on every page
$FORM = "RegForm";
$INPUT_ARRAY=['userName','trueName','userEmail','userPass1','userPass2'];
$PAGE_INPUTS=[
	$INPUT_ARRAY[0]=>['ALPHA_NUM', 'Felhasználónév', 3, 32,'','text',''],
	$INPUT_ARRAY[1]=>['NAME', 'Teljes név', 3, 64,'','text',''],
	$INPUT_ARRAY[2]=>['EMAIL', 'Email cím', 6, 50,'','email',''],
	$INPUT_ARRAY[3]=>['ALPHA_NUM', 'Jelszó', 6, 64,'userPass2','password',''],
	$INPUT_ARRAY[4]=>['ALPHA_NUM', 'Jelszó újra', 6, 64,'','password','']
];
// ----- till here -----
$T['FORM']=$FORM;
$T['PHP_INPUT']=View::createAllInput($INPUT_ARRAY, $PAGE_INPUTS);
$T['SCRIPT_INPUT']=convertArrayToString($PAGE_INPUTS);

if (!empty($_POST)){
	if (matchArrayKeys($INPUT_ARRAY, $PAGE_INPUTS)){
    //if ((isset($_POST[$INPUT_ARRAY[0]]))&&(isset($_POST[$INPUT_ARRAY[1]]))&&(isset($_POST[$INPUT_ARRAY[2]]))&&(isset($_POST[$INPUT_ARRAY[3]]))&&(isset($_POST[$INPUT_ARRAY[4]]))){
		$_POST['userName'] = strtolower(trim($_POST['userName']));
		$_POST['userEmail'] = strtolower(trim($_POST['userEmail']));
		$input_validator = new Validator;
		$result=$input_validator::init($PAGE_INPUTS);
		if ($result[0]!==true){
			$_SESSION['errorMsg']=htmlspecialchars(implode("<br>", $result[1]));
			Controller::redirectPage('/regisztracio');
		}else{
			$T['Registration']=true; // let's continue in model
		}
	}
}
