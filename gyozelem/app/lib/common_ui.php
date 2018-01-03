<?php
// action     tooltip      icon name   
define ("ICON_PATH", "./inc/img/icons/menu/");
define ("MENU", 
		[-1,"Vissza a főoldalra","home",""],
		[-1,"Események megtekintése","events",""], //guests table
		[-1,"Videók megtekintése","videos",""],
		[-1,"Kép galéria megtekintése","albums",""],
		[-1,"Dicséretek halgatása vagy letöltése","worship",""],
		[-1,"Ugrás az Online Biblia oldalra","bible",""],
		[-1,"Üzenőfal megtekintése","wall",""],
		[-1,"Cikkek megtekintése","articles",""]

		[1,"Üzenetek megtekintése","messages",""],
		[1,"Beállítások megtekintése","settings",""],
		[1,"Kijelentkezés","logout",""]				

		[0,"Bejelentkezés","login",""]
	
);

//<a href="javascript:void(0);" title="Vissza a főoldalra"> <span class="menuButton"><img src="./inc/img/icons/menu/home.png"> <span class="buttonName"> Főoldal </span></span></a>	


function buildMenu ($id = 0){
	$menu = (MENU[$id]!==null) ? MENU[$id] : [];
	$max = count($menu);
	$links = "";
	$buttonLabel = ($id > 0) ? false : true;
	$buttonName="";
	for ($i=0;$i<$max;$i++){
		if ($buttonLabel) {$buttonName = " <span class='buttonName'> ".$menu[$i][3]." </span>";}
		$links += "<a href='javascript:void(0);' onclick='".$menu[$i][0]."' title='".$menu[$i][1]."'> <span class='menuButton'><img src='".ICON_PATH.$menu[$i][2].".png'>".$buttonName."</span></a>" ;
	}
	return $links;
}	

