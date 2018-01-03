<?php 
class Controller {
	public static function init(){
		$page=isset($_GET['page']) ? htmlspecialchars($_GET['page'], ENT_QUOTES) : 'home';
		static::authVerification();
		static::loadComponents($page);		
	}
	public static function authVerification(){
		if (static::isUserLogged()){
			$self = User::authUser($_SESSION['username'], $_SESSION['password']);
			if (!$self = User::authUser($_SESSION['username'], $_SESSION['password'])){
				static::redirectPage('/kijelentkezes');
			}
		}
	}
	public static function isUserLogged(){
		return (isset($_SESSION['username']) && isset($_SESSION['password']));
	}
	
	public static function loadComponents($page){
		$modelPath = MODEL_PATH.$page.'.php';
		$controllerPath = CONTROLLER_PATH.$page.'.php';		
		$T = [];	// we will store data here

		function requireTemplate($T, $templatePath, $page){
			$id=isset($_GET['id']) ? intval($_GET['id']) : -1;
			View::init($page);
			require VIEW_SHARED_PATH.'main.php';
		}
		if ((file_exists($modelPath))&&(file_exists($controllerPath))){
			static::initPageClassLoader();	//check if c[controller] and a[action] => c=>class a=>method, ex. index.php?c=User&a=logout
			include($controllerPath);
			include($modelPath);
			$VIEW = $page.'.php';
		} else {
			$VIEW = 'not_found.php';
		}
		$templatePath = VIEW_PATH.$VIEW;
		requireTemplate($T, $templatePath, $page);				
	}
	
	public static function initPageClassLoader(){
		if (CONTROLLER===false){ return false; }
		$className=CONTROLLER;
		if (!class_exists($className)){ return false; }
		if (ACTION===false){
			$PageContoller = new $className();
		}else{
			
			$PageContoller = $className;
			if (!method_exists($className, ACTION)){ return false; }
			$method = ACTION;
			$className::$method();
		}
	}
		
	public static function redirectPage($url) {
		$cmd = sprintf('Location: %s',$url);
		header($cmd);
		exit;		
	}

}