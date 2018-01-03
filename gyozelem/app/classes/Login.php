<?php
class Login extends User {
	public static function loginWithSession($username, $password) {
		$self = static::authUser($username, $password);
		if ($self!==false){
			$_SESSION['username']=$self->username;
			$_SESSION['password']=$self->password;
			$_SESSION['rank']=$self->rank;
			$_SESSION['id']=$self->id;
		}
		return $self!==false ? true : false;
	}
}