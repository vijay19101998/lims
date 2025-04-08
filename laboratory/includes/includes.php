<?php
define("filePath", realpath(dirname(__FILE__)));
//
require_once (filePath.'/config.php');
include_once (filePath.'/lib/Session.php');
Session::init();

include_once (filePath.'/lib/Database.php');
include_once (filePath.'/helpers/Format.php');
include_once (filePath.'/lib/Pagination.php');
spl_autoload_register(function($class){
	//echo "<br>".$class;
	//include_once "classes/".$class.".php";
	include_once (filePath.'/../classes/'.$class.'.php');
});

$db = new Database();
$fm = new Format();
$app = new Application();
//$usr = new User();

/*header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
header("Pragma: no-cache"); 
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");*/
//header("Content-Type: application/json");
header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");