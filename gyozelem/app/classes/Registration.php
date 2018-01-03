<?php 
class Registration extends User {
	public static function isRegistered($username, $email) {
		$condition = sprintf("`username` = '%s' OR `email` = '%s'",$username,$email);
		return static::readRecords($condition, false);
	}
	public static function createAccount($array=[]){
		if (count($array)>0){
			$datetime = date("Y-m-d H:i:s");
			$browser = new Browser();
			$browser_data = $browser->getPlatform().'=>'.$browser->getBrowser().'=>'.$browser->getVersion();
			$default_data = [
				"rank"=>1,
				"ip"=>get_IP(),
				"browser"=>$browser_data,
				"created_at"=>$datetime,					
				"last_action"=>$datetime,		
				"page"=>0,
				"status"=>0
			];
			$array = array_merge($array, $default_data);
			return Registration::insertRow($array);
		}else{
			return [false,"Input data is empty or invalid"];
		}
	}		
}