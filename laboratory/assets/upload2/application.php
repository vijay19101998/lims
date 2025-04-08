<?php
include_once("../includes/includes.php");
if(!empty($_GET['action']) && $_GET['action'] == 'logout') {
	header("Location:index.php");
}
$app =  new Application(); 

if(!empty($_REQUEST['action'])) {
	//$data = $report->getAttendnaceSummary();
	// print_r($data);
	//call_user_func($actionfunction,$_REQUEST,$limit,$adjacent);
	call_user_func_array(array($app, $_REQUEST["action"]),array($_REQUEST));
	//$data = array("check"=>true);
    // echo json_encode($_REQUEST, true);
}
