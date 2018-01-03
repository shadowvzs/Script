<?php

if ($T['Login'] === true) {
	$username=$_POST['userName'];
	$password=$_POST['userPass'];	
	$success=Login::loginWithSession($username, $password);
	if (!$success) {
		$_SESSION['errorMsg']='Hibás név vagy jelszó!';
	}
	$_SESSION['username_field'] = $username;
	$_SESSION['password_field'] = $password;
	Controller::redirectPage('/bejelentkezes');
}

if (isset($_SESSION['errorMsg'])){$T["error"]=$_SESSION['errorMsg'];unset($_SESSION['errorMsg']);}
