<?php
class View {
	protected static $page;
	public static $menuLinks;
	protected static $pageData = [
		'home'     => ['Főoldal','Vissza a főoldalra', 'ALL', '/'],
		'events'   => ['Naptár','Események megtekintése', 'ALL', '/naptar'],
		'videos'   => ['Videók','Videók megtekintése', 'ALL', '/videok'],
		'albums'   => ['Főoldal','Vissza a főoldalra', 'ALL', '/galeria'],
		'articles' => ['Cikkek','Cikkek megtekintése', 'ALL', '/cikkek'],
		'walls'    => ['Üzenőfal','Vissza a főoldalra', 'ALL', '/uzenofal'],
		'downloads' => ['Letöltés','Dicséretek letöltése', 'ALL', '/letoltes'],
		'bible'    => ['Biblia','Ugrás az Online Biblia oldalra', 'ALL', '/biblia'],

		'messages' => ['Üzenetek','Üzenetek megtekintése', 'USER_ONLY', '/posta'],
		'settings' => ['Beállítások','Beállítások megtekintése', 'USER_ONLY', '/beallitasok'],
		'logout'   => ['Kijelentkezés','Kijelentkezés a jelenlegi fiókról', 'USER_ONLY', '/logout'],

		'login'    => ['Bejelentkezés','Bejelentkezés az oldalra', 'GUEST_ONLY', '/bejelentkezes'],
		
		'signup'   => ['Regisztrálás','Új fiók létrehozása', 'HIDDEN', '/regisztracio']	
	];
	
	public static function getPageTitle() {
		return static::$pageData[static::$page][0];
	}
	
	public static function init($page){
		static::$page = $page;
		static::$menuLinks=static::createPageLinks();
	}
	
	public static function createPageLinks (){
		$out=['ALL'=>[],'USER_ONLY'=>[],'GUEST_ONLY'=>[]];
		$PAGES = static::$pageData;
		foreach($PAGES as $key => $array){
			if ($array[2]!='HIDDEN'){
				$textLabel = ($array[2] == 'ALL') ? sprintf("<span class='buttonName'> %s </span>",$array[0]) : '';
				$raw_link="<a href='%s' title=' %s '> <span class='menuButton'><img src='./public/img/icons/menu/%s.png'> %s </span></a>";
				$out[$array[2]][]=sprintf($raw_link,$array[3],$array[1],$key, $textLabel);
			}
		}
		return $out;
	}
	
	public static function createInput($index, $INPUT_ARRAY, $PAGE_INPUTS) {
		$TYPE = $INPUT_ARRAY[intval($index)];
		$PAGE_INPUT=$PAGE_INPUTS[$TYPE];
		$PATTERN = Validator::$PATTERN[$PAGE_INPUT[0]];
		$HTML_PATTERN = Validator::getHTMLPattern($PATTERN[0],$PAGE_INPUT[2],$PAGE_INPUT[3]);
		$format = "<input id='%s' name='%s' type='%s' placeholder='%s' pattern='%s' required title='%s' value='%s'>";
		$TITLE = $PATTERN[2].'; &#013; Hossz legyen '.$PAGE_INPUT[2].'-'.$PAGE_INPUT[3].' karakter';
		$INPUT = sprintf($format, $TYPE, $TYPE, $PAGE_INPUT[5], $PAGE_INPUT[1], $HTML_PATTERN, $TITLE, $PAGE_INPUT[6]);
		return $INPUT;
	}

	public static function createAllInput($INPUT_ARRAY, $PAGE_INPUTS) {
		$max = count($INPUT_ARRAY);
		$out=[];
		for($i=0;$i<$max;$i++){
			$out[]=View::createInput($i, $INPUT_ARRAY, $PAGE_INPUTS);
		}
		return $out;
	}	
}