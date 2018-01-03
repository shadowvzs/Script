<?php 

    define("DS", DIRECTORY_SEPARATOR);
    define("ROOT", getcwd() . DS);
    define("APP_PATH", ROOT.'app'.DS);
    define("PUBLIC_PATH", ROOT."public".DS);

    define("JS_PATH", PUBLIC_PATH."js".DS);
    define("CSS_PATH", PUBLIC_PATH."css".DS);
    define("UPLOAD_PATH", PUBLIC_PATH."upload".DS);
    define("IMG_PATH", PUBLIC_PATH."img".DS);
	
    define("ICONS_PATH", IMG_PATH."icons".DS);
	define("MENU_ICON_PATH", ICONS_PATH."menu".DS);
    define("STATIC_IMAGE_PATH", IMG_PATH."static".DS);

    define("CONFIG_PATH", APP_PATH . "config" . DS);
    define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);
    define("MODEL_PATH", APP_PATH . "models" . DS);
    define("VIEW_PATH", APP_PATH . "views" . DS);
    define("VIEW_SHARED_PATH", VIEW_PATH . "shared" . DS);
    define("LIB_PATH", APP_PATH . "lib" . DS);
    define("CLASS_PATH", APP_PATH . "classes" . DS);


    // Define platform, controller, action, for example:
    define("CONTROLLER", isset($_GET['c']) ? htmlspecialchars($_GET['c'], ENT_QUOTES) : false);
    define("ACTION", isset($_GET['a']) ? htmlspecialchars($_GET['a'], ENT_QUOTES) : false);
