<?php
// if user logged in we redirect user to index page
if (isset($_SESSION['username'])&&isset($_SESSION['password'])){
	UnsetSession('username_field');
	UnsetSession('password_field');
	Controller::redirectPage('/');
}

// --- whole block about : 
// 1. validation
// 2. store if have error or user data if success
// 3. reload (because of post method)

// ----- you must add this on every page
$FORM = "LogForm";
$INPUT_ARRAY=['userName','userPass'];
$PAGE_INPUTS=[
	$INPUT_ARRAY[0]=>['ALPHA_NUM', 'Felhasználónév', 3, 32,'','text', $_SESSION['username_field']],
	$INPUT_ARRAY[1]=>['ALPHA_NUM', 'Jelszó', 6, 64,'','password',$_SESSION['password_field']]
];

// ----- till here -----
$T['FORM']=$FORM;
$T['PHP_INPUT']=View::createAllInput($INPUT_ARRAY, $PAGE_INPUTS);
$T['SCRIPT_INPUT']=convertArrayToString($PAGE_INPUTS);

if (!empty($_POST)){	
	if (matchArrayKeys($INPUT_ARRAY, $PAGE_INPUTS)===true){
		$_POST['userName'] = strtolower(trim($_POST['userName']));
		$_POST['userPass'] = (trim($_POST['userPass']));
		$input_validator = new Validator;
		$result=$input_validator::init($PAGE_INPUTS);
		if ($result[0]!==true){
			$_SESSION['errorMsg']=htmlspecialchars(implode("<br>", $result[1]), ENT_QUOTES);
				Controller::redirectPage('/bejelentkezes');
		}else{
			$T['Login']=true; // let's continue in model
		}
	}
}
