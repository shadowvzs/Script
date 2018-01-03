<?php
if ($T['Registration'] === true) {
	$username=$_POST['userName'];
	$email=$_POST['userEmail'];	
	$exist = Registration::isRegistered($username, $email);
	
	if ($exist){
		$_SESSION['errorMsg']=htmlspecialchars('<b>'.$username.'</b> vagy <b>'.$email.'</b> már szerepel az adatbázisban!');
	}else{
		$array=[
			'username'=>htmlspecialchars($username),
			'password'=>md5($_POST['userPass1']),
			'full_name'=>$_POST['trueName'],
			'email'=>$email
		];
		$result = Registration::createAccount($array);
		if ($result[0]) {
			Login::loginWithSession($array['username'],htmlspecialchars($_POST['userPass1']));
		}else{
			$_SESSION['errorMsg']=htmlspecialchars($result[1]);
		}
	}
	Controller::redirectPage('/regisztracio');
}

if (isset($_SESSION['errorMsg'])){$T["error"]=$_SESSION['errorMsg'];unset($_SESSION['errorMsg']);}


