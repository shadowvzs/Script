<?php 
class Validator {
	protected static $PAGE_INPUTS;
	public static $PATTERN = [
		'EMAIL'=> ['/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4}+)$/','email','Valós email címet adjon meg'],
		'NAME'=>['/^([a-zA-Z0-9 ÁÉÍÓÖŐÚÜŰÔÕÛáéíóöőúüűôõû]+)$/','text','Csak a magyar ABC betűit használhatja'],
		'ALPHA_NUM'=>['/^([a-zA-Z0-9]+)$/','text','Csak az angol ABC betűit és/-vagy számokat használhat'],
		'STR_AND_NUM'=>['/^([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+|[a-zA-Z]+[0-9]+[a-zA-Z]+)$/','text','Csak az angol ABC betűit és számokat használhat']
	];
	
	public static function getHTMLPattern($PATTERN, $min=1, $max=50000){
		return '(?=.{'.$min.','.$max.'}$)'.substr($PATTERN,2,-2);
	}		
	
	public static function init($data=null){
		if ($data) {
			static::$PAGE_INPUTS=$data;
			$result = static::validateInput();
		}else{
			$result = [false, ["Not exist input informaton for this page"]];
		}
		return $result;
	}
	
	protected static function validateInput(){
		$error = [];
		$keyPairs = [];		// this is use for check if 2 key got same value, ex. password & confirm password
		foreach ($_POST as $key => $value) {
			$next=true;
			$rule=static::$PAGE_INPUTS[$key];
			if ($rule===NULL){
				$error[] = $key.' do not have any sanitize rule...';
				$next = false;
			}
			// method_exists(__CLASS__, 'TYPE_'.$rule[0])

			if ($next && !$TYPE_PATTERN = static::$PATTERN[$rule[0]][0]){
				$error[] = '<b>'.$key.':</b> not exist associated sanitize method!';
				$next=false;
			}
			
			if (htmlspecialchars($_POST[$key], ENT_QUOTES)==""){
				$error[] = '<b>'.$rule[1].':</b> üres mező!';
				$next=false;
			}
			
			if ($next && !$validType = static::CHECK_TYPE($TYPE_PATTERN,$key)){
				$error[] = '<b>'.$rule[1].':</b> helytelen karakter!';
				$next=false;
			}	
			
			if ($next && !$validLength = static::validLength($key, $rule[2], $rule[3])){
				$error[] = '<b>'.$rule[1].':</b> túl rövid vagy hosszú!';		
				$next=false;
			}
			
			if ($next && $rule[4]!=""){
				$keyPairs[$key]=$rule[4];
			}
		}
		
		if (empty($error)) {
			foreach ($keyPairs as $key1 => $key2) {
				if ($_POST[$key1] != $_POST[$key2]){
					$error[] = '<b>'.static::$PAGE_INPUTS[$key1][1].'</b> és <b>'.static::$PAGE_INPUTS[$key2][1].'</b> nem egyezik!';
				}
			}
		}
		return [count($error)===0, $error];
	}

	protected static function CHECK_TYPE ($pattern, $key){
		$_POST[$key]=trim($_POST[$key]);
		return preg_match($pattern, htmlspecialchars($_POST[$key], ENT_QUOTES));
	}
	protected static function validLength (&$key, $min, $max) {
		$len = strlen($_POST[$key]);
		return ($len < $min)||($len>$max) ? false : true;
	}


	
	protected static function Sanitize (){
		//"email"=>FILTER_SANITIZE_EMAIL,
		//"integer"=>FILTER_SANITIZE_NUMBER_INT,
		//"float"=>FILTER_SANITIZE_NUMBER_FLOAT,
		//"url"=>FILTER_SANITIZE_URL,
		//"string"=>FILTER_SANITIZE_STRING,
		//"alphanum"=>FILTER_SANITIZE_STRING		
	}
}