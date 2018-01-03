<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Győzelem Gyülekezet - <?= View::getPageTitle() ?></title>
		<script src='./public/js/common.js'></script>	
		<!-- <script src='./public/js/jquery.js'></script>	-->
		<link rel="stylesheet" href="./public/css/reset.css" type="text/css" />
		<?php if (file_exists(CSS_PATH.$page.'.css')){ echo"<link rel='stylesheet' href='./public/css/".$page.".css' type='text/css'/>"; } ?>	
		<?php if (file_exists(JS_PATH.$page.'.js'))  { echo"<script src='./public/js/".$page.".js'></script>"; } ?>
	</head>
	
    <body>
		<?php include (VIEW_PATH.$page.'.php'); ?>
    </body>
	
</html>



<!-- The bottom part make a javaScript input filter, 
 rules are same for backend and front end and was defined in begining of page controller -->
<script> 
let RAW_ARRAY = '<?= implode("$",$T["SCRIPT_INPUT"]) ?>', ARRAY = RAW_ARRAY.split("$"), DATA;

for (DATA of ARRAY){
	Input_Validator.newInput(DATA);
}
</script>