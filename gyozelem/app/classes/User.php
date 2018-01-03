<?php 
class User extends Model {
	public static $TABLE_NAME = "users";
	protected $id;  
	protected $username;  
	protected $rank;  
	protected $email;  
	protected $password; 
	public $last_action; 
	public $ip;
	public $browser;
	public $created_at;
	public $full_name;
	public $page;
	public $status;
	public $phone;
	public $address;
	public function getRank(){ return $this->rank; }
	public function getId(){ return $this->id; }
	public function getEmail(){ return $this->email; }
	public function getPassword(){ return $this->password; }

	public static function authUser($username, $password) {
		$condition = sprintf("`username` = '%s' AND `password` = '%s'",$username,md5($password));
		$data=static::readRecords($condition, true);
		if ($data){
			$data->password = $password;
			return $data;
		}else{
			return false;
		}
	}
	
	public static function logout() {
		UnsetSession('username_field');
		UnsetSession('password_field');
		UnsetSession('username');
		UnsetSession('password');
		UnsetSession('rank');
		UnsetSession('id');
	}
}