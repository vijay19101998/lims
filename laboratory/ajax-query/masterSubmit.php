<?php
//ini_set ('display_errors', 1);  
//ini_set ('display_startup_errors', 1);  
//error_reporting (E_ALL);  
include_once("../includes/includes.php");
if(!empty($_GET['action']) && $_GET['action'] == 'logout') {
	header("Location:../index.php");
}

//return '';
$masterSubmit =  new Mastersubmit(); 
if(!empty($_REQUEST['action'])) {
	$inputData = array();
	if(isset($_REQUEST)){
		$inputData["request"] = $_REQUEST;
	}
	if(isset($_FILES)){
		$inputData["file"] = $_FILES;
	}
	
	call_user_func_array(array($masterSubmit, $_REQUEST["action"]),array($inputData));
	//$data = array("check"=>true);
    //echo json_encode($data, true);
}